<?php require_once 'src/utils/actions/heroes.php'; ?>
<script src="src/javascript/actions/heroes.js"></script>

<div class="container">
    <br>
    <?php
        for ($i = 1; $i < 7; $i++) {
            if ($i === 1 || $i === 4) {
                ?>
                <div class="row">
                <?php
            }
            ?>
            <div class="col-sm-4">
                <?php
                    $heroInfo = getHeroInformation($i);
                    $heroNextLevel = getHeroNextLevelExp($heroInfo['Experience']);
                    $heroAttack = $heroInfo['Attack'] + $heroInfo['BonusAttack'];
                    $heroDefense = $heroInfo['Defense'] + $heroInfo['BonusDefense'];

                    $getHeroArmor = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                    $getHeroArmor->bind_param("i", $heroInfo['Armor']);
                    $getHeroArmor->execute();
                    $resultHeroArmor = $getHeroArmor->get_result();
                    $resultHeroArmorAssoc = $resultHeroArmor->fetch_assoc();

                    $getHeroWeapon = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                    $getHeroWeapon->bind_param("i", $heroInfo['Weapon']);
                    $getHeroWeapon->execute();
                    $resultHeroWeapon = $getHeroWeapon->get_result();
                    $resultHeroWeaponAssoc = $resultHeroWeapon->fetch_assoc();

                    if ($heroInfo['HeroNumber']) {
                    ?>
                    <div class="card" style="width: 14rem;">
                        <span id="hero<?= $i ?>lineupslot">
                            <?php
                            if ($heroInfo['InSlot'] !== 0) {
                                ?>
                                In Lineup Slot <?= $heroInfo['InSlot']; ?> / 3
                                <?php
                            }
                            ?>
                        </span>
                        <div class="card-header">
                            <?= $heroInfo['Name'] ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                HP: <?= $heroInfo['Health'] ?> / <?= $heroInfo['HealthMax'] ?>
                                <br>
                                Level: <?= $heroInfo['Level'] ?>
                                <br>
                                Reawakening: <?= $heroInfo['Reawaken'] ?>
                                <br>
                                Experence: <?= $heroInfo['Experience'] ?> / <?= $heroNextLevel['Experience'] ?>
                            </li>
                            <li class="list-group-item">
                                Element: <?= $heroInfo['Element'] ?>
                                <br>
                                Attack: <?= $heroAttack ?>
                                <br>
                                Defense: <?= $heroDefense ?></li>
                            <li class="list-group-item">
                                Armor: <?= $heroInfo['ArmorRarity'] ?> <?= $resultHeroArmorAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo['Armor']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo['Armor'] ?>, '<?= $heroInfo['ArmorRarity'] ?>', 'Armor', <?= $i ?>)">
                                        Unequip Armor
                                    </button>
                                    <br>
                                    <?php
                                }
                                ?>
                                Weapon: <?= $heroInfo['WeaponRarity'] ?> <?= $resultHeroWeaponAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo['Weapon']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo['Weapon'] ?>, '<?= $heroInfo['WeaponRarity'] ?>', 'Weapon', <?= $i ?>)">
                                        Unequip Weapon
                                    </button>
                                    <?php
                                }
                                ?>
                            </li>
                            <li class="list-group-item">
                                <div class="text-center">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Assign to lineup slot.
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo['HeroNumber'] ?>, 0)">Unassign</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo['HeroNumber'] ?>, 1)">Lineup Slot 1</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo['HeroNumber'] ?>, 2)">Lineup Slot 2</a></li>
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo['HeroNumber'] ?>, 3)">Lineup Slot 3</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
            }
            if ($i === 3 || $i === 6) {
                ?>
                </div>
                <br>
                <?php
            }
        }
    ?>
</div>