<?php
$newsItems = [
    'Breaking news! I just shit my pants',
    'Important announcement, I may have alzhiemers, but at least I don\t have alzhiemers!',
    'Jesus hates you',
    'World boss spawned! Go piss on it\'s grave!'
];
$output['status'] = true;
$output['message'] = $newsItems[rand(0,3)];