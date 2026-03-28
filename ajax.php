<?php
/**
 * Designed to be used for any and all AJAX calls to remove any HTML and act as a semi-sanitise
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */

require_once 'src/php/config.php';
require_once 'src/ajax/utils/general.php';
// The output will have the status, errors and success message as required
$output = [];
$output['status'] = false;
// Switch the "do" to decide what we are doing
switch ($_REQUEST['do']) {
    case "chestOpening": { require 'src/ajax/actions/chestOpening.php'; break; }
    case "claimgold": { require 'src/ajax/actions/claimgold.php'; break; }
    case "claimgems": { require 'src/ajax/actions/claimgems.php'; break; }
    case "login": { require 'src/ajax/actions/login.php'; break; }
    case "register": { require 'src/ajax/actions/register.php'; break; }
    case "news": { require 'src/ajax/actions/news.php'; break; }
    case "updateUser": { require 'src/ajax/actions/updateUser.php'; break; }
    case "villageUpgrade": { require 'src/ajax/actions/villageUpgrade.php'; break; }
    default: {
        //default to false in case no action is found
    }
}
// Output the encoded result and exit
echo json_encode($output);
exit;