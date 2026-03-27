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
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">HP: <?= $heroInfo1['Health'] ?>/?<br>Level: ?<br>Reawakening: ?<br>Experence: ?/?</li>
                    <li class="list-group-item">Element: ?<br>Attack: ?<br>Defense: ?</li>
                    <li class="list-group-item">Weapon: ?<br>Armor: ?</li>
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