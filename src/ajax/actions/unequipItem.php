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
    $output['resultUserItemsAssoc'] = $resultUserItemsAssoc;

    if ($itemID >= 10000) {

        $rremoveHeroItem = $connection->prepare("UPDATE user_heroes SET $itemType = null, {$itemType}Rarity = null WHERE UserID = ? AND HeroNumber = ?");
        $rremoveHeroItem->bind_param("ii", $uid, $heroNumber);
        $rremoveHeroItem->execute();

        if ($resultUserItemsAssoc['ItemID']) {
            $userItemAmount = $resultUserItemsAssoc['Amount'] + 1;

            $giveUserItems = $connection->prepare("UPDATE user_items SET Amount = ? WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
            $giveUserItems->bind_param("iiis", $userItemAmount, $uid, $itemID, $itemRarity);
            $giveUserItems->execute();
        }

    }
}