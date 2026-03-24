
jQuery(document).ready(function(){
    jQuery("#searchusers").on("keyup", function() {
        var value = jQuery(this).val().toLowerCase();
        jQuery("#usertable tbody tr").filter(function() {
            jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

const toggleInAction = (uid, currentInAction) => {
    // Get new InAction
    newAction = currentInAction == "No" ? "Yes" : "No";
    // Do an AJAX call
    jQuery.ajax({
        // The URL we are targetting
        url: "ajax.php?do=updateUser",
        // The method (POST|GET)
        method: "post",
        // The data we are sending
        data: {
            uid: uid,
            field: "InAction",
            value: newAction,
        },
        // On completion of the AJAX
        success: (res) => {
            // Update the text of the user rows inaction field
            jQuery(`#${uid}inaction`).text(newAction);
        }
    })
}
