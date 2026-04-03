<?php require_once 'src/utils/actions/chest.php'; ?>
<script src="src/javascript/actions/chest.js"></script>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4">
            <?php
                buildChestContainer(1);
            ?>
        </div>
        <div class="col-md-4">
            <?php
                buildChestContainer(2);
            ?>
        </div>
        <div class="col-md-4">
            <?php
                buildChestContainer(3);
            ?>
        </div>
    </div>
</div>