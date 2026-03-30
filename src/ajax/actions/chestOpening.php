<?php

$chestID = !empty($_REQUEST['chest']) ? $_REQUEST['chest'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$getChestItems = $connection->prepare("SELECT * FROM rule_chests WHERE ChestID = ?");
$getChestItems->bind_param("i", $chestID);
$getChestItems->execute();

$resultChestItems = $getChestItems->get_result();

if ($resultChestItems->num_rows >= 1) {

    $output['status'] = true;

    $itemIDArray = [];
    $itemAmountArray = [];
    $itemWeightArray = [];
    $weightTotal = 0;

    $loopCount1 = 1;
    while ($row = $resultChestItems->fetch_assoc()) {
        $weightTotal += $row['weight'];
        array_push($itemIDArray, $row['ItemID']);
        array_push($itemAmountArray, $row['Amount']);
        array_push($itemWeightArray, $row['Weight']);
        $weightTotal += $row['Weight'];
        $loopCount1 += 1;
    }

    $itemNameLoopArray = [];
    $itemIDLoopArray = [];
    $itemAmountLoopArray = [];

    for ($i = 0; $i < 30; $i++) {
        for ($i2 = 0; $i2 < count($itemIDArray); $i2++) {

            $randomNumber = mt_rand(0, $weightTotal);
            $sumNumber = 0;
            $sumNumber += $itemWeightArray[$i2];

            if ($randomNumber <= $sumNumber) {

                $getItemName = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getItemName->bind_param("i", $itemIDArray[$i2]);
                $getItemName->execute();
                $resultItemName = $getItemName->get_result();
                $resultItemNameArray = $resultItemName->fetch_array();

                array_push($itemNameLoopArray, $resultItemNameArray['ItemName']);
                array_push($itemIDLoopArray, $itemIDArray[$i2]);
                array_push($itemAmountLoopArray, $itemAmountArray[$i2]);

                $output['itemname'.$i] = $resultItemNameArray['ItemName'];
                $output['itemamount'.$i] = $itemAmountArray[$i2];

            }
        }
    }

    $currentTimestamp = intval(strtotime(date("Y-m-d H:i:s")));
    $winningItem = 24;

    $output['winitemname'] = $itemNameLoopArray[$winningItem];
    $output['winitemid'] = $itemIDLoopArray[$winningItem];
    $output['winitemamount'] = $itemAmountLoopArray[$winningItem];

    $rarityValue = null;

    if ($itemIDLoopArray[$winningItem] > 10000 && $itemIDLoopArray[$winningItem] < 30000) {
        $randonRarityNumber = mt_rand(0, 100);

        $getItemRarity = $connection->prepare("SELECT * FROM rule_rarity WHERE Percent > ? ORDER BY Percent ASC");
        $getItemRarity->bind_param("i", $randonRarityNumber);
        $getItemRarity->execute();
        $resultItemRarity = $getItemRarity->get_result();
        $resultItemRarityAssoc = $resultItemRarity->fetch_assoc();

        $rarityValue = $resultItemRarityAssoc['Rarity'];
        $output['rarity'] = $rarityValue;
    }





    $typeTEMP = 'Coins';
    $amountTEMP = 0;





    $setChestLog = $connection->prepare("INSERT INTO logs_chests (UserID, Timestamp, Cost, CostType, ChestID, WinAmount, WinRarity, winItem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $setChestLog->bind_param("isisiiss", $uid, $currentTimestamp, $amountTEMP, $typeTEMP, $chestID, $itemAmountLoopArray[$winningItem], $rarityValue, $itemNameLoopArray[$winningItem]);
    $setChestLog->execute();

    $getUserItem = $connection->prepare("SELECT * FROM user_items WHERE ItemID = ? AND Rarity = ?");
    $getUserItem->bind_param("is", $itemIDLoopArray[$winningItem], $rarityValue);
    $getUserItem->execute();
    $resultUserItem = $getUserItem->get_result();
    $resultUserItemAssoc = $resultUserItem->fetch_assoc();

    if ($resultUserItemAssoc['ItemID']) {
        $userItemAmount = $resultUserItemAssoc['Amount'] + $itemAmountLoopArray[$winningItem];
        $userItemTotal = $resultUserItemAssoc['Total'] + $itemAmountLoopArray[$winningItem];

        $giveUserItems = $connection->prepare("UPDATE user_items SET Amount = ?, Total = ? WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
        $giveUserItems->bind_param("iiiis", $userItemAmount, $userItemTotal, $uid, $itemIDLoopArray[$winningItem], $rarityValue);
        $giveUserItems->execute();
    }
    
    else {

        $giveUserItem = $connection->prepare("INSERT INTO user_items (UserID, ItemID, Rarity, Amount, Total) VALUES (?, ?, ?, ?, ?)");
        $giveUserItem->bind_param("iisii", $uid, $itemIDLoopArray[$winningItem], $rarityValue, $itemAmountLoopArray[$winningItem], $itemAmountLoopArray[$winningItem]);
        $giveUserItem->execute();

    }

}
