const openChest = (chestName) => {
    jQuery.ajax(
        {
            url: "ajax.php?do=chestOpening",
            method: "post",
            data: {
                chest: chestName
            },
            success: (response) => {
                console.log(response);
                res = JSON.parse(response);

                if (res['status'] === true) {
                    jQuery(`#result`).text("Text.");
                }
            }
        }
    )
}