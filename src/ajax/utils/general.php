<?php

function getClaimGold($uid) {
    global $connection;
    $query_getGoldFactories = $connection->prepare("SELECT GoldFactory1Prod g1, GoldFactory2Prod g2, GoldFactory3Prod g3, GoldFactory4Prod g4, lastgoldclaim lgc FROM user_village WHERE UserID = ?");
    $query_getGoldFactories->bind_param("i", $uid);
    $query_getGoldFactories->execute();
    $result = $query_getGoldFactories->get_result();
    $row = $result->fetch_assoc();

    $goldMultiplier = 
        intval($row['g1']) +
        intval($row['g2']) +
        intval($row['g3']) +
        intval($row['g4']);

    $lastClaimTimestamp = intval($row['lgc']);
    $currentTimestamp = intval(strtotime(date("Y-m-d H:i:s")));

    $secondsToClaim = $currentTimestamp - $lastClaimTimestamp;
    $secondsDifference = floor($secondsToClaim / 60) * 60;
    $lastClaimTimestampUpdate = $lastClaimTimestamp + $secondsDifference;

    $amountToClaim = round(($secondsDifference * $goldMultiplier) / 60);
    return ['timestamp'=>$currentTimestamp, "amount"=>$amountToClaim, "multiplier"=>$goldMultiplier];
}

function claimGold($uid) {
    global $connection;

    $query_getUserCurrentGold = $connection->prepare("SELECT gold FROM user_account WHERE UserID = ?");
    $query_getUserCurrentGold->bind_param("i", $uid);
    $query_getUserCurrentGold->execute();
    $result_getUserCurrentGold = $query_getUserCurrentGold->get_result();
    $row_getUserCurrentGold = $result_getUserCurrentGold->fetch_array();
    $userCurrentGold = intval($row_getUserCurrentGold['gold']);

    $claim = getClaimGold($uid);

    if ($claim['amount'] >= 1) {
        $newGoldLevel = $userCurrentGold + intval($claim['amount']);

        $updateGold = $connection->prepare("UPDATE user_account SET gold = ? where `UserID` = ?");
        $updateGold->bind_param("ii", $newGoldLevel, $uid);
        $updateGold->execute();
    
        $updateLastClaim = $connection->prepare("UPDATE user_village SET lastgoldclaim = ? where `UserID` = ?");
        $updateLastClaim->bind_param("si", $claim['timestamp'], $uid);
        $updateLastClaim->execute();
    }
    else {
        $newGoldLevel = $userCurrentGold;
    }

    return $newGoldLevel;
}

function getClaimGems($uid) {
    global $connection;
    $query_getGemFactories = $connection->prepare("SELECT GemFactory1Prod g1, GemFactory2Prod g2, lastgemclaim lgc FROM user_village WHERE UserID = ?");
    $query_getGemFactories->bind_param("i", $uid);
    $query_getGemFactories->execute();
    $result = $query_getGemFactories->get_result();
    $row = $result->fetch_assoc();

    $gemMultiplier = 
        intval($row['g1']) +
        intval($row['g2']);

    $lastClaimTimestamp = intval($row['lgc']);
    $currentTimestamp = intval(strtotime(date("Y-m-d H:i:s")));

    $secondsToClaim = $currentTimestamp - $lastClaimTimestamp;
    $secondsDifference = floor($secondsToClaim / 1800) * 1800;
    $lastClaimTimestampUpdate = $lastClaimTimestamp + $secondsDifference;

    $amountToClaim = round(($secondsDifference * $gemMultiplier) / 1800);
    return ['timestamp'=>$currentTimestamp, "amount"=>$amountToClaim, "multiplier"=>$gemMultiplier];
}

function claimGems($uid) {
    global $connection;

    $query_getUserCurrentGems = $connection->prepare("SELECT Diamonds FROM user_account WHERE UserID = ?");
    $query_getUserCurrentGems->bind_param("i", $uid);
    $query_getUserCurrentGems->execute();
    $result_getUserCurrentGems = $query_getUserCurrentGems->get_result();
    $row_getUserCurrentGems = $result_getUserCurrentGems->fetch_array();
    $userCurrentGems = intval($row_getUserCurrentGems['Diamonds']);

    $claim = getClaimGems($uid);

    if ($claim['amount'] >= 1) {
        $newGemsLevel = $userCurrentGems + intval($claim['amount']);

        $updateGems = $connection->prepare("UPDATE user_account SET Diamonds = ? where `UserID` = ?");
        $updateGems->bind_param("ii", $newGemsLevel, $uid);
        $updateGems->execute();
    
        $updateLastClaim = $connection->prepare("UPDATE user_village SET lastgemclaim = ? where `UserID` = ?");
        $updateLastClaim->bind_param("si", $claim['timestamp'], $uid);
        $updateLastClaim->execute();
    }
    else {
        $newGemsLevel = $userCurrentGems;
    }

    return $newGemsLevel;
}

function updateClaimTimestamp($uid, $type, $timestampOverride = false) {
    switch ($type) {
        case "gem" : $field = "lastgemclaim"; break;
        case "gold" : $field = "lastgoldclaim"; break;
        default : return false;
    }

    global $connection;

    $timestamp = intval(strtotime(date("Y-m-d H:i:s")));
    if ($timestampOverride != false) {
        $timestamp = $timestampOverride;
    }
    $query = $connection->prepare("UPDATE user_village SET {$field} = ? WHERE UserID = ?");
    $query->bind_param("si", $timestamp, $uid);
    $query->execute();
}

function getBuildingCost($name, $level) {
    global $connection;
    $query = $connection->prepare("SELECT BuildingCost FROM rule_village WHERE BuildingName = ? AND BuildingLevel = ?");
    $query->bind_param("si", $name, $level);
    $query->execute();
    $res = $query->get_result();
    $row = $res->fetch_array();

    return $row['BuildingCost'];
}

function getBuildingProduction($name, $level) {
    global $connection;
    $query = $connection->prepare("SELECT BuildingOutput FROM rule_village WHERE BuildingName = ? AND BuildingLevel = ?");
    $query->bind_param("si", $name, $level);
    $query->execute();
    $res = $query->get_result();
    $row = $res->fetch_array();

    return $row['BuildingOutput'];
}