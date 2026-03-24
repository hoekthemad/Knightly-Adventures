<?php

    function getUserCurrency() {
        global $connection;
        $getUserCurrency = $connection->prepare("SELECT user_account.Gold, user_account.Diamonds FROM user_account WHERE UserID = ?");
        $getUserCurrency->bind_param("s", $_SESSION['uid']);
        $getUserCurrency->execute();
        $result = $getUserCurrency->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }