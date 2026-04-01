<?php

$output['FUCK_YOU'] = "I FUCKING HATE IT HERE!";

$heroNumber = !empty($_REQUEST['hero']) ? $_REQUEST['hero'] : false;
$slotNumber = !empty($_REQUEST['slot']) ? $_REQUEST['slot'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$output['status'] = true;
$output['hero'] = $heroNumber;
$output['slot'] = $slotNumber;





/*
$getChestItems = $connection->prepare("SELECT * FROM rule_chests WHERE ChestID = ?");
$getChestItems->bind_param("i", $chestID);
$getChestItems->execute();

$resultChestItems = $getChestItems->get_result();

if ($resultChestItems->num_rows >= 1) {

}
*/