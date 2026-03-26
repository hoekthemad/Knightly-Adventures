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

const updateField = (uid, field, value) => {

}

const editIconClass = "bi-pencil-square";
const saveIconClass = "bi-save2-fill";
const showEditField = (iconField, editField, fieldname, uid) => {
    jQuery(`#${iconField}`).toggleClass(editIconClass).toggleClass(saveIconClass);
    
    if (jQuery(`#${iconField}`).hasClass(editIconClass)) {
        jQuery(`#${iconField}`).prop("onclick", `updateField(${uid}, '${fieldname}', '')`);

        currentValue = jQuery(`#${editField}`).text();
        jQuery(`#${editField}`).innerHTML(`<input class="form-control" id="${fieldname}field${uid}" value="${currentValue}" />`);
    }
    else {
        jQuery(`#${iconField}`).prop("onclick", "");
    }
}
