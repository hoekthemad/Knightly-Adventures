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
    <hr>
    <?php
    // Get the currently logged in user
    $myUser = getMyUser();
    // Draw the HTML elements, using <?= shorthand (this is the same as an echo/print)
    ?>
    UserID: <input class="form-control" value="<?= $myUser['uid'] ?>"><br>
    Username: <input class="form-control" value="<?= $myUser['username'] ?>"><br>
    Email: <input class="form-control" value="<?= $myUser['email'] ?>"><br>
</div>