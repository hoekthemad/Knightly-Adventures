<?php

    function getHeroInformation($heroNumber) {
        global $connection;

        $getUserHero = $connection->prepare("SELECT * FROM user_heroes WHERE UserID = ? AND HeroNumber = ?");
        $getUserHero->bind_param("ii", $uid, $heroNumber);
        $getUserHero->execute();

        $result = $getUserHero->get_result();

        // Testing return with this one. Delete and fix.
        return $getUserHero;

        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }