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
                    jQuery("#townhallcost").text(res['newcost']);
                    jQuery("#usergold").text(res['newgoldbalance']);
                    jQuery("#townhalllevel").text(res['newbuildinglevel']);
                }
            }
        }
    )
}