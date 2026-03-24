<?php

    $getUserVillage = $connection->prepare("SELECT * FROM user_village WHERE UserID = $_SESSION['uid']");
    $getUserVillage->execute();
    $result = $getUserVillage->get_result();
    if ($result->num_rows >= 1) {
        $row = $result->fetch_array();
    }