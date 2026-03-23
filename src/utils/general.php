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
    $pName = "Logout";
    if (!empty($_REQUEST['action'])) {
        $pName = ucfirst($_REQUEST['action']);
    }
    return $pName;
}