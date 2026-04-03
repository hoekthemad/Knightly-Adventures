<?php

    function getChestCost($chestID) {
        global $connection;

        $getChestCost = $connection->prepare("SELECT * FROM rule_chests_cost WHERE ChestID = ?");
        $getChestCost->bind_param("s", $chestID);
        $getChestCost->execute();
    
        $result = $getChestCost->get_result();
        if ($result->num_rows >= 1) {
            $resultAssoc = $result->fetch_assoc();
            if ($resultAssoc['ChestCostType'] === 'Diamonds') {
                $resultAssoc['ChestCostType'] = 'Gems';
            }
            return $resultAssoc;
        }
    }

    function getRewardItems($chestID) {
        global $connection;

        $getChestRewards = $connection->prepare("SELECT * FROM rule_chests WHERE ChestID = ?");
        $getChestRewards->bind_param("s", $chestID);
        $getChestRewards->execute();

        $result = $getChestRewards->get_result();

        if ($result->num_rows >= 1) {

            $rewardsItemID = [];
            $rewardsItemName = [];
            $rewardsItemAmount = [];
            $rewardsItemWeight = [];
            $totalWeight = 0;

            while($row = $result->fetch_assoc()) {
                $getItemName = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getItemName->bind_param("i", $row['ItemID']);
                $getItemName->execute();
                $resultItemName = $getItemName->get_result();
                $resultItemNameArray = $resultItemName->fetch_assoc();

                array_push($rewardsItemID, $row['ItemID']);
                array_push($rewardsItemName, $resultItemNameArray['ItemName']);
                array_push($rewardsItemAmount, $row['Amount']);
                array_push($rewardsItemWeight, $row['Weight']);
                $totalWeight += $row['Weight'];

            }

            $itemArray = [];

            for ($i = 0; $i < count($rewardsItemID); $i++) {
                $itemPercent = round($rewardsItemWeight[$i] * 100 / $totalWeight, 2);
                array_push($itemArray, $rewardsItemAmount[$i]." ".$rewardsItemName[$i].": ".$itemPercent."%");
            }

            return $itemArray;

        }
    }
    
    function buildChestContainer($chestID) {
        global $connection;

        $getChestInfo = $connection->prepare("SELECT * FROM rule_chests_cost WHERE ChestID = ? ORDER BY ChestID ASC");
        $getChestInfo->bind_param("i", $chestID);
        $getChestInfo->execute();
        $resultChestInfo = $getChestInfo->get_result();

        if ($resultChestInfo->num_rows >= 1) {
            $resultChestInfoAssoc = $resultChestInfo->fetch_assoc();
            ?>
                <div class="text-center">
                    <br>
                    <?= $resultChestInfoAssoc['ChestCost']; ?> <?= $resultChestInfoAssoc['ChestCostType']; ?>
                    <br>
                    <button id="chest<?= $chestID; ?>button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chest<?= $chestID; ?>opening">
                        <span>
                            <?= $resultChestInfoAssoc['ChestName']; ?>
                        </span>
                    </button>
                </div>
                <div class="modal fade" id="chest<?= $chestID; ?>opening" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chest<?= $chestID; ?>openingLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="chest<?= $chestID; ?>openingLabel">
                                    <?= $resultChestInfoAssoc['ChestName']; ?>
                                </h1>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        $chestRewards = getRewardItems($chestID);
                                        if ($i !== 4) {
                                            ?>
                                            <span id="chest<?= $chestID; ?>result<?= ($i + 1); ?>">
                                                <?= $chestRewards[$i]; ?>
                                            </span>
                                            <br>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <span id="chest<?= $chestID; ?>result<?= ($i + 1); ?>">
                                            <?php
                                            for ($i = 4; $i < count($chestRewards); $i++){
                                                ?>
                                                    <?= $chestRewards[$i]; ?>
                                                    <br>
                                                <?php
                                            }
                                            ?>
                                            </span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="chestclaim<?= $chestID; ?>button" type="button" class="btn btn-primary" onclick="openChest(<?= $chestID; ?>)">
                                    Open
                                </button>
                                <button id="chestclose<?= $chestID; ?>button" type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            <?php
        }
    }
