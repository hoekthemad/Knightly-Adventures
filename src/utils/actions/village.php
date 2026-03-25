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
        global $connection, $userVillage;
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
        global $connection, $userVillage;
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
        global $connection, $userVillage;
        $nextGoldFactory2Level = intval($userVillage['GoldFactory1']) + 1;
        $getUserVillageGoldFactory2 = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Gold Factory' AND BuildingLevel = ?");
        $getUserVillageGoldFactory2->bind_param("i", $nextGoldFactory2Level);
        $getUserVillageGoldFactory2->execute();
        $result = $getUserVillageGoldFactory2->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextGoldFactory3() {
        global $connection, $userVillage;
        $nextGoldFactory3Level = intval($userVillage['GoldFactory1']) + 1;
        $getUserVillageGoldFactory3 = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Gold Factory' AND BuildingLevel = ?");
        $getUserVillageGoldFactory3->bind_param("i", $nextGoldFactory3Level);
        $getUserVillageGoldFactory3->execute();
        $result = $getUserVillageGoldFactory3->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextGoldFactory4() {
        global $connection, $userVillage;
        $nextGoldFactory4Level = intval($userVillage['GoldFactory1']) + 1;
        $getUserVillageGoldFactory4 = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Gold Factory' AND BuildingLevel = ?");
        $getUserVillageGoldFactory4->bind_param("i", $nextGoldFactory4Level);
        $getUserVillageGoldFactory4->execute();
        $result = $getUserVillageGoldFactory4->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

    function getRulesVillageNextHospital() {
        global $connection, $userVillage;
        $nextHospitalLevel = intval($userVillage['Hospital']) + 1;
        $getUserVillageHospital = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = 'Hospital' AND BuildingLevel = ?");
        $getUserVillageHospital->bind_param("i", $nextHospitalLevel);
        $getUserVillageHospital->execute();
        $result = $getUserVillageHospital->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

function getBuildingMaxLevels() {
    global $connection;
    if (empty($_SESSION['max_building_levels'])) {
        $queryMaxBuildingLevels = $connection->prepare("SELECT DISTINCT BuildingName, BuildingLevel FROM rule_village GROUP BY BuildingName ORDER BY BuildingLevel DESC ");
        $queryMaxBuildingLevels->execute();
        $result = $queryMaxBuildingLevels->get_result();
        while ($row = $result->fetch_array()) {
            $_SESSION['max_building_levels'][$row['BuildingName'] = $row['BuildingLevel'];
        }
    }
}
