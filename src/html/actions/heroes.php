<?php require_once 'src/utils/actions/heroes.php'; ?>
<script src="src/javascript/actions/heroes.js"></script>



<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card" style="width: 18rem;">
                <?php
                    $heroInfo1 = getHeroInformation(1);
                    var_dump($heroInfo1);
                ?>
                <div class="card-header">
                    Hero Name
                </div>
                <!-- Add attack bonus to attack and defense bonus to defense as well... -->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">HP: <?= $heroInfo1['Health'] ?>/<?= $heroInfo1['MaxHealth'] ?><br>Level: <?= $heroInfo1['Level'] ?><br>Reawakening: <?= $heroInfo1['Reawaken'] ?><br>Experence: <?= $heroInfo1['Experience'] ?>/Next Level?</li>
                    <li class="list-group-item">Element: <?= $heroInfo1['Element'] ?><br>Attack: <?= $heroInfo1['Attack'] ?><br>Defense: <?= $heroInfo1['Defense'] ?></li>
                    <li class="list-group-item">Armor: <?= $heroInfo1['Armor'] ?><br>Weapon: <?= $heroInfo1['Weapon'] ?></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            2
        </div>
        <div class="col-sm-4">
            3
        </div>
    </div>
    <Br>
    <div class="row">
        <div class="col-sm-4">
            4
        </div>
        <div class="col-sm-4">
            5
        </div>
        <div class="col-sm-4">
            6
        </div>
    </div>
</div>