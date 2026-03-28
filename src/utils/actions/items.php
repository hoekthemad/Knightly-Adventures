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
    }
}