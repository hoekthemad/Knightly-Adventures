const doLogin = () => {
    let username = jq("#nameemail").val();
    let password = jq("#password").val();
    jq.ajax({
        url: `ajax.php?do=login&k=${username}&p=${password}`,
        method: "GET",
        success: (res) => {
            console.log(res);
            result = JSON.parse(res);
            if (result['status'] == true) {
                alertify.alert("Login successful").setHeader("Success");
                window.location.href = "dashboard.php";
            } else {
                alertify.alert(result['error']).setHeader("Login Failure");
            }
        }
    })
}