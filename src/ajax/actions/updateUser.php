<?php
/**
 * Handler for the register method for AJAX
 * 
 * @author Hoek
 * @since Mar 23 2026
 * @revisions 0
 */

$field = !empty($_REQUEST['field']) ? $_REQUEST['field'] : false;
$value = !empty($_REQUEST['value']) ? $_REQUEST['value'] : false;
$uid = !empty($_REQUEST['uid']) ? $_REQUEST['uid'] : false;

// Check details are sent
if ($field && $value && $uid) {
    if ($field == "InAction") {
        $value = $value == "Yes" ? "1" : "0";
        $update = $connection->prepare("UPDATE `user_account` SET InAction = ? WHERE `UserID` = ?");
    }
    else {
        $update = $connection->prepare("UPDATE `user_account` ua JOIN users u ON us.UserID = u.uid SET {$field} = ? WHERE u.uid = ?");
    }
    $update->bind_param("ss", $value, $uid);
    $update->execute();
    $output['status'] = true;
    $output['newvalue'] = $value;
} 
// If no details, yeet a fail
else {
    $output['status'] = false;
    $output['error'] = "No details provided.";
}