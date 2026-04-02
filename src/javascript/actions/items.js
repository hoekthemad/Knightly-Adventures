async function craftItem(materialID, toCraftID) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=craftItem",
        method: "post",
        data: {
            material: materialID,
            craft: toCraftID
        },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

    }
}

async function equipItem(heroNumber, itemID, rarityValue, itemType) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=equipItem",
        method: "post",
        data: {
            hero: heroNumber,
            item: itemID,
            rarity: rarityValue,
            type: itemType
        },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

    }
}