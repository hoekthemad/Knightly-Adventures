<?php require_once 'src/utils/actions/heroes.php'; ?>
<script src="src/javascript/actions/heroes.js"></script>

<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-4">
            <?php
                $heroInfo1 = getHeroInformation(1);
                $heroNextLevel1 = getHeroNextLevelExp($heroInfo1['Experience']);
                $heroAttack1 = $heroInfo1['Attack'] + $heroInfo1['BonusAttack'];
                $heroDefense1 = $heroInfo1['Defense'] + $heroInfo1['BonusDefense'];

                $getHeroArmor = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroArmor->bind_param("i", $heroInfo1['Armor']);
                $getHeroArmor->execute();
                $resultHeroArmor = $getHeroArmor->get_result();
                $resultHeroArmorAssoc = $resultHeroArmor->fetch_assoc();

                $getHeroWeapon = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroWeapon->bind_param("i", $heroInfo1['Weapon']);
                $getHeroWeapon->execute();
                $resultHeroWeapon = $getHeroWeapon->get_result();
                $resultHeroWeaponAssoc = $resultHeroWeapon->fetch_assoc();

                // Get equiped item information.
            ?>
            <div class="card" style="width: 14rem;">
                <span id="hero1lineupslot">
                    <?php
                    if ($heroInfo1['InSlot'] !== 0) {
                        ?>
                        In Lineup Slot <?= $heroInfo1['InSlot']; ?> / 3
                        <?php
                    }
                    ?>
                </span>
                <div class="card-header">
                    <?= $heroInfo1['Name'] ?>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        HP: <?= $heroInfo1['Health'] ?> / <?= $heroInfo1['HealthMax'] ?>
                        <br>
                        Level: <?= $heroInfo1['Level'] ?>
                        <br>
                        Reawakening: <?= $heroInfo1['Reawaken'] ?>
                        <br>
                        Experence: <?= $heroInfo1['Experience'] ?> / <?= $heroNextLevel1['Experience'] ?>
                    </li>
                    <li class="list-group-item">
                        Element: <?= $heroInfo1['Element'] ?>
                        <br>
                        Attack: <?= $heroAttack1 ?>
                        <br>
                        Defense: <?= $heroDefense1 ?></li>
                    <li class="list-group-item">
                        Armor: <?= $heroInfo1['ArmorRarity'] ?> <?= $resultHeroArmorAssoc['ItemName'] ?>
                        <br>
                        <?php
                        if ($heroInfo1['Armor']) {
                            ?>
                            <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo1['Armor'] ?>, '<?= $heroInfo1['ArmorRarity'] ?>', 'Armor', 1)">
                                Unequip Armor
                            </button>
                            <br>
                            <?php
                        }
                        ?>
                        Weapon: <?= $heroInfo1['WeaponRarity'] ?> <?= $resultHeroWeaponAssoc['ItemName'] ?>
                        <br>
                        <?php
                        if ($heroInfo1['Weapon']) {
                            ?>
                            <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo1['Weapon'] ?>, '<?= $heroInfo1['WeaponRarity'] ?>', 'Weapon', 1)">
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
                                <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo1['HeroNumber'] ?>, 0)">Unassign</a></li>
                                <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo1['HeroNumber'] ?>, 1)">Lineup Slot 1</a></li>
                                <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo1['HeroNumber'] ?>, 2)">Lineup Slot 2</a></li>
                                <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo1['HeroNumber'] ?>, 3)">Lineup Slot 3</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <?php
                $heroInfo2 = getHeroInformation(2);
                $heroNextLevel2 = getHeroNextLevelExp($heroInfo2['Experience']);
                $heroAttack2 = $heroInfo2['Attack'] + $heroInfo2['BonusAttack'];
                $heroDefense2 = $heroInfo2['Defense'] + $heroInfo2['BonusDefense'];

                $getHeroArmor = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroArmor->bind_param("i", $heroInfo2['Armor']);
                $getHeroArmor->execute();
                $resultHeroArmor = $getHeroArmor->get_result();
                $resultHeroArmorAssoc = $resultHeroArmor->fetch_assoc();

                $getHeroWeapon = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroWeapon->bind_param("i", $heroInfo2['Weapon']);
                $getHeroWeapon->execute();
                $resultHeroWeapon = $getHeroWeapon->get_result();
                $resultHeroWeaponAssoc = $resultHeroWeapon->fetch_assoc();

                if (!empty($heroInfo2)) {
                    ?>
                    <div class="card" style="width: 14rem;">
                        <span id="hero2lineupslot">
                            <?php
                            if ($heroInfo2['InSlot'] !== 0) {
                                ?>
                                In Lineup Slot <?= $heroInfo2['InSlot']; ?> / 3
                                <?php
                            }
                            ?>
                        </span>
                        <div class="card-header">
                            <?= $heroInfo2['Name'] ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo2['Health'] ?> / <?= $heroInfo2['HealthMax'] ?><br>Level: <?= $heroInfo2['Level'] ?><br>Reawakening: <?= $heroInfo2['Reawaken'] ?><br>Experence: <?= $heroInfo2['Experience'] ?> / <?= $heroNextLevel2['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo2['Element'] ?><br>Attack: <?= $heroAttack2 ?><br>Defense: <?= $heroDefense2 ?></li>
                            <li class="list-group-item">
                                Armor: <?= $heroInfo2['ArmorRarity'] ?> <?= $resultHeroArmorAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo2['Armor']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo2['Armor'] ?>, '<?= $heroInfo2['ArmorRarity'] ?>', 'Armor', 2)">
                                        Unequip Armor
                                    </button>
                                    <br>
                                    <?php
                                }
                                ?>
                                Weapon: <?= $heroInfo2['WeaponRarity'] ?> <?= $resultHeroWeaponAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo2['Weapon']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo2['Weapon'] ?>, '<?= $heroInfo2['WeaponRarity'] ?>', 'Weapon', 2)">
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
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo2['HeroNumber'] ?>, 0)">Unassign</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo2['HeroNumber'] ?>, 1)">Lineup Slot 1</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo2['HeroNumber'] ?>, 2)">Lineup Slot 2</a></li>
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo2['HeroNumber'] ?>, 3)">Lineup Slot 3</a></li>
                                    </ul>
                                </div>
                            </li>
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
                $heroAttack3 = $heroInfo3['Attack'] + $heroInfo3['BonusAttack'];
                $heroDefense3 = $heroInfo3['Defense'] + $heroInfo3['BonusDefense'];

                $getHeroArmor = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroArmor->bind_param("i", $heroInfo3['Armor']);
                $getHeroArmor->execute();
                $resultHeroArmor = $getHeroArmor->get_result();
                $resultHeroArmorAssoc = $resultHeroArmor->fetch_assoc();

                $getHeroWeapon = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroWeapon->bind_param("i", $heroInfo3['Weapon']);
                $getHeroWeapon->execute();
                $resultHeroWeapon = $getHeroWeapon->get_result();
                $resultHeroWeaponAssoc = $resultHeroWeapon->fetch_assoc();

                if (!empty($heroInfo3)) {
                    ?>
                    <div class="card" style="width: 14rem;">
                        <?php
                        if ($heroInfo3['InSlot'] !== 0) {
                            ?>
                            In Lineup Slot <?= $heroInfo3['InSlot']; ?> / 3
                            <?php
                        }
                        ?>
                        <div class="card-header">
                            <?= $heroInfo3['Name'] ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo3['Health'] ?> / <?= $heroInfo3['HealthMax'] ?><br>Level: <?= $heroInfo3['Level'] ?><br>Reawakening: <?= $heroInfo3['Reawaken'] ?><br>Experence: <?= $heroInfo3['Experience'] ?> / <?= $heroNextLevel3['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo3['Element'] ?><br>Attack: <?= $heroAttack3 ?><br>Defense: <?= $heroDefense3 ?></li>
                            <li class="list-group-item">
                                Armor: <?= $heroInfo3['ArmorRarity'] ?> <?= $resultHeroArmorAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo3['Armor']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo3['Armor'] ?>, '<?= $heroInfo3['ArmorRarity'] ?>', 'Armor', 3)">
                                        Unequip Armor
                                    </button>
                                    <br>
                                    <?php
                                }
                                ?>
                                Weapon: <?= $heroInfo3['WeaponRarity'] ?> <?= $resultHeroWeaponAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo3['Weapon']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo3['Weapon'] ?>, '<?= $heroInfo3['WeaponRarity'] ?>', 'Weapon', 3)">
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
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo3['HeroNumber'] ?>, 0)">Unassign</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo3['HeroNumber'] ?>, 1)">Lineup Slot 1</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo3['HeroNumber'] ?>, 2)">Lineup Slot 2</a></li>
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo3['HeroNumber'] ?>, 3)">Lineup Slot 3</a></li>
                                    </ul>
                                </div>
                            </li>
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
                $heroAttack4 = $heroInfo4['Attack'] + $heroInfo4['BonusAttack'];
                $heroDefense4 = $heroInfo4['Defense'] + $heroInfo4['BonusDefense'];

                $getHeroArmor = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroArmor->bind_param("i", $heroInfo4['Armor']);
                $getHeroArmor->execute();
                $resultHeroArmor = $getHeroArmor->get_result();
                $resultHeroArmorAssoc = $resultHeroArmor->fetch_assoc();

                $getHeroWeapon = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroWeapon->bind_param("i", $heroInfo4['Weapon']);
                $getHeroWeapon->execute();
                $resultHeroWeapon = $getHeroWeapon->get_result();
                $resultHeroWeaponAssoc = $resultHeroWeapon->fetch_assoc();

                if (!empty($heroInfo4)) {
                    ?>
                    <div class="card" style="width: 14rem;">
                        <?php
                        if ($heroInfo4['InSlot'] !== 0) {
                            ?>
                            In Lineup Slot <?= $heroInfo4['InSlot']; ?> / 3
                            <?php
                        }
                        ?>
                        <div class="card-header">
                            <?= $heroInfo4['Name'] ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo4['Health'] ?> / <?= $heroInfo4['HealthMax'] ?><br>Level: <?= $heroInfo4['Level'] ?><br>Reawakening: <?= $heroInfo4['Reawaken'] ?><br>Experence: <?= $heroInfo4['Experience'] ?> / <?= $heroNextLevel4['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo4['Element'] ?><br>Attack: <?= $heroAttack4 ?><br>Defense: <?= $heroDefense4 ?></li>
                            <li class="list-group-item">
                                Armor: <?= $heroInfo4['ArmorRarity'] ?> <?= $resultHeroArmorAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo4['Armor']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo4['Armor'] ?>, '<?= $heroInfo4['ArmorRarity'] ?>', 'Armor', 4)">
                                        Unequip Armor
                                    </button>
                                    <br>
                                    <?php
                                }
                                ?>
                                Weapon: <?= $heroInfo4['WeaponRarity'] ?> <?= $resultHeroWeaponAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo4['Weapon']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo4['Weapon'] ?>, '<?= $heroInfo4['WeaponRarity'] ?>', 'Weapon', 4)">
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
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo4['HeroNumber'] ?>, 0)">Unassign</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo4['HeroNumber'] ?>, 1)">Lineup Slot 1</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo4['HeroNumber'] ?>, 2)">Lineup Slot 2</a></li>
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo4['HeroNumber'] ?>, 3)">Lineup Slot 3</a></li>
                                    </ul>
                                </div>
                            </li>
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
                $heroAttack5 = $heroInfo5['Attack'] + $heroInfo5['BonusAttack'];
                $heroDefense5 = $heroInfo5['Defense'] + $heroInfo5['BonusDefense'];

                $getHeroArmor = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroArmor->bind_param("i", $heroInfo5['Armor']);
                $getHeroArmor->execute();
                $resultHeroArmor = $getHeroArmor->get_result();
                $resultHeroArmorAssoc = $resultHeroArmor->fetch_assoc();

                $getHeroWeapon = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroWeapon->bind_param("i", $heroInfo5['Weapon']);
                $getHeroWeapon->execute();
                $resultHeroWeapon = $getHeroWeapon->get_result();
                $resultHeroWeaponAssoc = $resultHeroWeapon->fetch_assoc();

                if (!empty($heroInfo5)) {
                    ?>
                    <div class="card" style="width: 14rem;">
                        <?php
                        if ($heroInfo5['InSlot'] !== 0) {
                            ?>
                            In Lineup Slot <?= $heroInfo5['InSlot']; ?> / 3
                            <?php
                        }
                        ?>
                        <div class="card-header">
                            <?= $heroInfo5['Name'] ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo5['Health'] ?> / <?= $heroInfo5['HealthMax'] ?><br>Level: <?= $heroInfo5['Level'] ?><br>Reawakening: <?= $heroInfo5['Reawaken'] ?><br>Experence: <?= $heroInfo5['Experience'] ?> / <?= $heroNextLevel5['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo5['Element'] ?><br>Attack: <?= $heroAttack5 ?><br>Defense: <?= $heroDefense5 ?></li>
                            <li class="list-group-item">
                                Armor: <?= $heroInfo5['ArmorRarity'] ?> <?= $resultHeroArmorAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo5['Armor']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo5['Armor'] ?>, '<?= $heroInfo5['ArmorRarity'] ?>', 'Armor', 5)">
                                        Unequip Armor
                                    </button>
                                    <br>
                                    <?php
                                }
                                ?>
                                Weapon: <?= $heroInfo5['WeaponRarity'] ?> <?= $resultHeroWeaponAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo5['Weapon']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo5['Weapon'] ?>, '<?= $heroInfo5['WeaponRarity'] ?>', 'Weapon', 5)">
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
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo5['HeroNumber'] ?>, 0)">Unassign</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo5['HeroNumber'] ?>, 1)">Lineup Slot 1</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo5['HeroNumber'] ?>, 2)">Lineup Slot 2</a></li>
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo5['HeroNumber'] ?>, 3)">Lineup Slot 3</a></li>
                                    </ul>
                                </div>
                            </li>
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
                $heroAttack6 = $heroInfo6['Attack'] + $heroInfo6['BonusAttack'];
                $heroDefense6 = $heroInfo6['Defense'] + $heroInfo6['BonusDefense'];

                $getHeroArmor = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroArmor->bind_param("i", $heroInfo6['Armor']);
                $getHeroArmor->execute();
                $resultHeroArmor = $getHeroArmor->get_result();
                $resultHeroArmorAssoc = $resultHeroArmor->fetch_assoc();

                $getHeroWeapon = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                $getHeroWeapon->bind_param("i", $heroInfo6['Weapon']);
                $getHeroWeapon->execute();
                $resultHeroWeapon = $getHeroWeapon->get_result();
                $resultHeroWeaponAssoc = $resultHeroWeapon->fetch_assoc();

                if (!empty($heroInfo6)) {
                    ?>
                    <div class="card" style="width: 14rem;">
                        <?php
                        if ($heroInfo6['InSlot'] !== 0) {
                            ?>
                            In Lineup Slot <?= $heroInfo6['InSlot']; ?> / 3
                            <?php
                        }
                        ?>
                        <div class="card-header">
                            <?= $heroInfo6['Name'] ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">HP: <?= $heroInfo6['Health'] ?> / <?= $heroInfo6['HealthMax'] ?><br>Level: <?= $heroInfo6['Level'] ?><br>Reawakening: <?= $heroInfo6['Reawaken'] ?><br>Experence: <?= $heroInfo6['Experience'] ?> / <?= $heroNextLevel6['Experience'] ?></li>
                            <li class="list-group-item">Element: <?= $heroInfo6['Element'] ?><br>Attack: <?= $heroAttack6 ?><br>Defense: <?= $heroDefense6 ?></li>
                            <li class="list-group-item">
                                Armor: <?= $heroInfo6['ArmorRarity'] ?> <?= $resultHeroArmorAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo6['Armor']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo6['Armor'] ?>, '<?= $heroInfo6['ArmorRarity'] ?>', 'Armor', 6)">
                                        Unequip Armor
                                    </button>
                                    <br>
                                    <?php
                                }
                                ?>
                                Weapon: <?= $heroInfo6['WeaponRarity'] ?> <?= $resultHeroWeaponAssoc['ItemName'] ?>
                                <br>
                                <?php
                                if ($heroInfo6['Weapon']) {
                                    ?>
                                    <button type="button" class="btn btn-primary" onclick="unequipItem(<?= $heroInfo6['Weapon'] ?>, '<?= $heroInfo6['WeaponRarity'] ?>', 'Weapon', 6)">
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
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo6['HeroNumber'] ?>, 0)">Unassign</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo6['HeroNumber'] ?>, 1)">Lineup Slot 1</a></li>
                                        <li><a class="dropdown-item" href="dashboard.php?action=heroes" onclick="setHeroLineup(<?= $heroInfo6['HeroNumber'] ?>, 2)">Lineup Slot 2</a></li>
                                        <li><a class="dropdown-item" href='dashboard.php?action=heroes' onclick="setHeroLineup(<?= $heroInfo6['HeroNumber'] ?>, 3)">Lineup Slot 3</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>