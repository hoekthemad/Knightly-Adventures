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

    function getRulesVillageNextGoldFactory1() {
        global $connection;
        $userVillage = getUserVillage();
        $nextGoldFactory1Level = intval($userVillage['GoldFactory1']) + 1;
        $getUserVillageGoldFactory1 = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Gold Factory' AND BuildingLevel = ?");
        $getUserVillageGoldFactory1->bind_param("i", $nextGoldFactory1Level);
        $getUserVillageGoldFactory1->execute();
        $result = $getUserVillageGoldFactory1->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextGoldFactory2() {
        global $connection;
        $userVillage = getUserVillage();
        $nextGoldFactory2Level = intval($userVillage['GoldFactory1']) + 1;
        $getUserVillageGoldFactory2 = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Gold Factory' AND BuildingLevel = ?");
        $getUserVillageGoldFactory2->bind_param("i", $nextGoldFactory1Level);
        $getUserVillageGoldFactory2->execute();
        $result = $getUserVillageGoldFactory2->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextGoldFactory3() {
        global $connection;
        $userVillage = getUserVillage();
        $nextGoldFactory3Level = intval($userVillage['GoldFactory1']) + 1;
        $getUserVillageGoldFactory3 = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Gold Factory' AND BuildingLevel = ?");
        $getUserVillageGoldFactory3->bind_param("i", $nextGoldFactory1Level);
        $getUserVillageGoldFactory3->execute();
        $result = $getUserVillageGoldFactory3->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextGoldFactory4() {
        global $connection;
        $userVillage = getUserVillage();
        $nextGoldFactory4Level = intval($userVillage['GoldFactory1']) + 1;
        $getUserVillageGoldFactory4 = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Gold Factory' AND BuildingLevel = ?");
        $getUserVillageGoldFactory4->bind_param("i", $nextGoldFactory1Level);
        $getUserVillageGoldFactory4->execute();
        $result = $getUserVillageGoldFactory4->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextHospital() {
        global $connection;
        $userVillage = getUserVillage();
        $nextHospitalLevel = intval($userVillage['Hospital']) + 1;
        $getUserVillageHospital = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Hospital' AND BuildingLevel = ?");
        $getUserVillageHospital->bind_param("i", $nextGoldFactory1Level);
        $getUserVillageHospital->execute();
        $result = $getUserVillageHospital->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }