<?php require_once 'src/utils/actions/heroes.php'; ?>
<script src="src/javascript/actions/heroes.js"></script>

<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-4">
            <?php
                $heroInfo1 = getHeroInformation(1);
                $heroNextLevel1 = getHeroNextLevelExp($heroInfo1['Experience']);
                $heroAttack = $heroInfo1['Attack'] + $heroInfo1['BonusAttack'];
                $heroDefense = $heroInfo1['Defense'] + $heroInfo1['BonusDefense'];
                if ($heroInfo1['InSlot'] !== 0) {
                    ?>
                    <div class="card" style="width: 18rem;">
                    In Lineup Slot <?= $heroInfo1['InSlot']; ?> / 3
                    <?php
                }
                ?>
                <div class="card-header">
                    <?= $heroInfo1['Name'] ?>
                </div>
                <!-- Add attack bonus to attack and defense bonus to defense as well... -->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">HP: <?= $heroInfo1['Health'] ?> / <?= $heroInfo1['HealthMax'] ?><br>Level: <?= $heroInfo1['Level'] ?><br>Reawakening: <?= $heroInfo1['Reawaken'] ?><br>Experence: <?= $heroInfo1['Experience'] ?> / <?= $heroNextLevel1['Experience'] ?></li>
                    <li class="list-group-item">Element: <?= $heroInfo1['Element'] ?><br>Attack: <?= $heroAttack ?><br>Defense: <?= $heroDefense ?></li>
                    <li class="list-group-item">Armor: <?= $heroInfo1['Armor'] ?><br>Weapon: <?= $heroInfo1['Weapon'] ?></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <?php
                $heroInfo2 = getHeroInformation(2);
                $heroNextLevel2 = getHeroNextLevelExp($heroInfo2['Experience']);
                $heroAttack = $heroInfo2['Attack'] + $heroInfo2['BonusAttack'];
                $heroDefense = $heroInfo2['Defense'] + $heroInfo2['BonusDefense'];
                if (!empty($heroInfo2)) {
                    if ($heroInfo2['InSlot'] !== 0) {
                        ?>
                        <div class="card" style="width: 18rem;">
                        In Lineup Slot <?= $heroInfo2['InSlot']; ?> / 3
                        <?php
                    }
                    ?>
                        <div class="card-header">
                            <?= $heroInfo2['Name'] ?>
                        </div>
                        <!-- Add attack bonus to attack and defense bonus to defense as well... -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo2['Health'] ?> / <?= $heroInfo2['HealthMax'] ?><br>Level: <?= $heroInfo2['Level'] ?><br>Reawakening: <?= $heroInfo2['Reawaken'] ?><br>Experence: <?= $heroInfo2['Experience'] ?> / <?= $heroNextLevel2['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo2['Element'] ?><br>Attack: <?= $heroAttack ?><br>Defense: <?= $heroDefense ?></li>
                            <li class="list-group-item">Armor: <?= $heroInfo2['Armor'] ?><br>Weapon: <?= $heroInfo2['Weapon'] ?></li>
                        </ul>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="col-sm-4">
            <?php
                $heroInfo3 = getHeroInformation(3);
                $heroNextLevel3 = getHeroNextLevelExp($heroInfo3['Experience']);
                $heroAttack = $heroInfo3['Attack'] + $heroInfo3['BonusAttack'];
                $heroDefense = $heroInfo3['Defense'] + $heroInfo3['BonusDefense'];
                if (!empty($heroInfo3)) {
                    if ($heroInfo3['InSlot'] !== 0) {
                        ?>
                        <div class="card" style="width: 18rem;">
                        In Lineup Slot <?= $heroInfo3['InSlot']; ?> / 3
                        <?php
                    }
                    ?>
                        <div class="card-header">
                            <?= $heroInfo3['Name'] ?>
                        </div>
                        <!-- Add attack bonus to attack and defense bonus to defense as well... -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo3['Health'] ?> / <?= $heroInfo3['HealthMax'] ?><br>Level: <?= $heroInfo3['Level'] ?><br>Reawakening: <?= $heroInfo3['Reawaken'] ?><br>Experence: <?= $heroInfo3['Experience'] ?> / <?= $heroNextLevel3['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo3['Element'] ?><br>Attack: <?= $heroAttack ?><br>Defense: <?= $heroDefense ?></li>
                            <li class="list-group-item">Armor: <?= $heroInfo3['Armor'] ?><br>Weapon: <?= $heroInfo3['Weapon'] ?></li>
                        </ul>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <Br>
    <div class="row">
        <div class="col-sm-4">
            <?php
                $heroInfo4 = getHeroInformation(4);
                $heroNextLevel4 = getHeroNextLevelExp($heroInfo4['Experience']);
                $heroAttack = $heroInfo4['Attack'] + $heroInfo4['BonusAttack'];
                $heroDefense = $heroInfo4['Defense'] + $heroInfo4['BonusDefense'];
                if (!empty($heroInfo4)) {
                    if ($heroInfo4['InSlot'] !== 0) {
                        ?>
                        <div class="card" style="width: 18rem;">
                        In Lineup Slot <?= $heroInfo4['InSlot']; ?> / 3
                        <?php
                    }
                    ?>
                        <div class="card-header">
                            <?= $heroInfo4['Name'] ?>
                        </div>
                        <!-- Add attack bonus to attack and defense bonus to defense as well... -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo4['Health'] ?> / <?= $heroInfo4['HealthMax'] ?><br>Level: <?= $heroInfo4['Level'] ?><br>Reawakening: <?= $heroInfo4['Reawaken'] ?><br>Experence: <?= $heroInfo4['Experience'] ?> / <?= $heroNextLevel4['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo4['Element'] ?><br>Attack: <?= $heroAttack ?><br>Defense: <?= $heroDefense ?></li>
                            <li class="list-group-item">Armor: <?= $heroInfo4['Armor'] ?><br>Weapon: <?= $heroInfo4['Weapon'] ?></li>
                        </ul>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="col-sm-4">
            <?php
                $heroInfo5 = getHeroInformation(5);
                $heroNextLevel5 = getHeroNextLevelExp($heroInfo5['Experience']);
                $heroAttack = $heroInfo5['Attack'] + $heroInfo5['BonusAttack'];
                $heroDefense = $heroInfo5['Defense'] + $heroInfo5['BonusDefense'];
                if (!empty($heroInfo5)) {
                    if ($heroInfo5['InSlot'] !== 0) {
                        ?>
                        <div class="card" style="width: 18rem;">
                        In Lineup Slot <?= $heroInfo5['InSlot']; ?> / 3
                        <?php
                    }
                    ?>
                        <div class="card-header">
                            <?= $heroInfo5['Name'] ?>
                        </div>
                        <!-- Add attack bonus to attack and defense bonus to defense as well... -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo5['Health'] ?> / <?= $heroInfo5['HealthMax'] ?><br>Level: <?= $heroInfo5['Level'] ?><br>Reawakening: <?= $heroInfo5['Reawaken'] ?><br>Experence: <?= $heroInfo5['Experience'] ?> / <?= $heroNextLevel5['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo5['Element'] ?><br>Attack: <?= $heroAttack ?><br>Defense: <?= $heroDefense ?></li>
                            <li class="list-group-item">Armor: <?= $heroInfo5['Armor'] ?><br>Weapon: <?= $heroInfo5['Weapon'] ?></li>
                        </ul>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="col-sm-4">
            <?php
                $heroInfo6 = getHeroInformation(6);
                $heroNextLevel6 = getHeroNextLevelExp($heroInfo6['Experience']);
                $heroAttack = $heroInfo6['Attack'] + $heroInfo6['BonusAttack'];
                $heroDefense = $heroInfo6['Defense'] + $heroInfo6['BonusDefense'];
                if (!empty($heroInfo6)) {
                    if ($heroInfo6['InSlot'] !== 0) {
                        ?>
                        <div class="card" style="width: 18rem;">
                        In Lineup Slot <?= $heroInfo6['InSlot']; ?> / 3
                        <?php
                    }
                    ?>
                        <div class="card-header">
                            <?= $heroInfo6['Name'] ?>
                        </div>
                        <!-- Add attack bonus to attack and defense bonus to defense as well... -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo6['Health'] ?> / <?= $heroInfo6['HealthMax'] ?><br>Level: <?= $heroInfo6['Level'] ?><br>Reawakening: <?= $heroInfo6['Reawaken'] ?><br>Experence: <?= $heroInfo6['Experience'] ?> / <?= $heroNextLevel6['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo6['Element'] ?><br>Attack: <?= $heroAttack ?><br>Defense: <?= $heroDefense ?></li>
                            <li class="list-group-item">Armor: <?= $heroInfo6['Armor'] ?><br>Weapon: <?= $heroInfo6['Weapon'] ?></li>
                        </ul>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>