<?php

$buildingName = !empty($_REQUEST['building']) ? $_REQUEST['building'] : false;

if ($buildingName) {
    switch ($buildingName) {
        case "TownHall" : $ruleName = "Town Hall"; break;
        case "GoldFactory" : $ruleName = "Gold Factory"; break;
        case "Hospital" : $ruleName = "Hospital"; break;
    }

    $query_getCurrentBuildingLevel = $connection->prepare("SELECT {$buildingName} FROM user_village WHERE UserID = ?");
    $query_getCurrentBuildingLevel->bind_param("i", $_SESSION['uid']);
    $query_getCurrentBuildingLevel->execute();
    $result_getCurrentBuildingLevel = $query_getCurrentBuildingLevel->get_result();

    $row_getCurrentBuildingLevel = $result_getCurrentBuildingLevel->fetch_array();
    $buildingLevel = intval($row_getCurrentBuildingLevel[$buildingName]) + 1;
    $nextLevel = $buildingLevel + 1;

    $query_getBuildingCost = $connection->prepare("SELECT BuildingCost FROM rule_village WHERE (BuildingLevel = ? OR BuildingLevel = ?) AND BuildingName = ? ORDER BY BuildingLevel ASC");
    $query_getBuildingCost->bind_param("iis", $buildingLevel, $nextLevel, $ruleName);
    $query_getBuildingCost->execute();
    $result_getBuildingCost = $query_getBuildingCost->get_result();

    $query_getUserCurrentGold = $connection->prepare("SELECT gold FROM user_account WHERE UserID = ?");
    $query_getUserCurrentGold->bind_param("i", $_SESSION['uid']);
    $query_getUserCurrentGold->execute();
    $result_getUserCurrentGold = $query_getUserCurrentGold->get_result();

    $row_getUserCurrentGold = $result_getUserCurrentGold->fetch_array();
    
    $userCurrentGold = intval($row_getUserCurrentGold['gold']);

    $loopCount = 0;
    $prices = [];
    while ($row_getBuildingCost = $result_getBuildingCost->fetch_array()) {
        $prices[] = $row_getBuildingCost['BuildingCost'];
    }
    if (empty($prices[1])) {
        $prices[1] = 0;
        $output['status'] = true;
        $output['newcost'] = "Maximum Level";
        $output['newgoldbalance'] = $userCurrentGold;
        $output['newbuildinglevel'] = $buildingLevel-1;
    }
    else {

        if ($userCurrentGold >= $prices[0]) {
            $newGoldLevel = $userCurrentGold - $prices[0];
            $query_updateUserVillageGold = $connection->prepare(
                "UPDATE `user_account` a 
                JOIN `user_village` v ON (a.`UserID` = v.`UserID`) 
                SET 
                    a.`gold` = ?, 
                    v.".$buildingName." = ? 
                WHERE a.UserID = ?"
            );
            $query_updateUserVillageGold->bind_param("isi", $newGoldLevel, $buildingLevel, $_SESSION['uid']);
            $query_updateUserVillageGold->execute();
            $output['status'] = true;
            $output['newcost'] = $prices[1];
            $output['newgoldbalance'] = $newGoldLevel;
            $output['newbuildinglevel'] = $buildingLevel;
        }
        else {
            $output['status'] = false;
            $output['message'] = "This upgrade costs too much.";
        }
    }

    
}
else {
    $output['status'] = false;
    $output['error'] = "No building provided.";
}