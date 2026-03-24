<?php
if (!isPermitted("admin")) {
    exit("You do not have permission to access this page.");
}
require_once 'src/utils/actions/admin.php';
?>
<script src="src/javascript/actions/admin.js"></script>
<div class="container">
    <div class="jumbotron-fluid">
        <h3>Admin Panel</h3>
    </div>
    <?php
    getUserList();
    ?>
</div>