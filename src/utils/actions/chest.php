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