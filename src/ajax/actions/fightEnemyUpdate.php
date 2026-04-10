<?php

$whoAttack = !empty($_REQUEST['attack']) ? $_REQUEST['attack'] : false;
$heroNumber = !empty($_REQUEST['hero']) ? $_REQUEST['hero'] : false;
$enemyID = !empty($_REQUEST['enemy']) ? $_REQUEST['enemy'] : false;
$heroSelector = !empty($_REQUEST['herosel']) ? $_REQUEST['herosel'] : false;
$enemySelector = !empty($_REQUEST['enemysel']) ? $_REQUEST['enemysel'] : false;
$heroLineupCount = !empty($_REQUEST['herocount']) ? $_REQUEST['herocount'] : false;
$enemyLineupCount = !empty($_REQUEST['enemycount']) ? $_REQUEST['enemycount'] : false;
$attackerLevel = !empty($_REQUEST['attackerl']) ? $_REQUEST['attackerl'] : false;
$attackerAttack = !empty($_REQUEST['attackera']) ? $_REQUEST['attackera'] : false;
$defenderLevel = !empty($_REQUEST['defenderl']) ? $_REQUEST['defenderl'] : false;
$defenderHealth = !empty($_REQUEST['defenderh']) ? $_REQUEST['defenderh'] : false;
$defenderDefense = !empty($_REQUEST['defenderd']) ? $_REQUEST['defenderd'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$output['heroSelector'] = $heroSelector;
$output['enemySelector'] = $enemySelector;

$baseMultiplier = 1.23;
$levelDifferenceModifier = 1 + (($attackerLevel - $defenderLevel) / 32.23);
$levelClampedModifier = max(0.1, $levelDifferenceModifier);
$damageStats = $attackerAttack / $defenderDefense;
$damageBase = $baseMultiplier * $damageStats;
$damageFinal = ($damageBase * $levelClampedModifier) * $attackerLevel;
$damageFinal = max(0, $damageFinal);

$min = 0.0;
$max = 1.0;
$decimals = 2;
$scale = pow(10, $decimals);
$result = mt_rand($min * $scale, $max * $scale) / $scale;

$damageFinal = ($damageFinal * (0.8 + $result * 0.67));
$damageFinal = round($damageFinal);
if ($damageFinal >= $defenderHealth) {
    $damageFinal = $defenderHealth;
}
$output['status'] = true;
$output["finaldamage"] = $damageFinal;



if ($whoAttack === 'hero') {
    // Enemy is going to be killed. Award exp.
    if ($damageFinal === $defenderHealth) {
        $getEnemy = $connection->prepare("SELECT * FROM rule_enemy WHERE EnemyID = ?");
        $getEnemy->bind_param("i", $enemyID);
        $getEnemy->execute();
        $resultEnemy = $getEnemy->get_result();

        if ($resultEnemy->num_rows >= 1) {
            $resultEnemyAssoc = $resultEnemy->fetch_assoc();

            // Get hero EXP then award.
            $getMainHero = $connection->prepare("SELECT * FROM user_heroes WHERE UserID = ? AND HeroNumber = ?");
            $getMainHero->bind_param("ii", $uid, $heroNumber);
            $getMainHero->execute();
            $resultMainHero = $getMainHero->get_result();

            if ($resultMainHero->num_rows >= 1) {
                $resultMainHeroAssoc = $resultMainHero->fetch_assoc();

                $newEXPValue = $resultMainHeroAssoc['Experience'] + $resultEnemyAssoc['Experience'];

                // Check if the user leveled up.
                $getLevelChart = $connection->prepare("SELECT * FROM rule_levels WHERE Experience > ? ORDER BY Experience ASC");
                $getLevelChart->bind_param("i", $newEXPValue,);
                $getLevelChart->execute();
                $resultLevelChart = $getLevelChart->get_result();

                if ($resultLevelChart->num_rows >= 1) {
                    $resultLevelChartAssoc = $resultLevelChart->fetch_assoc();

                    // Hero leveled up.
                    if ($resultMainHeroAssoc['Level'] !== $resultLevelChartAssoc['Level']) {
                        $output['levelupmainheroleveldifference'] = $resultLevelChartAssoc['Level'] - $resultMainHeroAssoc['Level'];

                        $gainPoints = 0;
                        /// For some reason, this is only giving 2 instead of four..?
                        if (($resultLevelChartAssoc['Level'] - $resultMainHeroAssoc['Level']) > 1) {
                            // Get inbetween levels of experience.
                            $getLevelChart2 = $connection->prepare("SELECT * FROM rule_levels WHERE Level > ? AND Level <= ? ORDER BY Experience ASC");
                            $getLevelChart2->bind_param("ii", $resultMainHeroAssoc['Level'], $resultLevelChartAssoc['Level']);
                            $getLevelChart2->execute();
                            $resultLevelChart2 = $getLevelChart2->get_result();
                            $lc = 1;
                            while ($row = $resultLevelChart2->fetch_assoc()) {
                                $output['lc'.$lc] = $row;
                                $gainPoints += $row['AwardPoints'];
                                $lc++;
                            }
                        }
                        else {
                            $gainPoints += $resultLevelChartAssoc['AwardPoints'];
                        }
                        $output['levelupmainherohpgain'] = $gainPoints;
                        
                        $newHPValue = $resultMainHeroAssoc['HealthMax'] + $gainPoints;

                        $setNewEXPLevel = $connection->prepare("UPDATE user_heroes SET Experience = ?, Level = ?, HealthMax = ?, Health = ? WHERE UserID = ? AND HeroNumber = ?");
                        $setNewEXPLevel->bind_param("iiiiii", $newEXPValue, $resultLevelChartAssoc['Level'], $newHPValue, $newHPValue, $uid, $heroNumber);
                        $setNewEXPLevel->execute();
                    }
                    else {
                        $setNewEXP = $connection->prepare("UPDATE user_heroes SET Experience = ? WHERE UserID = ? AND HeroNumber = ?");
                        $setNewEXP->bind_param("iii", $newEXPValue, $uid, $heroNumber);
                        $setNewEXP->execute();
                    }

                }
                else {
                    $setNewEXP = $connection->prepare("UPDATE user_heroes SET Experience = ? WHERE UserID = ? AND HeroNumber = ?");
                    $setNewEXP->bind_param("iii", $newEXPValue, $uid, $heroNumber);
                    $setNewEXP->execute();
                }
            }

            // Get user profile EXP then award.
            $getUserProfile = $connection->prepare("SELECT * FROM user_account WHERE UserID = ?");
            $getUserProfile->bind_param("i", $uid);
            $getUserProfile->execute();
            $resultUserProfile = $getUserProfile->get_result();

            if ($resultUserProfile->num_rows >= 1) {
                $resultUserProfileAssoc = $resultUserProfile->fetch_assoc();

                $newEXPValue = $resultUserProfileAssoc['Experience'] + $resultEnemyAssoc['Experience'];

                // Check if the user leveled up.
                $getLevelChart = $connection->prepare("SELECT * FROM rule_levels WHERE Experience > ? ORDER BY Experience ASC");
                $getLevelChart->bind_param("i", $newEXPValue,);
                $getLevelChart->execute();
                $resultLevelChart = $getLevelChart->get_result();

                if ($resultLevelChart->num_rows >= 1) {
                    $resultLevelChartAssoc = $resultLevelChart->fetch_assoc();

                    // User leveled up.
                    if ($resultUserProfileAssoc['Level'] !== $resultLevelChartAssoc['Level']) {
                        $output['levelupuserprofileleveldifference'] = $resultLevelChartAssoc['Level'] - $resultUserProfileAssoc['Level'];

                        $setNewEXPLevel = $connection->prepare("UPDATE user_account SET Experience = ?, Level = ? WHERE UserID = ?");
                        $setNewEXPLevel->bind_param("iii", $newEXPValue, $resultLevelChartAssoc['Level'], $uid);
                        $setNewEXPLevel->execute();
                    }
                    else {
                        $setNewEXP = $connection->prepare("UPDATE user_account SET Experience = ? WHERE UserID = ?");
                        $setNewEXP->bind_param("ii", $newEXPValue, $uid);
                        $setNewEXP->execute();
                    }

                }
                else {
                    $setNewEXP = $connection->prepare("UPDATE user_account SET Experience = ? WHERE UserID = ?");
                    $setNewEXP->bind_param("ii", $newEXPValue, $uid);
                    $setNewEXP->execute();
                }
            }

            // Award EXP to other heroes in party.
        }


        if ($enemySelector === ($enemyLineupCount - 1)) {

            $output['last_enemy'] = true;

        }
    }
}
else if ($whoAttack === 'enemy') {
    // Enemy is attacking. Update hero database for health.
}