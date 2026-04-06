<?php

$heroSelector = !empty($_REQUEST['hero']) ? $_REQUEST['hero'] : false;
$enemySelector = !empty($_REQUEST['enemy']) ? $_REQUEST['enemy'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$output['status'] = true;