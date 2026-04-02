<?php

    function getUserVillage() {
        global $connection;
        $getUserVillage = $connection->prepare("SELECT * FROM user_village WHERE UserID = ?");
        $getUserVillage->bind_param("s", $_SESSION['uid']);
        $getUserVillage->execute();
        $result = $getUserVillage->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextLevel($buildingName, $searchName) {
        global $connection, $userVillage;
        $nextLevel = intval($userVillage[$buildingName]) + 1;
        $getUserVillageBuilding = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = '$searchName' AND BuildingLevel = ?");
        $getUserVillageBuilding->bind_param("i", $nextLevel);
        $getUserVillageBuilding->execute();
        $result = $getUserVillageBuilding->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

function getBuildingMaxLevels() {
    global $connection;
    if (empty($_SESSION['max_building_levels'])) {
        $queryMaxBuildingLevels = $connection->prepare("SELECT DISTINCT BuildingName, COUNT(BuildingLevel) maxlevel FROM rule_village GROUP BY BuildingName ORDER BY BuildingLevel DESC ");
        $queryMaxBuildingLevels->execute();
        $result = $queryMaxBuildingLevels->get_result();
        while ($row = $result->fetch_array()) {
            $_SESSION['max_building_levels'][$row['BuildingName']] = $row['BuildingName'] == "Town Hall" ? (intval($row['maxlevel'])+1) : $row['maxlevel'];
        }
    }
}


function buildingHasBonusProduction($for) {
    $for = str_ireplace([" ",","], ["", ""], strtolower($for));
    if (isFactory($for)) return true;
    switch ($for) {
        case "hospital" : {
            return true;
        }
        default : return false;
    }
    return false;
}

function isFactory($for) {
    switch ($for) {
        case "factory" : 
        case "gemfactory" :
        case "goldfactory" : {
            return true;
        }
        default : return false;
    }
    return false;
}

function getBuildingList($specifyBuilding = false) {
    global $connection;
    $retval = [];
    if ($specifyBuilding == false) {
        $query = $connection->prepare(
            "SELECT DISTINCT 
                rv.`BuildingName` bn, 
                rvd.`BuildingType` bt, 
                MAX(rv.`BuildingLevel`) bl, 
                rvd.`BuildingDesc` bd,
                rvd.`BuildingOutputDesc` bod,
                rvd.MaxCount mc
            FROM `rule_village` rv 
            INNER JOIN `rule_village_desc` rvd ON rv.`BuildingName` = rvd.`BuildingName`
            GROUP BY rv.BuildingName
            ORDER BY rv.BuildingName, rv.BuildingLevel DESC"
        );
    }
    else {
        $query = $connection->prepare(
            "SELECT DISTINCT 
                rv.`BuildingName` bn, 
                MAX(rv.`BuildingLevel`) bl, 
                rvd.`BuildingType` bt, 
                rvd.`BuildingDesc` bd,
                rvd.`BuildingOutputDesc` bod,
                rvd.MaxCount mc
            FROM `rule_village` rv 
            INNER JOIN `rule_village_desc` rvd ON rv.`BuildingName` = rvd.`BuildingName`
            WHERE rv.BuildingName = ?
            GROUP BY rv.BuildingName
            ORDER BY rv.BuildingName ASC, rv.BuildingLevel DESC"
        );
        $query->bind_param("s", $specifyBuilding);
    }
    $query->execute();
    $res = $query->get_result();
    while ($row = $res->fetch_array()) {
        $name = $row['bn'];
        $level = $row['bl'];
        $type = $row['bt'];
        $desc = $row['bd'];
        $outdesc = $row['bod'];
        $maxallowed = $row['mc'];

        if ($specifyBuilding) {
            $retval = [
                'spacedname' => $name,
                'trimmedname' => str_replace([" "], [""], $name),
                'jsname' => strtolower(str_replace([" "], [""], $name)),
                'uservillagename' => str_replace([" "], [""], $name),
                'maxlevel' => $level,
                'type' => $type,
                'desc' => $desc,
                'outputdesc' => $outdesc,
                'hasProdBonus' => buildingHasBonusProduction($name),
                'maxCount' => $maxallowed
            ];
        }
        else {
            $retval[strtolower(str_replace([" "], [""], $name))] = [
                'spacedname' => $name,
                'trimmedname' => str_replace([" "], [""], $name),
                'jsname' => strtolower(str_replace([" "], [""], $name)),
                'uservillagename' => str_replace([" "], [""], $name),
                'maxlevel' => $level,
                'type' => $type,
                'desc' => $desc,
                'outputdesc' => $outdesc,
                'hasProdBonus' => buildingHasBonusProduction($name),
                'maxCount' => $maxallowed
            ];
        }
    }

    return $retval;
}

function getCurrBuidlingLevel($for) {
    global $connection;
    $query = $connection->prepare("SELECT {$for} f FROM user_village WHERE UserID = ?");
    $query->bind_param("i", $_SESSION['uid']);
    $query->execute();
    $res = $query->get_result();
    $row = $res->fetch_array();
    return $row['f'];
}

function getCurrBuildingProd($for) {
    global $connection;
    $query = $connection->prepare("SELECT {$for}Prod f FROM user_village WHERE UserID = ?");
    $query->bind_param("i", $_SESSION['uid']);
    $query->execute();
    $res = $query->get_result();
    $row = $res->fetch_array();
    return $row['f'];
}

function getBuildingNextLevelProd($for, $level) {
    global $connection;
    $query = $connection->prepare("SELECT BuildingOutput bo FROM rule_village WHERE BuildingName = ? AND BuildingLevel = ?");
    $nextBuildLevel = $level + 1;
    $query->bind_param("si", $for, $nextBuildLevel);
    $query->execute();
    $res = $query->get_result();
    $row = $res->fetch_array();
    return $row['bo'];
}

function getBuildingNextLevelCost($for, $level) {
    global $connection;
    $query = $connection->prepare("SELECT BuildingCost bc FROM rule_village WHERE BuildingName = ? AND BuildingLevel = ?");
    $nextBuildLevel = $level + 1;
    $query->bind_param("si", $for, $nextBuildLevel);
    $query->execute();
    $res = $query->get_result();
    $row = $res->fetch_array();
    return $row['bc'];
}

function drawUpgradeModal($for, $currBuildLevel, $nameExtra = "") {
    $hasBonusOutput = $for['hasProdBonus'] == true;
    $nextProdLevel = "";
    if ($hasBonusOutput) {
        $nextProdLevel = getBuildingNextLevelProd($for['spacedname'], $currBuildLevel);
    }
    ?>
    &nbsp;<a class="card-link" data-bs-toggle="modal" data-bs-target="#<?= $for['jsname'].$nameExtra ?>modal" id="<?= $for['jsname'].$nameExtra ?>modallink" href="javascript:void">Upgrade</a>&nbsp;
    <div class="modal fade" id="<?= $for['jsname'].$nameExtra ?>modal" tabindex="-1" aria-labelledby="<?= $for['jsname'].$nameExtra ?>modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5">Upgrade <?= $for['spacedname'].(!empty($nameExtra) ? " ({$nameExtra})" : "") ?></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">
                        Cost to upgrade: <span id="<?= $for['jsname'].$nameExtra ?>cost"><?= getBuildingNextLevelCost($for['spacedname'], $currBuildLevel) ?></span> gold
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="upgradeBuildingv2('<?= $for['trimmedname'].$nameExtra ?>')">Upgrade</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function drawItemContainer($for, $nameExtra = "") {
    $currBuildLevel = getCurrBuidlingLevel($for['uservillagename'].$nameExtra);
    $isMaxLevel = $currBuildLevel == $for['maxlevel'];
    $hasBonusOutput = $for['hasProdBonus'] == true;
    ?>
    <!-- <pre><code><?php var_dump($for) ?></code></pre> -->
    <div class="card" style="width:100%">
        <div class="card-body">
            <h5 class="card-title"><?= $for['spacedname'].(!empty($nameExtra) ? " ({$nameExtra})" : "") ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?= $for['type'] ?></h6>
            <p class="card-text"><?= $for['desc'] ?></p>
            <p class="card-text"><span id="<?= $for['jsname'].$nameExtra ?>level">Level: <?= $currBuildLevel ?></span> (max: <?= $for['maxlevel'] ?>)</p>
            <?php
            if ($hasBonusOutput) {
                ?>
                <p class="card-text">Bonus: <span id="<?= $for['jsname'].$nameExtra ?>prod"><?= getCurrBuildingProd($for['uservillagename'].$nameExtra) . $for['outputdesc'] ?></span></p>
                <?php
            }
            if (!$isMaxLevel) {
                drawUpgradeModal($for, $currBuildLevel, $nameExtra);
            }
            ?>
        </div>
    </div>
    <?php
}