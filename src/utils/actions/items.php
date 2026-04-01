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
                        <td>
                            <?php
                                if ($resultItemNameArray['ItemType'] === 'Material') {
                                ?>
                                <button id="craft<?= $resultItemNameArray['ItemID'] ?>" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#craft<?= $resultItemNameArray['ItemID'] ?>modal">
                                    Craft
                                </button>
                                <div class="modal fade" id="craft<?= $resultItemNameArray['ItemID'] ?>modal" tabindex="-1" aria-labelledby="craft<?= $resultItemNameArray['ItemID'] ?>modallabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="craft<?= $resultItemNameArray['ItemID'] ?>modallabel"><?= $resultItemNameArray['ItemName'] ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php

                                            $getCraftRecipies = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                                            $getCraftRecipies->bind_param("i", $row['ItemID']);
                                            $getCraftRecipies->execute();
                                            $resultCraftRecipies = $getCraftRecipies->get_result();

                                            if ($resultCraftRecipies->num_rows >= 1) {
                                                while ($row2 = $resultCraftRecipies->fetch_assoc()) {

                                                    $getCraftRecipies = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                                                    $getCraftRecipies->bind_param("i", $row['ItemID']);
                                                    $getCraftRecipies->execute();
                                                    $resultCraftRecipies = $getCraftRecipies->get_result();





                                                    ?>
                                                    <div>
                                                        <button type="button" class="btn btn-primary" onclick="">
                                                            Text
                                                        </button>
                                                        Name of item...
                                                        <br>
                                                        <?= $row2['ItemID'] ?>
                                                    </div>
                                                    <?php
                                                }
                                            }

                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <?php
                                }
                            ?>
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
    }
}