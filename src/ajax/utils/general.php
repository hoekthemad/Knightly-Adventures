<?php

function getClaimGold($user) {
    global $connection;
    $query_getGoldFactories = $connection->prepare("SELECT GoldFactory1Prod g1, GoldFactory2Prod g2, GoldFactory3Prod g3, GoldFactory4Prod g4, lastgoldclaim lgc FROM user_village WHERE UserID = ?");
    $query_getGoldFactories->bind_param("i", $user);
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

function getClaimGems($user) {
    global $connection;
    $query_getGemFactories = $connection->prepare("SELECT GemFactory1Prod g1, GemFactory2Prod g2, lastgemclaim lgc FROM user_village WHERE UserID = ?");
    $query_getGemFactories->bind_param("i", $user);
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