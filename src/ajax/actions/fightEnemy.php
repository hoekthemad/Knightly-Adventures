<?php

$userStage = !empty($_REQUEST['stage']) ? $_REQUEST['stage'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$getUserHeroes = $connection->prepare("SELECT * FROM user_heroes WHERE UserID = ? AND InSlot > 0 ORDER BY InSlot ASC");
$getUserHeroes->bind_param("i", $uid);
$getUserHeroes->execute();
$resultUserHeroes = $getUserHeroes->get_result();

if ($resultUserHeroes->num_rows >= 1) {

    $loopCount = 0;
    while ($row = $resultUserHeroes->fetch_assoc()) {

        $output['heroelement'.$loopCount] = $row['Element'];
        $output['heroinslot'.$loopCount] = $row['InSlot'];
        $output['herohealth'.$loopCount] = $row['Health'];
        $output['herohealthmax'.$loopCount] = $row['HealthMax'];
        $output['heroattack'.$loopCount] = $row['Attack'] + $row['BonusAttack'];
        $output['herodefense'.$loopCount] = $row['Defense'] + $row['BonusDefense'];

        $loopCount++;

    }

    $output['herocount'] = $loopCount;

    $getEnemy = $connection->prepare("SELECT * FROM rule_stage_adventure WHERE Stage = ?");
    $getEnemy->bind_param("i", $userStage);
    $getEnemy->execute();
    $resultEnemy = $getEnemy->get_result();
    $resultEnemyAssoc = $resultEnemy->fetch_assoc();

    $loopCount2;
    for ($i = 0; $i < 6; $i++) {

        $getEnemyInfo = $connection->prepare("SELECT * FROM rule_enemy WHERE EnemyID = ?");
        $getEnemyInfo->bind_param("i", $resultEnemyAssoc['Enemy'.($i + 1)]);
        $getEnemyInfo->execute();
        $resultEnemyInfo = $getEnemyInfo->get_result();

        if ($resultEnemyInfo->num_rows >= 1) {
            $resultEnemyInfoAssoc = $resultEnemyInfo->fetch_assoc();

            $output['enemyinslot'.($i)] = $i;
            $output['enemyelement'.($i)] = $resultEnemyInfoAssoc['Element'];
            $output['enemyhealth'.($i)] = $resultEnemyInfoAssoc['Health'];
            $output['enemyattack'.($i)] = $resultEnemyInfoAssoc['Attack'];
            $output['enemydefense'.($i)] = $resultEnemyInfoAssoc['Defense'];

            $loopCount2++;

        }
        else {
            $i = 7;
        }

    }

    $output['enemycount'] = $loopCount2;

    $output['status'] = true;

}
else {

    // No heroes are in lineup.

}