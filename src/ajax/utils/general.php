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

    $secondsToClaim = $currentTimestamp-$lastClaimTimestamp;

    $amountToClaim = round(($secondsToClaim * $goldMultiplier) / 60);
    return ['timestamp'=>$currentTimestamp, "currency"=>$amountToClaim, "multiplier"=>$goldMultiplier];
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

    $newGoldLevel = $userCurrentGold + intval($claim['currency']);

    $updateGold = $connection->prepare("UPDATE user_account SET gold = ? where `UserID` = ?");
    $updateGold->bind_param("ii", $newGoldLevel, $uid);
    $updateGold->execute();

    $updateLastClaim = $connection->prepare("UPDATE user_village SET lastgoldclaim = ? where `UserID` = ?");
    $updateLastClaim->bind_param("si", $claim['timestamp'], $uid);
    $updateLastClaim->execute();

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

    $secondsToClaim = $currentTimestamp-$lastClaimTimestamp;

    $amountToClaim = round(($secondsToClaim * $gemMultiplier) / 60);
    return ['timestamp'=>$currentTimestamp, "currency"=>$amountToClaim, "multiplier"=>$gemMultiplier];
}