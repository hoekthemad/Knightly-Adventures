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

    function getRulesVillageNextLevel($buildingName, $searchName) {
        global $connection, $userVillage;
        $nextLevel = intval($userVillage[$buildingName]) + 1;
        $getUserVillageBuilding = $connection->prepare("SELECT * FROM rule_village WHERE BuildingName = '$searchName' AND BuildingLevel = ?");
        $getUserVillageBuilding->bind_param("i", $nextLevel);
        $getUserVillageBuilding->execute();
        $result = $getUserVillageBuilding->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_array();
        }
    }

function getBuildingMaxLevels() {
    global $connection;
    if (empty($_SESSION['max_building_levels'])) {
        $queryMaxBuildingLevels = $connection->prepare("SELECT DISTINCT BuildingName, COUNT(BuildingLevel) maxlevel FROM rule_village GROUP BY BuildingName ORDER BY BuildingLevel DESC ");
        $queryMaxBuildingLevels->execute();
        $result = $queryMaxBuildingLevels->get_result();
        while ($row = $result->fetch_array()) {
            $_SESSION['max_building_levels'][$row['BuildingName']] = $row['BuildingName'] == "Town Hall" ? (intval($row['maxlevel'])+1) : $row['maxlevel'];
        }
    }
}
