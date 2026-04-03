<?php

$buildingName = !empty($_REQUEST['building']) ? $_REQUEST['building'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

if ($buildingName && $uid) {
    switch ($buildingName) {
        case "TownHall" : $ruleName = "Town Hall"; break;
        case "GoldFactory1" :
        case "GoldFactory2" :
        case "GoldFactory3" :
        case "GoldFactory4" : $ruleName = "Gold Factory"; break;
        case "GemFactory1" : 
        case "GemFactory2" : $ruleName = "Gem Factory"; break;
        default: $ruleName = $buildingName;
    }

    $query_getCurrentBuildingLevel = $connection->prepare("SELECT {$buildingName} FROM user_village WHERE UserID = ?");
    $query_getCurrentBuildingLevel->bind_param("i", $uid);
    $query_getCurrentBuildingLevel->execute();
    $result_getCurrentBuildingLevel = $query_getCurrentBuildingLevel->get_result();

    $row_getCurrentBuildingLevel = $result_getCurrentBuildingLevel->fetch_array();
    $buildingLevel = intval($row_getCurrentBuildingLevel[$buildingName]) + 1;
    $nextLevel = $buildingLevel + 1;

    $query_getTownHallLevel = $connection->prepare("SELECT TownHall FROM user_village WHERE UserID = ?");
    $query_getTownHallLevel->bind_param("i", $uid);
    $query_getTownHallLevel->execute();
    $result_getTownHallLevel = $query_getTownHallLevel->get_result();
    $row_getCurrentTownHallLevel = $result_getTownHallLevel->fetch_array();
    $townhallLevel = intval($row_getCurrentTownHallLevel['TownHall']) + 1;

    if ($townhallLevel < $nextLevel && $buildingName !== 'TownHall') {
        $output['status'] = false;
        $output['message'] = "Town Hall isn't high enough.";
        $output['townhalllevel'] = $townhallLevel;
    }

    else {

        $query_getBuildingCost = $connection->prepare("SELECT BuildingCost, BuildingOutput FROM rule_village WHERE (BuildingLevel = ? OR BuildingLevel = ?) AND BuildingName = ? ORDER BY BuildingLevel ASC");
        $query_getBuildingCost->bind_param("iis", $buildingLevel, $nextLevel, $ruleName);
        $query_getBuildingCost->execute();
        $result_getBuildingCost = $query_getBuildingCost->get_result();

        $query_getUserCurrentGold = $connection->prepare("SELECT gold FROM user_account WHERE UserID = ?");
        $query_getUserCurrentGold->bind_param("i", $uid);
        $query_getUserCurrentGold->execute();
        $result_getUserCurrentGold = $query_getUserCurrentGold->get_result();

        $row_getUserCurrentGold = $result_getUserCurrentGold->fetch_array();
        
        $userCurrentGold = intval($row_getUserCurrentGold['gold']);

        $loopCount = 0;
        $prices = [];
        $buildingOutput = 0;
        while ($row_getBuildingCost = $result_getBuildingCost->fetch_array()) {
            if (empty($buildingOutput)) $buildingOutput = $row_getBuildingCost['BuildingOutput'];
            $prices[] = $row_getBuildingCost['BuildingCost'];
        }
        if (empty($prices[0])) {
            $output['status'] = true;
            $output['newcost'] = "Maximum Level";
            $output['newgoldbalance'] = $userCurrentGold;
            $output['newbuildinglevel'] = $buildingLevel-1;
        }
        else {
            if ($userCurrentGold >= $prices[0]) {
                $newGoldLevel = $userCurrentGold - $prices[0];
                $query_updateUserVillageGold = $connection->prepare(
                    "UPDATE `user_account` a 
                    JOIN `user_village` v ON (a.`UserID` = v.`UserID`) 
                    SET 
                        a.`gold` = ?, 
                        v.".$buildingName." = ? 
                    WHERE a.UserID = ?"
                );
                $query_updateUserVillageGold->bind_param("isi", $newGoldLevel, $buildingLevel, $uid);
                $query_updateUserVillageGold->execute();
                $output['status'] = true;
                $output['newcost'] = (empty($prices[1]) ? "Maximum Level" : ($prices[1] . " Gold"));
                $output['newgoldbalance'] = $newGoldLevel;
                $output['newbuildinglevel'] = $buildingLevel;
                $output['updateprod'] = false;
                $output['updategems'] = false;

                if ($buildingName === "TownHall") {
                    $output['upgradetownhall'] = true;
                }
                else if (stristr($ruleName, "Factory") || $ruleName === "Hospital") {
                    if ($buildingLevel == 1) {
                        if (stristr($ruleName, "Gold")) {
                            updateClaimTimestamp($uid, "gold");
                        }
                        else if (stristr($ruleName, "Gem")) {
                            updateClaimTimestamp($uid, "gem");
                        }
                    }
                    $prodField = $buildingName."Prod";
                    $query_updateFactoryProduction = $connection->prepare("UPDATE user_village SET ".$prodField." = ? WHERE UserID = ?");
                    $query_updateFactoryProduction->bind_param("si", $buildingOutput, $uid);
                    $query_updateFactoryProduction->execute();

                    $output['updateprod'] = true;
                    $output['newprod'] = $buildingOutput;

                    $factoryString = "";
                    if (stristr($ruleName, "Gold")) {
                        $factoryString = " Gold per Minute";
                    }
                    else if (stristr($ruleName, "Gem")) {
                        $factoryString = " Gems per Hour";
                    }
                    else if ($ruleName === "Hospital") {
                        $factoryString = "% Time Reduction";
                    }

                    $output['factorystring'] = $factoryString;

                    $getNextProdOutput = getBuildingProduction($ruleName, $nextLevel);

                    if (empty($getNextProdOutput)) {
                        $output['nextnewprod'] = "Maximum Level";
                    }
                    else {
                        $output['nextnewprod'] = getBuildingProduction($ruleName, $nextLevel).$factoryString;
                    }
                }
            }
            else {
                $output['status'] = false;
                $output['message'] = "This upgrade costs too much.";
            }
        }
    }
}
else {
    $output['status'] = false;
    $output['error'] = "No building provided.";
}