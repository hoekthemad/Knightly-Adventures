<?php

function checkValidSession() {
    if (!empty($_SESSION['username']) && !empty($_SESSION['uid'])) {
        header("Location: dashboard.php");
        exit;
    }
    return true;
}