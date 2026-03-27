<?php

    function getHeroInformation($heroNumber) {
        global $connection;

        $getUserHero = $connection->prepare("SELECT * FROM user_heroes WHERE UserID = ? AND HeroNumber = ?");
        $getUserHero->bind_param("ii", $_SESSION['uid'], $heroNumber);
        $getUserHero->execute();

        $result = $getUserHero->get_result();

        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getHeroNextLevelExp($currentExp) {
        global $connection;

        $getUserHeroNextLevel = $connection->prepare("SELECT * FROM rule_levels WHERE Experience > ?");
        $getUserHeroNextLevel->bind_param("i", $currentExp);
        $getUserHeroNextLevel->execute();

        $result = $getUserHeroNextLevel->get_result();

        if ($result->num_rows >= 1) {
            return $result->fetch_assoc();
        }
    }