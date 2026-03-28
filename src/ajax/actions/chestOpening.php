<?php

$chestID = !empty($_REQUEST['chest']) ? $_REQUEST['chest'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$output['chestid'] = $chestID;

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

        $randonNumber = mt_rand(0, count($itemIDArray) - 1);

        $getItemName = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
        $getItemName->bind_param("i", $itemIDArray[$randonNumber]);
        $getItemName->execute();
        $resultItemName = $getItemName->get_result();
        $resultItemNameArray = $resultItemName->fetch_array();

        array_push($itemNameLoopArray, $resultItemNameArray['ItemName']);
        array_push($itemIDLoopArray, $itemIDArray[$randonNumber]);
        array_push($itemAmountLoopArray, $itemAmountArray[$randonNumber]);

    }

    $currentTimestamp = intval(strtotime(date("Y-m-d H:i:s")));
    $winningItem = 24;

    $output['winitemname'] = $itemNameLoopArray[$winningItem];
    $output['winitemamount'] = $itemAmountLoopArray[$winningItem];

    $typeTEMP = 'Coins';
    $amountTEMP = 0;
    $nullTEMP = null;

    $setChestLog = $connection->prepare("INSERT INTO logs_chests (UserID, Timestamp, Cost, CostType, ChestID, WinAmount, WinRarity, winItem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $setChestLog->bind_param("isisiiss", $uid, $currentTimestamp, $amountTEMP, $typeTEMP, $chestID, $itemAmountLoopArray[$winningItem], $nullTEMP, $itemNameLoopArray[$winningItem]);
    $setChestLog->execute();

    // Add it to the user's items still.
    $getUserItem = $connection->prepare("SELECT * FROM user_items WHERE ItemID = ?");
    $getUserItem->bind_param("i", $itemIDLoopArray[$winningItem]);
    $getUserItem->execute();
    $resultUserItem = $getUserItem->get_result();
    $resultUserItemAssoc = $resultUserItem->fetch_assoc();

    $output ['test3'] = $resultUserItemAssoc;

    if ($resultUserItemAssoc['ItemID']) {
        $userItemAmount = $resultUserItemAssoc['Amount'] + $itemAmountLoopArray[$winningItem];
        $userItemTotal = $resultUserItemAssoc['Total'] + $itemAmountLoopArray[$winningItem];

        $giveUserItems = $connection->prepare("UPDATE user_items SET Amount=?, Total=? WHERE UserID=? AND ItemID=?");
        $giveUserItems->bind_param("iiii", $userItemAmount, $userItemTotal, $uid, $itemIDLoopArray[$winningItem]);
        $giveUserItems->execute();
    }
    
    else {

        $giveUserItem = $connection->prepare("INSERT INTO user_items (UserID, ItemID, Rarity, Amount, Total) VALUES (?, ?, ?, ?, ?)");
        $giveUserItem->bind_param("iisii", $uid, $itemIDLoopArray[$winningItem], $nullTEMP, $itemAmountLoopArray[$winningItem], $itemAmountLoopArray[$winningItem]);
        $giveUserItem->execute();

    }


}
