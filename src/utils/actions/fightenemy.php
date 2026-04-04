<?php
function getUserStages() {
    global $connection;

    $getUserAccount = $connection->prepare("SELECT * FROM user_account WHERE UserID = ?");
    $getUserAccount->bind_param("i", $_SESSION['uid']);
    $getUserAccount->execute();
    $resultUserAccount = $getUserAccount->get_result();
    $resultUserAccountAssoc = $resultUserAccount->fetch_assoc();

    $getStages = $connection->prepare("SELECT * FROM rule_stage_adventure WHERE Stage <= ? ORDER BY Stage DESC");
    $getStages->bind_param("i", $resultUserAccountAssoc['QuestStage']);
    $getStages->execute();
    $resultStages = $getStages->get_result();





    if ($resultStages->num_rows >= 1) {
        ?>        
        <table class="table table-striped table-hover" id="fightenemytable">
            <thead>
                <tr>
                    <td scope="col">Stage</td>
                    <td scope="col"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $resultStages->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?= $row['Stage']; ?>
                        </td>
                        <td>
                            <button id="fight<?= $row['stage']; ?>" type="button" class="btn btn-primary" onclick="fightEnemyStage(<?= $row['Stage']; ?>)">
                                Fight
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
}