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
    case "upgradeBuildingv2": { require 'src/ajax/actions/villageUpgrade.php'; break; }
    default: {
        $fPath = "src/ajax/actions/{$_REQUEST['do']}.php";
        if (file_exists($fPath)) {
            require $fPath;
        }
    }
}
// Output the encoded result and exit
echo json_encode($output);
exit;