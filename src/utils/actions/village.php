<?php

    function getUserVillage() {
        global $connection;
        $getUserVillage = $connection->prepare("SELECT * FROM user_village WHERE UserID = ?");
        $getUserVillage->bind_param("s", $_SESSION['uid']);
        $getUserVillage->execute();
        $result = $getUserVillage->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextTownHall() {
        global $connection;
        $userVillage = getUserVillage();
        $nextTownHallLevel = intval($userVillage['TownHall']) + 1;
        $getUserVillageTownHall = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Town Hall' AND BuildingLevel = ?");
        $getUserVillageTownHall->bind_param("i", $nextTownHallLevel);
        $getUserVillageTownHall->execute();
        $result = $getUserVillageTownHall->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }