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
                        jQuery(`#${buildingName}ModalLink`).hide();
                    }

                    jQuery(`#${buildingName.toLowerCase()}level`).text(res['newbuildinglevel'] + maxLevelText);

                    if (res['updateprod'] == true) {
                        jQuery(`#${buildingName.toLowerCase()}prod`).text(res['newprod']);
                        jQuery(`#${buildingName.toLowerCase()}bonus`).text(res['nextnewprod']);
                    }

                    if (res['upgradetownhall'] == true) {
                        jQuery(`#goldfactory1townhalllevel`).text("");
                        jQuery(`#goldfactory2townhalllevel`).text("");
                        jQuery(`#goldfactory3townhalllevel`).text("");
                        jQuery(`#goldfactory4townhalllevel`).text("");
                        jQuery(`#gemsfactory1townhalllevel`).text("");
                        jQuery(`#gemsfactory2townhalllevel`).text("");
                        jQuery(`#hospitaltownhalllevel`).text("");
                    }
                }
                else {
                    if (res['townhalllevel'] >= 1) {
                        const maxTownHallText = "You can only level buildings up to level " + (res['townhalllevel'] - 1) + ". Please upgrade your Town Hall first.";
                        jQuery(`#${buildingName.toLowerCase()}townhalllevel`).text(maxTownHallText);
                    }
                }
            }
        }
    )
}

const upgradeBuildingv2 = (buildingName) => {
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
                        jQuery(`#${buildingName.toLowerCase()}modallink`).hide();
                    }

                    jQuery(`#${buildingName.toLowerCase()}level`).text(res['newbuildinglevel'] + maxLevelText);

                    if (res['updateprod'] == true) {
                        jQuery(`#${buildingName.toLowerCase()}prod`).text(res['newprod']);
                        jQuery(`#${buildingName.toLowerCase()}bonus`).text(res['nextnewprod']);
                    }

                    if (res['upgradetownhall'] == true) {
                        jQuery(`#goldfactory1townhalllevel`).text("");
                        jQuery(`#goldfactory2townhalllevel`).text("");
                        jQuery(`#goldfactory3townhalllevel`).text("");
                        jQuery(`#goldfactory4townhalllevel`).text("");
                        jQuery(`#gemsfactory1townhalllevel`).text("");
                        jQuery(`#gemsfactory2townhalllevel`).text("");
                        jQuery(`#hospitaltownhalllevel`).text("");
                    }
                }
                else {
                    if (res['townhalllevel'] >= 1) {
                        const maxTownHallText = "You can only level buildings up to level " + (res['townhalllevel'] - 1) + ". Please upgrade your Town Hall first.";
                        jQuery(`#${buildingName.toLowerCase()}townhalllevel`).text(maxTownHallText);
                    }
                }
            }
        }
    )
}