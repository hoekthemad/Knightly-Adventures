<?php
/**
 * Globally used functions
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */

/**
 * Do the login check to see if a user is currently logged in
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */
function doLoginCheck() {
    if (empty($_SESSION['uid']) || empty($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
}

function doLogout() {
    session_destroy();
    header("Location: login.php");
    exit;
}

/**
 * Get the current page name from the action
 * 
 * @author Hoek
 * @since Mar 22 2026
 * @revisions 0
 */
function getPageName() {
    $pName = "dashboard";
    if (!empty($_REQUEST['action'])) {
        $pName = $_REQUEST['action'];
    }
    return $pName;
}

function getUserLevel() {
    $timestamp = strtotime(date("u"));
    $lastCheckedAt = !empty($_SESSION['user_level_checked_at']) ? $_SESSION['user_level_checked_at'] : ($timestamp-500000);

    // Check to see if we have this already or if the check has expired (5 min refresh)
    if (empty($_SESSION['user_level']) || ($timestamp - $lastCheckedAt >= 300000)) {
        global $connection;
        $uid = $_SESSION['uid'];
        $stmt = $connection->prepare("SELECT `user_level` FROM `users` WHERE `uid` = ?");
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // User permission;
        // 1 = admin
        // 2 = mod
        // 3 = standard user
        $userPerm = 3;
        if ($row['user_level'] == "moderator") $userPerm = 2;
        if ($row['user_level'] == "admin") $userPerm = 1;
        $_SESSION['user_level'] = $userPerm;
        $_SESSION['user_level_checked_at'] = strtotime(date("u"));
    }
    else {
        $userPerm = $_SESSION['user_level'];
    }
    return $userPerm;
}

function isPermitted($to) {
    if ($to == "admin") {
        return getUserLevel() === 1;
    }
    else if ($to == "moderator") {
        return getUserLevel() === 2;
    }
    return getUserLevel() === 3;
}