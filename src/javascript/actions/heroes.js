async function setHeroLineup(heroNumber, slotNumber) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=heroLineup",
        method: "post",
        data: {
            hero: heroNumber,
            slot: slotNumber
        },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

    }
}

async function unequipItem(itemID, itemRarity, itemType, heroNumber) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=unequipItem",
        method: "post",
        data: {
            item: itemID,
            rarity: itemRarity,
            type: itemType,
            number: heroNumber
        },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

    }
}