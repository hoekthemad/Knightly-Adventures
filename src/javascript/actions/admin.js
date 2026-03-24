
jQuery(document).ready(function(){
    jQuery("#searchusers").on("keyup", function() {
        var value = jQuery(this).val().toLowerCase();
        jQuery("#usertable tbody tr").filter(function() {
            jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

const toggleInAction = (uid, currentInAction) => {
    console.log(currentInAction);
    newAction = currentInAction == "No" ? "Yes" : "No";
    jQuery.ajax({
        url: "ajax.php?do=updateUser",
        method: "post",
        data: {
            uid: uid,
            field: "InAction",
            value: newAction,
            success: (res) => {
                console.log(res)
                jQuery(`#${uid}inaction`).text(newAction);
            }
        }
    })
}
