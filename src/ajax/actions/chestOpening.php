<?php

$chestName = !empty($_REQUEST['chest']) ? $_REQUEST['chest'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$output['chestname'] = $chestName;
$output['status'] = true;

return $chestName;