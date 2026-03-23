<?php
/**
 * Handler for the login method for AJAX
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */

$uname = !empty($_REQUEST['k']) ? $_REQUEST['k'] : false;
$pword = !empty($_REQUEST['p']) ? $_REQUEST['p'] : false;

// Check details are sent
if ($uname && $pword) {
    // Get the user details from the DB
    $stmt = $connection->prepare("SELECT `password`, `salt`, `username`, `uid`, `login_attempts`, `status` FROM users WHERE (username = ? OR email = ?) LIMIT 1");
    $stmt->bind_param("ss", $uname, $pword);
    $stmt->execute();
    $result = $stmt->get_result();
    // If we have a user...
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $acctStatus = $row['status'];
        
        // Check to see if the account is active
        if ($acctStatus == "Active") {
            // Passwords are salty, use it
            $foundPassword = $row['password'];
            $foundSalt = $row['salt'];
            $givenPassword = $pword.$foundSalt;
            // Validate the password given
            if (password_verify($givenPassword, $foundPassword)) {
                $output['status'] = true;
                // Set session vars
                $_SESSION['username'] = $row['username'];
                $_SESSION['uid'] = $row['uid'];
            }
            // If wrong password, you get the idea... YEET A FUCKING ERROR
            else {
                $output['status'] = false;
                $output['error'] = "Invalid details provided.";

                // Check login attempts, increment and lock as required
                $loginAttempts = intval($row['login_attempts']) + 1;
                $queryExtra = "";
                if ($loginAttempts == MAX_LOGIN_ATTEMPTS) {
                    $queryExtra = ", `status` = 'Locked'";
                    $output['error'] = "Account locked due to too many failed attempts.";
                }
                $stmt = $connection->prepare("UPDATE users SET `login_attempts` = ? {$queryExtra} WHERE (username = ? OR email = ?)");
                $stmt->bind_param("sss", $loginAttempts, $uname, $uname);
                $stmt->execute();
            }
        }
        // Let the user know their account is locked
        else {
            $output['status'] = false;
            $output['error'] = "Account locked due to too many failed attempts.";
        }
    }
    // If user not found, yeet an error
    else {
        $output['status'] = false;
        $output['error'] = "Invalid details provided.";
    }
} 
// If no details, yeet a fail
else {
    $output['status'] = false;
    $output['error'] = "No details provided";
}