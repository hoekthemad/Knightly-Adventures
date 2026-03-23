const doRegister = () => {
    let username = jq("#username").val();
    let email = jq("#email").val();
    let password = jq("#password").val();
    jq.ajax({
        url: `ajax.php`,
        method: "POST",
        data: {
            do: "register",
            u: username,
            e: email,
            p: password
        },
        success: (res) => {
            console.log(res);
            result = JSON.parse(res);
            console.log(result)
            if (result['status'] == true) {
                window.location.href = "login.php";
            } else {
                alertify.alert(result['error']).setHeader("Register Failure");
            }
        }
    })
}