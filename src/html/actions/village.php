<?php require_once 'src/utils/actions/village.php'; ?>
<script src="src/javascript/actions/village.js"></script>
<?php
getBuildingMaxLevels();

$userVillage = getUserVillage();
$userVillageNextGoldFactory1 = getRulesVillageNextLevel("GoldFactory1", "Gold Factory");
$userVillageNextGoldFactory2 = getRulesVillageNextLevel("GoldFactory2", "Gold Factory");
$userVillageNextGoldFactory3 = getRulesVillageNextLevel("GoldFactory3", "Gold Factory");
$userVillageNextGoldFactory4 = getRulesVillageNextLevel("GoldFactory4", "Gold Factory");
$userVillageNextGemFactory1 = getRulesVillageNextLevel("GemFactory1", "Gem Factory");
$userVillageNextGemFactory2 = getRulesVillageNextLevel("GemFactory2", "Gem Factory");
$userVillageNextHospital = getRulesVillageNextLevel("Hospital", "Hospital");
?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Town Hall</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Main Building</h6>
                    <p class="card-text">This building determines the max level for all other buildings.</p>
                    <p class="card-text">Level: <span id="townhalllevel"><?= $userVillage['TownHall'] ?></span></p>
                    <?php
                    if ($userVillage['TownHall'] < $_SESSION['max_building_levels']['Town Hall']) {
                        $userVillageNextTownHall = getRulesVillageNextLevel("TownHall", "TownHall");
                    ?>
                    <a class="card-link" data-bs-toggle="modal" data-bs-target="#townHallModal" id="TownHallModalLink" href="#">Upgrade</a>
                    <div class="modal fade" id="townHallModal" tabindex="-1" aria-labelledby="townHallModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="townHallModal">Upgrade Town Hall</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Cost to Upgrade:
                                    <span id="townhallcost">
                                        <?= $userVillageNextTownHall['BuildingCost']; ?> Gold
                                    </span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="upgradeBuilding('TownHall')">Upgrade</button>
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
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Hospital</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Support Building</h6>
                        <p class="card-text">This building determines the speed at which your heroes heal.</p>
                        <p class="card-text">Level: <span id="hospitallevel"><?= $userVillage['Hospital'] ?></span></p>
                        <p class="card-text">Bonus: -<span id="hospitalprod"><?= $userVillage['HospitalProd'] ?></span>%</p>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#hospitalModal" href="#">Upgrade</a>
                        <div class="modal fade" id="hospitalModal" tabindex="-1" aria-labelledby="hospitalModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="hospitalModal">Upgrade Hospital</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Cost to Upgrade:
                                        <span id="hospitalcost">
                                            <?= $userVillageNextHospital['BuildingCost']; ?> Gold
                                        </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="upgradeBuilding('Hospital')">Upgrade</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Gold Factories</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Production Building</h6>
                    <p class="card-text">These buildings help generate passive gold income.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Factory 1 Level: <span id="goldfactory1level"><?= $userVillage['GoldFactory1'] ?></span>
                        <br><span id="goldfactory1prod"><?= $userVillage['GoldFactory1Prod'] ?></span> Gold per minute.
                        <br>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#goldFactory1Modal" href="#">Upgrade</a>
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
                                            <?= $userVillageNextGoldFactory1['BuildingCost']." ".$userVillageNextGolfFactory1['BuildingCostType']; ?>
                                        </span>
                                        <br>
                                        Next Level Bonus:
                                        <span id="goldfactory1bonus">
                                            <?= $userVillageNextGoldFactory1['BuildingOutput']." Gold per Minute."; ?>
                                        </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="upgradeBuilding('GoldFactory1')">Upgrade</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <li class="list-group-item">Factory 2 Level: <span id="goldfactory2level"><?= $userVillage['GoldFactory2'] ?></span>
                        <br><span id="goldfactory2prod"><?= $userVillage['GoldFactory2Prod'] ?></span> Gold per minute.
                        <br>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#goldFactory2Modal" href="#">Upgrade</a>
                        <div class="modal fade" id="goldFactory2Modal" tabindex="-1" aria-labelledby="goldFactory2Modal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="goldFactory2Modal">Upgrade Gold Factory 2</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Cost to Upgrade:
                                        <span id="goldfactory2cost">
                                            <?= $userVillageNextGoldFactory2['BuildingCost']." ".$userVillageNextGoldFactory2['BuildingCostType']; ?>
                                        </span>
                                        <br>
                                        Next Level Bonus:
                                        <span id="goldfactory2bonus">
                                            <?= $userVillageNextGoldFactory2['BuildingOutput']." Gold per Minute."; ?>
                                        </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary"  onclick="upgradeBuilding('GoldFactory2')">Upgrade</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">Factory 3 Level: <span id="goldfactory3level"><?= $userVillage['GoldFactory3'] ?></span>
                        <br><span id="goldfactory3prod"><?= $userVillage['GoldFactory3Prod'] ?></span> Gold per minute.
                        <br>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#goldFactory3ModalLabel" href="#">Upgrade</a>
                        <div class="modal fade" id="goldFactory3ModalLabel" tabindex="-1" aria-labelledby="goldFactory3ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="goldFactory3ModalLabel">Upgrade Gold Factory 3</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Cost to Upgrade:
                                        <span id="goldfactory3cost">
                                            <?= $userVillageNextGoldFactory3['BuildingCost']." ".$userVillageNextGoldFactory3['BuildingCostType']; ?>
                                        </span>
                                        <br>
                                        Next Level Bonus:
                                        <span id="goldfactory3bonus">
                                            <?= $userVillageNextGoldFactory3['BuildingOutput']." Gold per Minute."; ?>
                                        </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="upgradeBuilding('GoldFactory3')">Upgrade</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">Factory 4 Level: <span id="goldfactory4level"><?= $userVillage['GoldFactory4'] ?></span>
                        <br><span id="goldfactory4prod"><?= $userVillage['GoldFactory4Prod'] ?></span> Gold per minute.
                        <br>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#goldFactory4Modal" href="#">Upgrade</a>
                        <div class="modal fade" id="goldFactory4Modal" tabindex="-1" aria-labelledby="goldFactory4Modal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="goldFactory4Modal">Upgrade Gold Factory 4</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Cost to Upgrade:
                                        <span id="goldfactory4cost">
                                            <?= $userVillageNextGoldFactory4['BuildingCost']." ".$userVillageNextGoldFactory4['BuildingCostType']; ?>
                                        </span>
                                        <br>
                                        Next Level Bonus:
                                        <span id="goldfactory4bonus">
                                            <?= $userVillageNextGoldFactory4['BuildingOutput']." Gold per Minute."; ?>
                                        </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="upgradeBuilding('GoldFactory4')">Upgrade</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Gem Factories</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Production Building</h6>
                    <p class="card-text">These buildings help generate passive gem income.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Factory 1 Level: <span id="gemfactory1level"><?= $userVillage['GemFactory1'] ?></span>
                        <br><span id="gemfactory1prod"><?= $userVillage['GemFactory1Prod'] ?></span> Gems per 30 minutes.
                        <br>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#gemFactory1Modal" href="#">Upgrade</a>
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
                                            <?= $userVillageNextGemFactory1['BuildingCost']; ?> Gold (Maybe gems...)
                                        </span>
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
                        <br><span id="gemfactory2prod"><?= $userVillage['gemfactory2Prod'] ?></span> Gems per 30 minutes.
                        <br>
                        <a class="card-link" data-bs-toggle="modal" data-bs-target="#gemFactory2Modal" href="#">Upgrade</a>
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
                                            <?= $userVillageNextGemFactory2['BuildingCost']; ?> Gold (Maybe gems...)
                                        </span>
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
