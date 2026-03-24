<?php
/**
 * Handler for the register method for AJAX
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */

$uname = !empty($_REQUEST['u']) ? $_REQUEST['u'] : false;
$email = !empty($_REQUEST['e']) ? $_REQUEST['e'] : false;
$pword = !empty($_REQUEST['p']) ? $_REQUEST['p'] : false;

// Check details are sent
if ($uname && $email && $pword) {
    // Check to see if the username/password are in use already
    $stmt_findSame = $connection->prepare("SELECT `uid` FROM users WHERE (username = ? OR email = ?)");
    $stmt_findSame->bind_param("ss", $uname, $uname);
    $stmt_findSame->execute();
    $result = $stmt_findSame->get_result();
    // If they are, yeet an error to say as much
    if ($result->num_rows >= 1) {
        $output['status'] = false;
        $output['error'] = "Duplicate username or email found.";
    }
    // Otherwise lets add the user
    else {
        // Passwords are salty, salt that bitch like fish (made up of username + email + unix timestamp wrapped into an md5)
        $salt = md5($uname.$email.strtotime(date("u")));
        $saltedPassword = $pword.$salt;
        $hash = password_hash($saltedPassword, PASSWORD_METHOD);
        $stmt_insertUser = $connection->prepare("INSERT INTO `users` (`username`, `email`, `password`, `salt`, `status`) VALUES (?, ?, ?, ?, 'Active')");
        $stmt_insertUser->bind_param("ssss", $uname, $email, $hash, $salt);
        $stmt_insertUser->execute();

        $uid = $connection->insert_id;
        $timestamp = strtotime(date("u"));

        $stmt_insertUserAccount = $connection->prepare("INSERT INTO `user_account` (UserID, Username, CreationTimestamp) VALUES (?, ?, ?)");
        $stmt_insertUserAccount->bind_param("sss", $uid, $uname, $timestamp);
        $stmt_insertUserAccount->execute();

        $stmt_insertUserVillage = $connection->prepare("INSERT INTO `user_village` (UserID) VALUES (?)");
        $stmt_insertUserVillage->bind_param("s", $uid);
        $stmt_insertUserVillage->execute();

        $heroslot = 1;
        $heroelement = "Normal";

        $stmt_insertUserHeroes = $connection->prepare("INSERT INTO `user_heroes` (UserID, Name, CreationTimestamp, HealingTimestamp, HeroNumber, InSlot, Element) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt_insertUserHeroes->bind_param("sssssss", $uid, $uname, $timestamp, $timestamp, $heroslot, $heroslot, $heroelement);
        $stmt_insertUserHeroes->execute();
        $output['status'] = true;
    }
} 
// If no details, yeet a fail
else {
    $output['status'] = false;
    $output['error'] = "No details provided.";
}