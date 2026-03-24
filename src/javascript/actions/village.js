const upgradeBuilding = (buildingName) => {
    jQuery.ajax(
        {
            url: "ajax.php?do=villageUpgrade",
            method: "post",
            data: {
                building: buildingName
            },
            success: (response) => {
                console.log(response);
                res = JSON.parse(response);

                if (res['status'] == true) {
                    jQuery(`#${buildingName.toLowerCase()}cost`).text(res['newcost']);
                    jQuery("#usergold").text(res['newgoldbalance']);

                    let maxLevelText = "";
                    if (res['newcost'] == "Maximum Level") {
                        maxLevelText = ` (${res['newcost']})`;
                    }

                    jQuery(`#${buildingName.toLowerCase()}level`).text(res['newbuildinglevel'] + maxLevelText);
                }
            }
        }
    )
}