<?php

$unknown = !empty($_REQUEST['noidea']) ? $_REQUEST['noidea'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$change = $connection->prepare("SELECT * FROM user_heroes WHERE UserID = ? AND InSlot > 0 ORDER BY InSlot ASC");
$change->bind_param("i", $uid);
$change->execute();
$rchange = $change->get_result();

// Get hero information, get enemy information, Get fight information

if ($resultUserHeroes->num_rows >= 1) {

    $output['This'] = $resultUserHeroes->fetch_array();

}