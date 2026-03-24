<?php

function getUserList() {
    global $connection;
    $getUsers = $connection->prepare(
        "SELECT
            users.uid, users.username, users.email, users.user_level,
            user_account.CreationTimestamp, user_account.gold, user_account.diamonds, user_account.InAction, user_account.InActionTimestamp
        FROM users
        INNER JOIN user_account ON users.uid = user_account.UserID
        "
    );
    $getUsers->execute();
    $result = $getUsers->get_result();
    if ($result->num_rows >= 1) {
        ?>
        <input class="form-control" id="searchusers" type="text" placeholder="Search" />
        <br />
        
        <table class="table table-striped table-hover" id="usertable">
            <thead>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">Username</td>
                    <td scope="col">Email</td>
                    <td scope="col">User Level</td>
                    <td scope="col">Creation Date</td>
                    <td scope="col">Gold</td>
                    <td scope="col">Diamonds</td>
                    <td scope="col">In Action</td>
                    <td scope="col">In Action Timestamp</td>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                ?><tr><?php
                    ?><th scope="row"><?= $row['uid']; ?></th><?php
                    ?><td><?= $row['username']; ?></td><?php
                    ?><td><?= $row['email']; ?></td><?php
                    ?><td><?= $row['user_level']; ?></td><?php
                    ?><td><?= date("jS \of F Y h:i:s A", $row['CreationTimestamp']); ?></td><?php
                    ?><td><?= $row['gold']; ?></td><?php
                    ?><td><?= $row['diamonds']; ?></td><?php
                    ?><td>
                        <a id="<?= $row['uid'] ?>inaction" onclick="toggleInAction(<?= $row['uid']; ?>, jQuery('#<?= $row['uid'] ?>inaction').text());"><?= $row['InAction'] == 0 ? "No" : "Yes"; ?></a>
                    </td><?php
                    ?><td><?= date("jS \of F Y h:i:s A", $row['InActionTimestamp']); ?></td><?php
                ?></tr><?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
}