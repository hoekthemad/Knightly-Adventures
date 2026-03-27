<?php
function getUserItems() {
    global $connection;

    $getItems = $connection->prepare("SELECT * FROM user_items WHERE UserID = ?");
    $getItems->bind_param("i", $_SESSION['uid']);
    $getItems->execute();
    $resultItems = $getItems->get_result();

    if ($resultItems->num_rows >= 1) {
        ?>
        <input class="form-control" id="useritems" type="text" placeholder="Search" />
        <br />
        
        <table class="table table-striped table-hover" id="itemtable">
            <thead>
                <tr>
                    <td scope="col">Item</td>
                    <td scope="col">Rarity</td>
                    <td scope="col">Currently Have</td>
                    <td scope="col">Total Collected</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $resultItems->fetch_assoc()) {
                    $getItemName = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                    $getItemName->bind_param("i", $row['ItemID']);
                    $getItemName->execute();
                    $resultItemName = $getItemName->get_result();
                    $resultItemNameArray = $resultItemName->fetch_array();
                    ?>
                    <tr>
                        <td>
                            <?= $resultItemNameArray['ItemName']; ?>
                        </td>
                        <td>
                            <?= $row['Rarity']; ?>
                        </td>
                        <td>
                            <?= $row['Amount']; ?>
                        </td>
                        <td>
                            <?= $row['Total']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    else {
        ?>
        <input class="form-control" id="useritems" type="text" placeholder="Search" />
        <br />
        
        <table class="table table-striped table-hover" id="itemtable">
            <thead>
                <tr>
                    <td scope="col">Item</td>
                    <td scope="col">Rarity</td>
                    <td scope="col">Currently Have</td>
                    <td scope="col">Total Collected</td>
                </tr>
            </thead>
        </table>
        <?php

        print(
            "Hi... this is awkward. You should not be seeing this as there is something in the fucking database...
            <br>
            <br>Not you Hoek. You SHOULD be seeing this. I shouldn't be.
            <br>
            <br>I don't fucking know what's going on but something is wrong with my items.php under utils...
            <br>
            <br>
            <br> Well, I give up for now. I can't seem to find why my results aren't greater than one even though there is a UserID that matches...
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
            <br>
            <br>I fixed the issues... but I'm leaving this gem here for you to see at some point because holy shit was I going insane.
        ");
    }
}