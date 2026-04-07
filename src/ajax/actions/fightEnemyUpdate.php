<?php

$whoAttack = !empty($_REQUEST['attack']) ? $_REQUEST['attack'] : false;
$attackerLevel = !empty($_REQUEST['attackerl']) ? $_REQUEST['attackerl'] : false;
$attackerAttack = !empty($_REQUEST['attackera']) ? $_REQUEST['attackera'] : false;
$defenderLevel = !empty($_REQUEST['defenderl']) ? $_REQUEST['defenderl'] : false;
$defenderHealth = !empty($_REQUEST['defenderh']) ? $_REQUEST['defenderh'] : false;
$defenderDefense = !empty($_REQUEST['defenderd']) ? $_REQUEST['defenderd'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$baseMultiplier = 1.23;
$levelDifferenceModifier = 1 + (($attackerLevel - $defenderLevel) / 32.23);
$levelClampedModifier = max(0.1, $levelDifferenceModifier);

// HOW THE FUCK IS THIS LINE BELOW BEING DEVIDED BY ZERO!?!?
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
if ($damageFinal > $defenderHealth) {
    $damageFinal = $defenderHealth;
}
$output['status'] = true;
$output["finaldamage"] = $damageFinal;




if ($whoAttack === 'hero') {}