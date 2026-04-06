<?php 
require_once 'src/utils/actions/village.php'; 
$townHallList = getBuildingList("Town Hall");
$hospitalList = getBuildingList("Hospital");
$goldFactoryList = getBuildingList("Gold Factory");
$gemFactoryList = getBuildingList("Gem Factory");
?>
<script src="src/javascript/actions/village.js"></script>
<div class="container">
    <br>
    <div class="row">
        <!-- #region Town Hall and Hospital -->
        <div class="col-sm-4">
            <?php drawItemContainer($townHallList) ?>
            <br />
            <?php drawItemContainer($hospitalList) ?>
        </div>
        <!-- #endregion -->
        <!-- #region Gold Factories -->
        <div class="col-sm-4">
            <!-- <pre><code><?php var_dump($goldFactoryList); ?></code></pre> -->
            <?php 
            $goldFactoryCount = 0;
            while ($goldFactoryCount < $goldFactoryList['maxCount']) {
                drawItemContainer($goldFactoryList, $goldFactoryCount+1);
                $goldFactoryCount++;
                ?>
                <br />
                <?php
            }
            ?>
        </div>
        <!-- #endregion -->
        <!-- #region Gem Factories -->
        <div class="col-sm-4">
            <!-- <pre><code><?php var_dump($gemFactoryList); ?></code></pre> -->
            <?php 
            $gemFactoryCount = 0;
            while ($gemFactoryCount < $gemFactoryList['maxCount']) {
                drawItemContainer($gemFactoryList, $gemFactoryCount+1);
                $gemFactoryCount++;
                ?>
                <br />
                <?php
            }
            ?>
        </div>
        <!-- #endregion -->
    </div>
</div>