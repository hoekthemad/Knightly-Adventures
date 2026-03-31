<?php require_once 'src/utils/actions/chest.php'; ?>
<script src="src/javascript/actions/chest.js"></script>
<?php
$chest1Cost = getChestCost(1);
$chest2Cost = getChestCost(2);
$chest1Rewards = getRewardItems(1);
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
                                <span id="chest1result1"> <?= $chest1Rewards ?></span>
                                <br>
                                <span id="chest1result2"></span>
                                <br>
                                <span id="chest1result3"></span>
                                <br>
                                <span id="chest1result4"></span>
                                <br>
                                <span id="chest1result5"></span>
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
                <button id="chest2button" onclick="openChest(2)">Not Set Up</button>
                <div>
                    <span id="chest2result1"></span>
                    <br>
                    <span id="chest2result2"></span>
                    <br>
                    <span id="chest2result3"></span>
                    <br>
                    <span id="chest2result4"></span>
                    <br>
                    <span id="chest2result5"></span>
                    <br>
                    <span id="chest2result6"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">

            </div>
        </div>
    </div>
</div>