<?php require_once 'src/utils/actions/chest.php'; ?>
<script src="src/javascript/actions/chest.js"></script>
<?php
$chest1Cost = getChestCost(1);
$chest2Cost = getChestCost(2);
$chest1Rewards = getRewardItems(1);
$chest2Rewards = getRewardItems(2);
?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                Cost to open:
                <br>
                <?= $chest1Cost['ChestCost'] ?> <?= $chest1Cost['ChestCostType'] ?>
                <br>
                <button id="chest1button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chest1opening">
                    Starting Chest
                </button>
            </div>
            <div class="modal fade" id="chest1opening" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chest1openingLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="chest1openingLabel">Starting Chest</h1>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <span id="chest1result1"><?= $chest1Rewards[0] ?></span>
                                <br>
                                <span id="chest1result2"><?= $chest1Rewards[1] ?></span>
                                <br>
                                <span id="chest1result3"><?= $chest1Rewards[2] ?></span>
                                <br>
                                <span id="chest1result4"><?= $chest1Rewards[3] ?></span>
                                <br>
                                <span id="chest1result5"><?= $chest1Rewards[4] ?>
                                <?php
                                for ($i = 5; $i < count($chest1Rewards); $i++){
                                    ?>
                                    <br><?= $chest1Rewards[$i] ?>
                                    <?php
                                }
                                ?>
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="chestclaim1button" type="button" class="btn btn-primary" onclick="openChest(1)">Open</button>
                            <button id="chestclose1button" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                Cost to open:
                <br>
                <?= $chest2Cost['ChestCost'] ?> <?= $chest2Cost['ChestCostType'] ?>
                <br>
                <button id="chest2button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chest2opening">
                    Starting Chest
                </button>
            </div>
            <div class="modal fade" id="chest2opening" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chest1openingLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="chest2openingLabel">Starting Chest</h1>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <span id="chest2result1"><?= $chest2Rewards[0] ?></span>
                                <br>
                                <span id="chest2result2"><?= $chest2Rewards[1] ?></span>
                                <br>
                                <span id="chest2result3"><?= $chest2Rewards[2] ?></span>
                                <br>
                                <span id="chest2result4"><?= $chest2Rewards[3] ?></span>
                                <br>
                                <span id="chest2result5"><?= $chest2Rewards[4] ?>
                                <?php
                                for ($i = 5; $i < count($chest2Rewards); $i++){
                                    ?>
                                    <br><?= $chest2Rewards[$i] ?>
                                    <?php
                                }
                                ?>
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="chestclaim2button" type="button" class="btn btn-primary" onclick="openChest(2)">Open</button>
                            <button id="chestclose2button" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">

            </div>
        </div>
    </div>
</div>