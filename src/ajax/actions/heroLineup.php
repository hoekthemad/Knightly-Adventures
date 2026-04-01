<?php

$heroNumber = !empty($_REQUEST['hero']) ? $_REQUEST['hero'] : false;
$slotNumber = !empty($_REQUEST['slot']) ? $_REQUEST['slot'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$getLineupSlot = $connection->prepare("SELECT * FROM user_heroes WHERE UserID = ? AND InSlot = ?");
$getLineupSlot->bind_param("ii", $uid, $slotNumber);
$getLineupSlot->execute();

$resultLineupSlot = $getLineupSlot->get_result();

$output['status'] = true;
$output['heronumber'] = $heroNumber;
$output['slotnumber'] = $slotNumber;

if ($resultLineupSlot->num_rows >= 1) {

    $resultLineupSlotArray = $resultLineupSlot->fetch_array();

    $updateCurrentLineupSlot = $connection->prepare("UPDATE user_heroes SET InSlot = 0 WHERE UserID = ? AND HeroNumber = ?");
    $updateCurrentLineupSlot->bind_param("ii", $uid, $resultLineupSlotArray['HeroNumber']);
    $updateCurrentLineupSlot->execute();

    $updateNewLineupSlot = $connection->prepare("UPDATE user_heroes SET InSlot = ? WHERE UserID = ? AND HeroNumber = ?");
    $updateNewLineupSlot->bind_param("iii", $slotNumber, $uid, $heroNumber);
    $updateNewLineupSlot->execute();

}
else {

    $updateNewLineupSlot = $connection->prepare("UPDATE user_heroes SET InSlot = ? WHERE UserID = ? AND HeroNumber = ?");
    $updateNewLineupSlot->bind_param("iii", $slotNumber, $uid, $heroNumber);
    $updateNewLineupSlot->execute();

}