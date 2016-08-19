/**
 * Created by scottwilson on 8/19/16.
 */
function validateFormData() {
    var x = document.forms["submitSightingForm"]["eMail"].value;

    //Checks for the occurance of a @ and . in the field
    if ((x.indexOf("@") == -1 || x.indexOf(".") == -1) &&
        x.length != 0) {
        alert("Invalid email");
        return false;
    }

    //Checks for pattern of ### ### ####
    x = document.forms["submitSightingForm"]["phoneNum"].value;
    var regex = /([0-9]{3})+.+([0-9]{3})+.+([0-9]{4})+/
    if (!regex.exec(x) && x.length != 0) {
        alert("Invalid phone number");
        return false;
    }

    x = document.forms["submitSightingForm"]["date"].value;

    var splitDate = x.split("-");
    var today = new Date();
    if (splitDate[0] > today.getFullYear() ||
        (splitDate[1] > today.getMonth() + 1 &&
        splitDate[0] == today.getFullYear()) ||
        (splitDate[2] > today.getDate() &&
        splitDate[1] >= today.getMonth() +1 &&
        splitDate[0] == today.getFullYear())) {
        alert("Invalid date");
        return false;
    }

    regex = /([0-9]{4})+.+([0-9]{2})+.+([0-9]{2})+/
    if (!regex.exec(x) || x == null) {
        alert("Invalid date");
        return false;
    }

    return true;
}