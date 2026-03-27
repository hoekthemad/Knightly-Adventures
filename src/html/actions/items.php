<?php require_once 'src/utils/actions/items.php'; ?>
<script src="src/javascript/actions/items.js"></script>

<div class="container">
    <div class="jumbotron-fluid">
        <h3>Your Items</h3>
    </div>
    <?php
    getUserItems();
    ?>
</div>