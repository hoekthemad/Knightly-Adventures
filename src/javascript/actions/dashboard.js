const getNews = () => {
    jq.ajax({
        url: `ajax.php?do=news`,
        method: "GET",
        success: (res) => {
            result = JSON.parse(res);
            if (result['status'] == true) {
                jQuery("#newsitem").html(result['message']);
                if (result['wbs'] == true) {
                    if (jQuery("#wbs_menu").hasClass("disabled")) jQuery("#wbs_menu").removeClass("disabled");
                }
                else {
                    if (!jQuery("#wbs_menu").hasClass("disabled")) jQuery("#wbs_menu").addClass("disabled");
                }
            }
        }
    })
}