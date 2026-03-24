<?php
/**
 * Container for all base config
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */

session_start();

ini_set("display_errors", true);
error_reporting(E_ALL & ~E_WARNING);

require_once 'src/utils/general.php';
require 'src/php/database/class.connect.php';

$dbConn = DbConnect::Init();
try {
    $connection = $dbConn->getConnection();
} catch (Exception $e) {
    exit($e->getMessage());
}

const DEBUG_OUTPUT = true;
const PASSWORD_METHOD = PASSWORD_BCRYPT;
const MAX_LOGIN_ATTEMPTS = 5;