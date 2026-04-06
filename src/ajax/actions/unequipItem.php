<?php

$itemID = !empty($_REQUEST['item']) ? $_REQUEST['item'] : false;
$itemRarity = !empty($_REQUEST['rarity']) ? $_REQUEST['rarity'] : false;
$itemType = !empty($_REQUEST['type']) ? $_REQUEST['type'] : false;
$heroNumber = !empty($_REQUEST['number']) ? $_REQUEST['number'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$getUserEquiped = $connection->prepare("SELECT * FROM user_heroes WHERE UserID = ? AND HeroNumber = ?");
$getUserEquiped->bind_param("ii", $uid, $heroNumber);
$getUserEquiped->execute();
$resultUserEquiped = $getUserEquiped->get_result();
$resultUserEquipedAssoc = $resultUserEquiped->fetch_assoc();

if ($resultUserEquipedAssoc[$itemType]) {
    $getUserItems = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ?");
    $getUserItems->bind_param("ii", $uid, $itemID);
    $getUserItems->execute();
    $resultUserItems = $getUserItems->get_result();
    $resultUserItemsAssoc = $resultUserItems->fetch_assoc();

    $output['status'] = true;

    if ($itemID >= 10000) {

        $removeHeroItem = $connection->prepare("UPDATE user_heroes SET $itemType = null, {$itemType}Rarity = null WHERE UserID = ? AND HeroNumber = ?");
        $removeHeroItem->bind_param("ii", $uid, $heroNumber);
        $removeHeroItem->execute();

        if ($resultUserItemsAssoc['ItemID']) {
            $userItemAmount = $resultUserItemsAssoc['Amount'] + 1;

            $giveUserItems = $connection->prepare("UPDATE user_items SET Amount = ? WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
            $giveUserItems->bind_param("iiis", $userItemAmount, $uid, $itemID, $itemRarity);
            $giveUserItems->execute();
        }

        if ($itemType === 'Armor') {
            $updateUserBonus = $connection->prepare("UPDATE user_heroes SET BonusDefense = 0 WHERE UserID = ? AND HeroNumber = ?");
            $updateUserBonus->bind_param("ii", $uid, $heroNumber);
            $updateUserBonus->execute();
        }
        else if ($itemType === 'Weapon') {
            $updateUserBonus = $connection->prepare("UPDATE user_heroes SET BonusAttack = 0 WHERE UserID = ? AND HeroNumber = ?");
            $updateUserBonus->bind_param("ii", $uid, $heroNumber);
            $updateUserBonus->execute();
        }

    }
}