<?php

$heroNumber = !empty($_REQUEST['hero']) ? $_REQUEST['hero'] : false;
$itemID = !empty($_REQUEST['item']) ? $_REQUEST['item'] : false;
$rarityValue = !empty($_REQUEST['rarity']) ? $_REQUEST['rarity'] : false;
$itemType = !empty($_REQUEST['type']) ? $_REQUEST['type'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$output['status'] = true;
$output['hero'] = $heroNumber;
$output['item'] = $itemID;
$output['rarity'] = $rarityValue;
$output['type'] = $itemType;

$getItemAmount = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
$getItemAmount->bind_param("iis", $uid, $itemID, $rarityValue);
$getItemAmount->execute();
$resultItemAmount = $getItemAmount->get_result();
$resultItemAmountAssoc = $resultItemAmount->fetch_assoc();

if ($resultItemAmountAssoc['Amount'] >= 1) {

    $getHero = $connection->prepare("SELECT * FROM user_heroes WHERE UserID = ? AND HeroNumber = ?");
    $getHero->bind_param("ii", $uid, $heroNumber);
    $getHero->execute();
    $resultHero = $getHero->get_result();

    if ($resultHero->num_rows >= 1) {

        $resultHeroAssoc = $resultHero->fetch_assoc();

        if ($resultHeroAssoc[$itemType]) {

            $oldItemID = $resultHeroAssoc[$itemType];
            $oldItemRarity = $resultHeroAssoc[$itemType.'Rarity'];

            $getOldItemAmount = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ?");
            $getOldItemAmount->bind_param("ii", $uid, $oldItemID);
            $getOldItemAmount->execute();
            $resultOldItemAmount = $getOldItemAmount->get_result();

            if ($resultOldItemAmount->num_rows >= 1) {
                $resultOldItemAmountAssoc = $resultOldItemAmount->fetch_assoc();

                $oldItemAmount = $resultOldItemAmountAssoc['Amount'] + 1;

                $setOldItemAmount = $connection->prepare("UPDATE user_items SET Amount = ? WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
                $setOldItemAmount->bind_param("iiis", $oldItemAmount, $uid, $oldItemID, $oldItemRarity);
                $setOldItemAmount->execute();

            }

            if ($itemType === 'Armor') {
            $updateUserBonus = $connection->prepare("UPDATE user_heroes SET BonusDefense = 0 WHERE UserID = ? AND HeroNumber = ?");
            $updateUserBonus->bind_param("iiis", $uid, $heroNumber);
            $updateUserBonus->execute();
            }
            else if ($itemType === 'Weapon') {
                $updateUserBonus = $connection->prepare("UPDATE user_heroes SET BonusAttack = 0 WHERE UserID = ? AND HeroNumber = ?");
                $updateUserBonus->bind_param("iiis", $uid, $heroNumber);
                $updateUserBonus->execute();
            }

        }

        $getItemAmount2 = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
        $getItemAmount2->bind_param("iis", $uid, $itemID, $rarityValue);
        $getItemAmount2->execute();
        $resultItemAmount2 = $getItemAmount2->get_result();
        $resultItemAmountAssoc2 = $resultItemAmount2->fetch_assoc();

        $output['status'] = true;

        $newItemAmount = $resultItemAmountAssoc2['Amount'] - 1;

        $setNewItemAmount = $connection->prepare("UPDATE user_items SET Amount = ? WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
        $setNewItemAmount->bind_param("iiis", $newItemAmount, $uid, $itemID, $rarityValue);
        $setNewItemAmount->execute();

        $setHeroItem = $connection->prepare("UPDATE user_heroes SET $itemType = ?, {$itemType}Rarity = ? WHERE UserID = ? AND HeroNumber = ?");
        $setHeroItem->bind_param("isii", $itemID, $rarityValue, $uid, $heroNumber);
        $setHeroItem->execute();

        $getItemBonus = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
        $getItemBonus->bind_param("i", $itemID);
        $getItemBonus->execute();
        $resultItemBonus= $getItemBonus->get_result();
        $resultItemBonusAssoc = $resultItemBonus->fetch_assoc();

        $getItemRarityBonus = $connection->prepare("SELECT * FROM rule_rarity WHERE Rarity = ?");
        $getItemRarityBonus->bind_param("s", $rarityValue);
        $getItemRarityBonus->execute();
        $resultItemRarityBonus= $getItemRarityBonus->get_result();
        $resultItemRarityBonusAssoc = $resultItemRarityBonus->fetch_assoc();

        if ($itemType === 'Armor') {
            $updateBonus = round($resultItemBonusAssoc['DefenseBonus'] * $resultItemRarityBonusAssoc['Bonus']);

            $updateUserBonus = $connection->prepare("UPDATE user_heroes SET BonusDefense = ? WHERE UserID = ? AND HeroNumber = ?");
            $updateUserBonus->bind_param("iii", $updateBonus, $uid, $heroNumber);
            $updateUserBonus->execute();
        }
        else if ($itemType === 'Weapon') {
            $updateBonus = round($resultItemBonusAssoc['AttackBonus'] * $resultItemRarityBonusAssoc['Bonus']);

            $updateUserBonus = $connection->prepare("UPDATE user_heroes SET BonusAttack = ? WHERE UserID = ? AND HeroNumber = ?");
            $updateUserBonus->bind_param("iii", $updateBonus, $uid, $heroNumber);
            $updateUserBonus->execute();
        }
    }
}







/*

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
*/