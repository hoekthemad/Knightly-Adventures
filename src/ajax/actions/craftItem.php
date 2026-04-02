<?php

$materialID = !empty($_REQUEST['material']) ? $_REQUEST['material'] : false;
$toCraftID = !empty($_REQUEST['craft']) ? $_REQUEST['craft'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$getUserAmount = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ?");
$getUserAmount->bind_param("ii", $uid, $materialID);
$getUserAmount->execute();
$resultUserAmount = $getUserAmount->get_result();
$resultUserAmountAssoc = $resultUserAmount->fetch_assoc();

$getNeededCraftAmount = $connection->prepare("SELECT * FROM rule_craft WHERE ItemID = ? AND CraftItemID = ?");
$getNeededCraftAmount->bind_param("ii", $materialID, $toCraftID);
$getNeededCraftAmount->execute();
$resultNeededCraftAmount = $getNeededCraftAmount->get_result();
$resultNeededCraftAmountAssoc = $resultNeededCraftAmount->fetch_assoc();

if ($resultUserAmountAssoc['Amount'] >= $resultNeededCraftAmountAssoc['AmountNeeded']) {

    $output['status'] = true;

    $newAmount = $resultUserAmountAssoc['Amount'] - $resultNeededCraftAmountAssoc['AmountNeeded'];

    $setNewItemAmount = $connection->prepare("UPDATE user_items SET Amount = ? WHERE UserID = ? AND ItemID = ?");
    $setNewItemAmount->bind_param("iii", $newAmount, $uid, $materialID);
    $setNewItemAmount->execute();

    $getuserNewItem = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ?");
    $getuserNewItem->bind_param("ii", $uid, $toCraftID);
    $getuserNewItem->execute();
    $resultUserNewItem = $getuserNewItem->get_result();
    $resultUserNewItemAssoc = $resultUserNewItem->fetch_assoc();

    $itemAmount = 1;
    $itemRarity = null;

    if ($toCraftID >= 10000) {
        $randonRarityNumber = mt_rand(0, 100);

        $getItemRarity = $connection->prepare("SELECT * FROM rule_rarity WHERE Percent > ? ORDER BY Percent ASC");
        $getItemRarity->bind_param("i", $randonRarityNumber);
        $getItemRarity->execute();
        $resultItemRarity = $getItemRarity->get_result();
        $resultItemRarityAssoc = $resultItemRarity->fetch_assoc();

        $itemRarity = $resultItemRarityAssoc['Rarity'];

        $getUserNewItem = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
        $getUserNewItem->bind_param("iis", $uid, $toCraftID, $itemRarity);
        $getUserNewItem->execute();
        $resultUserNewItem = $getUserNewItem->get_result();
        $resultUserNewItemAssoc = $resultUserNewItem->fetch_assoc();

        if ($resultUserNewItemAssoc['ItemID']) {
            $userItemAmount = $resultUserNewItemAssoc['Amount'] + $itemAmount;
            $userItemTotal = $resultUserNewItemAssoc['Total'] + $itemAmount;

            $giveUserItems = $connection->prepare("UPDATE user_items SET Amount = ?, Total = ? WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
            $giveUserItems->bind_param("iiiis", $userItemAmount, $userItemTotal, $uid, $toCraftID, $itemRarity);
            $giveUserItems->execute();
        }

        else {
            $giveUserItem = $connection->prepare("INSERT INTO user_items (UserID, ItemID, Rarity, Amount, Total) VALUES (?, ?, ?, ?, ?)");
            $giveUserItem->bind_param("iisii", $uid, $toCraftID, $itemRarity, $itemAmount, $itemAmount);
            $giveUserItem->execute();
        }

    }
    else {

        $getUserNewItem = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ?");
        $getUserNewItem->bind_param("ii", $uid, $toCraftID);
        $getUserNewItem->execute();
        $resultUserNewItem = $getUserNewItem->get_result();
        $resultUserNewItemAssoc = $resultUserNewItem->fetch_assoc();

        if ($resultUserNewItemAssoc['ItemID']) {
            $userItemAmount = $resultUserNewItemAssoc['Amount'] + $itemAmount;
            $userItemTotal = $resultUserNewItemAssoc['Total'] + $itemAmount;

            $giveUserItems = $connection->prepare("UPDATE user_items SET Amount = ?, Total = ? WHERE UserID = ? AND ItemID = ?");
            $giveUserItems->bind_param("iiii", $userItemAmount, $userItemTotal, $uid, $toCraftID);
            $giveUserItems->execute();
        }

        else {
            $giveUserItem = $connection->prepare("INSERT INTO user_items (UserID, ItemID, Amount, Total) VALUES (?, ?, ?, ?, ?)");
            $giveUserItem->bind_param("iiii", $uid, $toCraftID, $itemAmount, $itemAmount);
            $giveUserItem->execute();
        }
    }

}