<?php
$newsItems = [
    'Breaking news! I just shit my pants',
    'Important announcement, I may have alzhiemers, but at least I don\'t have alzhiemers!',
    'Jesus hates you',
];

$worldBossSpawnMessages = [
    "World Boss spawned!", "World Boss defeated!"
];
$wbs = $worldBossSpawnMessages[rand(0,1)];
if (stristr($wbs, "spawned")) {
    $output['wbs'] = true;
}
$output['status'] = true;
$output['message'] = $wbs . "<br>" . $newsItems[rand(0,2)];