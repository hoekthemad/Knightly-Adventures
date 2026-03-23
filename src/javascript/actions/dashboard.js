const getNews = () => {
    jq.ajax({
        url: `ajax.php?do=news`,
        method: "GET",
        success: (res) => {
            console.log(res);
            result = JSON.parse(res);
            if (result['status'] == true) {
                jQuery("#newsitem").text = result['message'];
            }
        }
    })
}