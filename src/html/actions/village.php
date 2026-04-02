<?php require_once 'src/utils/actions/village.php'; ?>
<script src="src/javascript/actions/village.js"></script>
<?php
getBuildingMaxLevels();
$userVillage = getUserVillage();

$buildingNameNoSpaceLowerCase = ["townhall", "hospital", "goldfactory"];
$buildingNameNoSpace = ["TownHall", "Hospital", "GoldFactory"];
$buildingNameSpace = ["Town Hall", "Hospital", "Gold Factory"];

$row1Count = 2;
$row2Count = 3;
$row3Count = 4;

$goldFactoryNumber = 4;
$gemFactoryNumber = 2;
?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4">
            <?php
            for ($i = 0; $i < $row1Count; $i++) {
                $getBuildingInfo = $connection->prepare("SELECT * FROM rule_village_desc WHERE BuildingName = ?");
                $getBuildingInfo->bind_param("s", $buildingNameSpace[$i]);
                $getBuildingInfo->execute();
                $resultBuildingInfo = $getBuildingInfo->get_result();
                $resultBuildingInfoassoc = $resultBuildingInfo->fetch_assoc();
                ?>
                <div class="card" style="width: 14rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $buildingNameSpace[$i] ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <?= $resultBuildingInfoassoc['BuildingType'] ?>
                        </h6>
                        <p class="card-text">
                            <?= $resultBuildingInfoassoc['BuildingDesc'] ?>
                        </p>
                        <p class="card-text">
                            <span id="<?= $buildingNameNoSpaceLowerCase[$i]; ?>level">
                                Level: <?= $userVillage[$buildingNameNoSpace[$i]]; ?>
                            </span>
                            <?php
                            if ($resultBuildingInfoassoc['BuildingOutputDesc']) {
                                ?>
                                <p class="card-text">
                                    Bonus:
                                    <span id="<?= $buildingNameNoSpaceLowerCase[$i]; ?>prod">
                                        <?= $userVillage[$buildingNameNoSpace[$i].'Prod'] ?><?= $resultBuildingInfoassoc['BuildingOutputDesc'] ?>
                                    </span>
                                </p>
                                <?php
                            }
                            ?>
                        </p>
                        <?php
                        if ($userVillage[$buildingNameNoSpace[$i]] < $_SESSION['max_building_levels'][$buildingNameSpace[$i]]) {
                            $userVillageNext = getRulesVillageNextLevel($buildingNameNoSpace[$i], $buildingNameSpace[$i]);
                            ?>
                            <a class="card-link" data-bs-toggle="modal" data-bs-target="#<?= $buildingNameNoSpace[$i]; ?>Modal" id="<?= $buildingNameNoSpace[$i]; ?>ModalLink" href="#">
                                Upgrade
                            </a>
                            <div class="modal fade" id="<?= $buildingNameNoSpace[$i]; ?>Modal" tabindex="-1" aria-labelledby="<?= $buildingNameNoSpace[$i]; ?>Modal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="<?= $buildingNameNoSpace[$i] ?>Modal">Upgrade <?= $buildingNameSpace[$i]; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Cost to Upgrade:
                                            <span id="<?= $buildingNameNoSpaceLowerCase[$i]; ?>cost">
                                                <?= $userVillageNext['BuildingCost']; ?> <?= $userVillageNext['BuildingCostType']; ?>
                                            </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="upgradeBuilding('<?= $buildingNameNoSpace[$i]; ?>')">Upgrade</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <br>
                <?php
            }
            ?>
        </div>
        <div class="col-md-4">
            <?php
            for ($i = $row1Count; $i < $row2Count; $i++) {
                $getBuildingInfo = $connection->prepare("SELECT * FROM rule_village_desc WHERE BuildingName = ?");
                $getBuildingInfo->bind_param("s", $buildingNameSpace[$i]);
                $getBuildingInfo->execute();
                $resultBuildingInfo = $getBuildingInfo->get_result();
                $resultBuildingInfoassoc = $resultBuildingInfo->fetch_assoc();
                ?>
                <div class="card" style="width: 14rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $buildingNameSpace[$i] ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?= $resultBuildingInfoassoc['BuildingType'] ?>
                    </h6>
                    <p class="card-text">
                        <?= $resultBuildingInfoassoc['BuildingDesc'] ?>
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    for ($i2 = 1; $i2 < ($goldFactoryNumber + 1); $i2++) {
                        ?>
                        <li class="list-group-item">
                            Factory <?= $i2; ?> Level: 
                            <span id="<?= $buildingNameNoSpaceLowerCase; ?><?= $i2; ?>level">
                                <?= $userVillage[$buildingNameNoSpace[$i].$i2]; ?>
                            </span>
                            <br>
                            <span id="<?= $buildingNameNoSpaceLowerCase[$i].$i2; ?>prod">
                                <?= $userVillage[$buildingNameNoSpace[$i].$i2.'Prod']; ?> <?= $resultBuildingInfoassoc['BuildingOutputTime']; ?>
                            </span>
                            <br>
                            <!-- Set up invis button... -->
                            <?php
                                if ($userVillage[$buildingNameNoSpace[$i]] < $_SESSION['max_building_levels'][$buildingNameSpace[$i]]) {
                                    $userVillageNext = getRulesVillageNextLevel($buildingNameNoSpace[$i], $buildingNameSpace[$i]);
                                    ?>
                                    <!-- -->
                                    <?php
                                }
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <br>
                <?php
            }
            ?>
        </div>
    </div>
</div>




<!--
<div class="container">
    <br>
    <div class="row">

                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#goldFactory1Modal" id="GoldFactory1ModalLink" href="#">Upgrade</a>
                        <div class="modal fade" id="goldFactory1Modal" tabindex="-1" aria-labelledby="goldFactory1ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="goldFactory1ModalLabel">Upgrade Gold Factory 1</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Cost to Upgrade:
                                        <span id="goldfactory1cost">
                                            <?= $userVillageNextGoldFactory1['BuildingCost']." ".$userVillageNextGoldFactory1['BuildingCostType']; ?>
                                        </span>
                                        <br>
                                        Next Level:
                                        <span id="goldfactory1bonus">
                                            <?= $userVillageNextGoldFactory1['BuildingOutput']." ".$userVillageNextGoldFactory1['BuildingCostType']." ".$userVillageNextGoldFactory1['BuildingOutputTime']; ?>
                                        </span>
                                        <br>
                                        <span id="goldfactory1level"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="upgradeBuilding('GoldFactory1')">Upgrade</button>
                                    </div>
                                </div>
                            </div>
                        </div>

        <div class="col-md-4">
            <div class="card" style="width: 14rem;">
                <div class="card-body">
                    <h5 class="card-title">Gem Factories</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Production Building</h6>
                    <p class="card-text">These buildings help generate passive gem income.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Factory 1 Level: <span id="gemfactory1level"><?= $userVillage['GemFactory1'] ?></span>
                        <br>
                        <span id="gemfactory1prod">
                            <?= $userVillage['GemFactory1Prod']." ".$userVillageNextGemFactory1['BuildingCostType']." ".$userVillageNextGemFactory1['BuildingOutputTime']; ?>
                        </span>
                        <br>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#gemFactory1Modal" id="GemFactory1ModalLink" href="#">Upgrade</a>
                        <div class="modal fade" id="gemFactory1Modal" tabindex="-1" aria-labelledby="gemFactory1Modal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="gemFactory1Modal">Upgrade Gem Factory 1</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Cost to Upgrade:
                                        <span id="gemfactory1cost">
                                            <?= $userVillageNextGemFactory1['BuildingCost']." ".$userVillageNextGemFactory1['BuildingCostType']; ?>
                                        </span>
                                        <br>
                                        Next Level:
                                        <span id=gemfactory1bonus">
                                            <?= $userVillageNextGemFactory1['BuildingOutput']." ".$userVillageNextGemFactory1['BuildingCostType']." ".$userVillageNextGemFactory1['BuildingOutputTime']; ?>
                                        </span>
                                        <br>
                                        <span id="gemfactory1townhalllevel"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="upgradeBuilding('GemFactory1')">Upgrade</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">Factory 2 Level: <span id="gemfactory2level"><?= $userVillage['GemFactory2'] ?></span>
                        <br>
                        <span id="gemfactory2prod">
                            <?= $userVillage['GemFactory2Prod']." ".$userVillageNextGemFactory2['BuildingCostType']." ".$userVillageNextGemFactory2['BuildingOutputTime']; ?>
                        </span>
                        <br>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#gemFactory2Modal" id="GemFactory2ModalLink" href="#">Upgrade</a>
                        <div class="modal fade" id="gemFactory2Modal" tabindex="-1" aria-labelledby="gemFactory2Modal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="gemFactory2Modal">Upgrade Gem Factory 2</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Cost to Upgrade:
                                        <span id="gemfactory2cost">
                                            <?= $userVillageNextGemFactory2['BuildingCost']." ".$userVillageNextGemFactory2['BuildingCostType']; ?>
                                        </span>
                                        <br>
                                        Next Level:
                                        <span id="gemfactory2bonus">
                                            <?= $userVillageNextGemFactory2['BuildingOutput']." ".$userVillageNextGemFactory2['BuildingCostType']." ".$userVillageNextGemFactory2['BuildingOutputTime']; ?>
                                        </span>
                                        <br>
                                        <span id="gemfactory2townhalllevel"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="upgradeBuilding('GemFactory2')">Upgrade</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        
    </div>
</div>
-->