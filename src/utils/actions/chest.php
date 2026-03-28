<?php






    $items = [
        ['name' => '10 Gold', 'rarity' => null, 'image' => 'ak_redline.png', 'chance' => 40],
        ['name' => '25 Gold', 'rarity' => null, 'image' => 'm4_asiimov.png', 'chance' => 40],
        ['name' => '50 Gold', 'rarity' => null, 'image' => 'awp_dragon.png', 'chance' => 20],
    ];

    $rand = mt_rand(1, 100);
    $sum = 0;

    foreach ($items as $item) {
        $sum += $item['chance'];
        if ($rand <= $sum) {
            return $item;
        }
    }
