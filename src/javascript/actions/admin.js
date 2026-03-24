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

const editIconClass = "bi-pencil-square";
const saveIconClass = "bi-save2-fill";
const showEditField = (iconField, editField) => {
    jQuery(`#${iconField}`).removeClass(editIconClass).addClass(saveIconClass);
    jQuery(`#${editField}`);
}
