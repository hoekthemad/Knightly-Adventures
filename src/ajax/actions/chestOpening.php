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
        array_push($itemIDLoopArray, $itemAmountArray[$randonNumber]);
        array_push($itemAmountLoopArray, $itemWeightArray[$randonNumber]);

    }

    $currentTimestamp = intval(strtotime(date("Y-m-d H:i:s")));

    $typeTEMP = 'Coins';
    $amountTEMP = 0;
    $nullTEMP = null;

    $setChestLog = $connection->prepare("INSERT INTO logs_chests (UserID, Timestamp, Cost, CostType, ChestID, WinAmount, WinRarity, winItem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $setChestLog->bind_param("isisiiss", $uid, $currentTimestamp, $amountTEMP, $typeTEMP, $chestID, $itemAmountLoopArray[24], $nullTEMP, $itemNameLoopArray[24]);
    $setChestLog->execute();

    // Add it to the user's items still.



}
