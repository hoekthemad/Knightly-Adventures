const openChest = (chestID) => {
    jQuery.ajax(
        {
            url: "ajax.php?do=chestOpening",
            method: "post",
            data: {
                chest: chestID
            },
            success: (response) => {
                console.log(response);
                res = JSON.parse(response);

                if (res['status'] == true) {
                    jQuery(`#result`).text(res['winitemamount'] + " " + res['winitemname']);
                }
            }
        }
    )
}