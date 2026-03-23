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
// Switch the "do" to decide what we are doing
switch ($_REQUEST['do']) {
    case "login": {
        require 'src/ajax/actions/login.php';
        break;
    }
    case "register": {
        require 'src/ajax/actions/register.php';
        break;
    }
    default: {
        //default to false in case no action is found
        $output['status'] = false;
    }
}
// Output the encoded result and exit
echo json_encode($output);
exit;