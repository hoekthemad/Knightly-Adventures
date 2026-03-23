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