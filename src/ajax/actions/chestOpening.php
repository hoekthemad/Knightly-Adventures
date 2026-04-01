<?php

$chestID = !empty($_REQUEST['chest']) ? $_REQUEST['chest'] : false;
$uid = !empty($_SESSION['uid']) ? $_SESSION['uid'] : false;

$getChestItems = $connection->prepare("SELECT * FROM rule_chests WHERE ChestID = ?");
$getChestItems->bind_param("i", $chestID);
$getChestItems->execute();

$resultChestItems = $getChestItems->get_result();

if ($resultChestItems->num_rows >= 1) {

    $chestCost = 1000000;
    $chestCostType = 'Diamonds';
    $chestCostTypeFriendlyName = 'Gems';

    $getChestCost = $connection->prepare("SELECT * FROM rule_chests_cost WHERE ChestID = ?");
    $getChestCost->bind_param("i", $chestID);
    $getChestCost->execute();
    $resultChestCost = $getChestCost->get_result();
    $resultChestCostAssoc = $resultChestCost->fetch_assoc();

    $output['TESTING'] = $resultChestCostAssoc;

    if ($resultChestCostAssoc) {
        $chestCost = $resultChestCostAssoc['ChestCost'];
        $ChestCostType = $resultChestCostAssoc['ChestCostType'];
    }

    $getUserAccount = $connection->prepare("SELECT * FROM user_account WHERE UserID = ?");
    $getUserAccount->bind_param("i", $uid);
    $getUserAccount->execute();
    $resultUserAccount = $getUserAccount->get_result();
    $resultUserAccountAssoc = $resultUserAccount->fetch_assoc();

    if ($resultUserAccountAssoc[$chestCostType] < $chestCost) {
        $output['status'] = false;
        $output['message1'] = "Cannot open chest!";
        $output['message2'] = "You have $resultUserAccountAssoc[$chestCostType] $chestCostTypeFriendlyName out of the needed $chestCost $chestCostTypeFriendlyName!";
    }
    else {
        $output['status'] = true;

        $resultUserAccountAssoc[$chestCostType] -= $chestCost;
        $giveUserCurrency = $connection->prepare("UPDATE user_account SET $chestCostType = ? WHERE UserID = ?");
        $giveUserCurrency->bind_param("ii", $resultUserAccountAssoc[$chestCostType], $uid);
        $giveUserCurrency->execute();

        $itemIDArray = [];
        $itemAmountArray = [];
        $itemWeightArray = [];
        $weightTotal = 0;

        $loopCount1 = 1;
        while ($row = $resultChestItems->fetch_assoc()) {
            $weightTotal += $row['weight'];
            array_push($itemIDArray, $row['ItemID']);
            array_push($itemAmountArray, $row['Amount']);
            array_push($itemWeightArray, $row['Weight']);
            $weightTotal += $row['Weight'];
            $loopCount1++;
        }

        $winningItemNumber = 14;

        $winningItemID = 0;
        $winningItemName = null;
        $winningItemRarity = null;
        $winningItemAmount = 0;

        for ($i = 0; $i < ($winningItemNumber + 3); $i++) {

            $randomNumber = mt_rand(0, $weightTotal);
            $sumNumber = 0;

            for ($i2 = 0; $i2 < count($itemIDArray); $i2++) {

                $sumNumber += $itemWeightArray[$i2];

                if ($randomNumber <= $sumNumber) {

                    $getItemInfo = $connection->prepare("SELECT * FROM rule_items WHERE ItemID = ?");
                    $getItemInfo->bind_param("i", $itemIDArray[$i2]);
                    $getItemInfo->execute();
                    $resultItemInfo = $getItemInfo->get_result();
                    $resultItemInfoArray = $resultItemInfo->fetch_assoc();

                    $rarityValue = null;
                    if ($resultItemInfoArray['ItemType'] === "Weapon" || $resultItemInfoArray['ItemType'] === "Armor") {
                        $randonRarityNumber = mt_rand(0, 100);

                        $getItemRarity = $connection->prepare("SELECT * FROM rule_rarity WHERE Percent > ? ORDER BY Percent ASC");
                        $getItemRarity->bind_param("i", $randonRarityNumber);
                        $getItemRarity->execute();
                        $resultItemRarity = $getItemRarity->get_result();
                        $resultItemRarityAssoc = $resultItemRarity->fetch_assoc();

                        $rarityValue = $resultItemRarityAssoc['Rarity'];
                    }

                    if ($i === $winningItemNumber) {

                        $winningItemID = $itemIDArray[$i2];
                        $winningItemRarity = $rarityValue;
                        $winningItemName = $resultItemInfoArray['ItemName'];
                        $winningItemAmount = $itemAmountArray[$i2];

                        if ($rarityValue) {
                            $output['winningitem'] = $winningItemAmount." ".$winningItemRarity." ".$winningItemName;
                        }
                        else {
                            $output['winningitem'] = $winningItemAmount." ".$winningItemName;
                        }

                    }

                    if ($rarityValue) {
                        $output['itemspin'.$i] = $itemAmountArray[$i2]." ".$rarityValue." ".$resultItemInfoArray['ItemName'];
                    }
                    else {
                        $output['itemspin'.$i] = $itemAmountArray[$i2]." ".$resultItemInfoArray['ItemName'];
                    }

                    $i2 = count($itemIDArray);

                }
            }
        }

        $currentTimestamp = intval(strtotime(date("Y-m-d H:i:s")));

        $setChestLog = $connection->prepare("INSERT INTO logs_chests (UserID, Timestamp, Cost, CostType, ChestID, WinAmount, WinRarity, winItem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $setChestLog->bind_param("isisiiss", $uid, $currentTimestamp, $chestCost, $chestCostType, $chestID, $winningItemAmount, $winningItemRarity, $winningItemName);
        $setChestLog->execute();

        if ($winningItemID <= 2) {

            $updateGemName = "Gold";
            if ($winningItemID === 2) {
                $updateGemName = "Diamonds";
            }

            $getUserAccount2 = $connection->prepare("SELECT * FROM user_account WHERE UserID = ?");
            $getUserAccount2->bind_param("i", $uid);
            $getUserAccount2->execute();
            $resultUserAccount2 = $getUserAccount2->get_result();
            $resultUserAccountAssoc2 = $resultUserAccount2->fetch_assoc();

            $updateCurrencyValue = $resultUserAccountAssoc2[$updateGemName] + $winningItemAmount;

            $giveUserCurrency = $connection->prepare("UPDATE user_account SET $updateGemName = ? WHERE UserID = ?");
            $giveUserCurrency->bind_param("ii", $updateCurrencyValue, $uid);
            $giveUserCurrency->execute();
        }
        else {

            $resultUserItemsWinningItemAssoc = null;

            if ($winningItemID >= 10000) {

                $getUserItemsWinningItem = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
                $getUserItemsWinningItem->bind_param("iis", $uid, $winningItemID, $winningItemRarity);
                $getUserItemsWinningItem->execute();
                $resultUserItemsWinningItem = $getUserItemsWinningItem->get_result();
                $resultUserItemsWinningItemAssoc = $resultUserItemsWinningItem->fetch_assoc();

                if ($resultUserItemsWinningItemAssoc['ItemID']) {
                    $userItemAmount = $resultUserItemsWinningItemAssoc['Amount'] + $winningItemAmount;
                    $userItemTotal = $resultUserItemsWinningItemAssoc['Total'] + $winningItemAmount;

                    $giveUserItems = $connection->prepare("UPDATE user_items SET Amount = ?, Total = ? WHERE UserID = ? AND ItemID = ? AND Rarity = ?");
                    $giveUserItems->bind_param("iiiis", $userItemAmount, $userItemTotal, $uid, $winningItemID, $winningItemRarity);
                    $giveUserItems->execute();
                }

                else {
                    $giveUserItem = $connection->prepare("INSERT INTO user_items (UserID, ItemID, Rarity, Amount, Total) VALUES (?, ?, ?, ?, ?)");
                    $giveUserItem->bind_param("iisii", $uid, $winningItemID, $winningItemRarity, $winningItemAmount, $winningItemAmount);
                    $giveUserItem->execute();
                }

            }
            else {

                $getUserItemsWinningItem = $connection->prepare("SELECT * FROM user_items WHERE UserID = ? AND ItemID = ?");
                $getUserItemsWinningItem->bind_param("ii", $uid, $winningItemID);
                $getUserItemsWinningItem->execute();
                $resultUserItemsWinningItem = $getUserItemsWinningItem->get_result();
                $resultUserItemsWinningItemAssoc = $resultUserItemsWinningItem->fetch_assoc();

                if ($resultUserItemsWinningItemAssoc['ItemID']) {
                    $userItemAmount = $resultUserItemsWinningItemAssoc['Amount'] + $winningItemAmount;
                    $userItemTotal = $resultUserItemsWinningItemAssoc['Total'] + $winningItemAmount;

                    $giveUserItems = $connection->prepare("UPDATE user_items SET Amount = ?, Total = ? WHERE UserID = ? AND ItemID = ?");
                    $giveUserItems->bind_param("iiii", $userItemAmount, $userItemTotal, $uid, $winningItemID);
                    $giveUserItems->execute();
                }

                else {
                    $giveUserItem = $connection->prepare("INSERT INTO user_items (UserID, ItemID, Amount, Total) VALUES (?, ?, ?, ?, ?)");
                    $giveUserItem->bind_param("iiii", $uid, $winningItemID, $winningItemAmount, $winningItemAmount);
                    $giveUserItem->execute();
                }
            }
        }
    }
}