<?php
function getUserItems() {
    global $connection;

    $getItems = $connection->prepare("SELECT * FROM user_items WHERE UserID = ?");
    $getItems->bind_param("i", $uid);
    $getItems->execute();
    $resultItems = $getItems->get_result();

    if ($resultItems->num_rows >= 1) {
        var_dump($resultItems);
    }
    else {
        print(
            "Hi... this is awkward. You should not be seeing this as there is something in the fucking database...
            <br>
            <br>Not you Hoek. You SHOULD be seeing this. I shouldn't be.
            <br>
            <br>I don't fucking know what's going on but something is wrong with my items.php under utils...
            <br>
            <br>
            <br>
            <br>
            <br> Well, I give up for now. I can't seem to find why my results aren't greater than one even though there is a UserID that matches...
            <br>
            <br>
            <br> And I know it's not going to fix in the morning because, well... THERE IS NO FUCKING SHOT.
            <br>
            <br> I swear I'm not going insane, but this fucking code is about to make me stab someones dick off and shove it up their own asshole if I can't figure out why the fuck this code isn't working. Holy shit, please for the love of god just magically work already so I don't lose all my sanity.
            <br>
            <br>Did I ever tell you what the definition of insanity is?
            <br>Insanity is doing the exact same fucking thing over and over again, expecting shit to change. That is crazy.
            <br>But the first time somebody told me that, I don't know, I thought they were bullshitting me so, boom, I shot him.
            <br>The thing is, okay... he was right. And then I started to see it everywhere I looked. Everywhere I looked, all these fucking pricks, everywhere I looked, doing the exact same fucking thing, over and over and over and over and over again. Thinking 'This time, it's gonna be different.
            <br>No, no, no, no please! This time it's gonna be different.
            <br><h5>Did I ever tell you the definition of insanity?</h5>
        ");
    }




/*
    
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
                    ?><td>
                        <?= $row['username']; ?>
                    </td><?php
                    ?><td>
                        <?= $row['email']; ?>
                    </td><?php
                    ?><td>
                        <i id="<?= $row['uid']; ?>editlevel" class="bo bi-pencil-square" onclick="showEditField('<?= $row['uid']; ?>editlevel', '<?= $row['uid'] ?>userlevel', 'level', <?= $row['uid'] ?>)"></i> 
                        <div id="<?= $row['uid'] ?>userlevel"><?= $row['user_level']; ?></div>
                    </td><?php
                    ?><td>
                        <?= date("jS \of F Y h:i:s A", $row['CreationTimestamp']); ?>
                    </td><?php
                    ?><td>
                        <i id="<?= $row['uid']; ?>editgold" class="bo bi-pencil-square"></i> 
                        <div id="<?= $row['uid'] ?>usergold"><?= $row['gold']; ?></div>
                    </td><?php
                    ?><td>
                        <i id="<?= $row['uid']; ?>editdiamonds" class="bo bi-pencil-square"></i> 
                        <div id="<?= $row['uid'] ?>userdiamonds"><?= $row['diamonds']; ?></div>
                    </td><?php
                    ?><td>
                        <i class="bi bi-cursor-fill"></i> <a id="<?= $row['uid'] ?>inaction" onclick="toggleInAction(<?= $row['uid']; ?>, jQuery('#<?= $row['uid'] ?>inaction').text());"><?= $row['InAction'] == 0 ? "No" : "Yes"; ?></a>
                    </td><?php
                    ?><td><?= date("jS \of F Y h:i:s A", $row['InActionTimestamp']); ?></td><?php
                ?></tr><?php
            }
            ?>
            </tbody>
        </table>
        <?php

*/
}