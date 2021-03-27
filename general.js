"use strict";
window.onload = pageLoad;

function pageLoad() {
    document.getElementById("nameSubmit").onclick = checkName;
    document.getElementById("usernameSubmit").onclick = checkUsername;

    document.getElementById("nameSubmit").onmouseover = change_one;
    document.getElementById("usernameSubmit").onmouseover = change_one;

    document.getElementById("nameSubmit").onmouseout = change_two;
    document.getElementById("usernameSubmit").onmouseout = change_two;



    document.getElementById("fname").onmouseover = showTip;
    document.getElementById("fname").onmouseout = showTip;

    document.getElementById("lname").onmouseover = showTip;
    document.getElementById("lname").onmouseout = showTip;

    document.getElementById("uname").onmouseover = showTip;
    document.getElementById("uname").onmouseout = showTip;
}

function checkName() {
    //first, last name
    var firstname = document.getElementById("fname").value;
    var lastname = document.getElementById("lname").value;

    //check empty username field
    if (firstname == "") {
        alert("First name must be filled out.");
        return false;
    }

    //check empty street field
    if (lastname == "") {
        alert("Last name must be filled out.");
        return false;
    }

    var name_pattern = /^[A-z\s]+$/;
    var firstname_result = name_pattern.test(firstname);
    var lastname_result = name_pattern.test(lastname);


    if (!firstname_result) {
        alert("The first name entered is not in the correct format. Only word and space characters are permitted. Please go back re-enter first name.");
        document.getElementById("fname").select();
        return false;
    }

    if (!lastname_result) {
        alert("The last name entered is not in the correct format. Only word and space characters are permitted. Please go back re-enter last name.");
        document.getElementById("lname").select();
        return false;
    }

    else {
        alert("Success!\nFirst name has been set to: " + firstname + " \nLast name has been set to: " + lastname);
        return true;
    }

}

function checkUsername() {
    //username
    var username = document.getElementById("uname").value;

    var username_pattern = /^[A-z0-9]+$/;
    var username_result = username_pattern.test(username);

    if (username == "") {
        alert("Username must be filled out.");
        return false;
    }

    if (username_result == false) {
        alert("Username entered is not in the correct format. Only word and numerical characters are permitted. Please go back re-enter username.");
        document.getElementById("uname").select();
        return false;
    }

    else {
        alert("Success!\nUsername has been set to: " + username);
        return true;
    }
}

function showTip() {

    if ((event.type == "mouseover")) {
        switch (event.target.id) {
            case "fname":
            case "lname":
                document.getElementById("nameTip").style.visibility = "visible";
                document.getElementById("nameTip").style.fontSize = "10pt";
                document.getElementById("nameTip").innerHTML = "Your name must only contain word and space characters.";
                break;
            case "uname":
                document.getElementById("uTip").style.visibility = "visible";
                document.getElementById("uTip").style.fontSize = "10pt";
                document.getElementById("uTip").innerHTML = "Your username must only contain word characters and numbers.";
                break;
        }
    }
    else if (event.type == "mouseout") {
        document.getElementById("nameTip").style.visibility = "hidden";
        document.getElementById("nameTip").innerHTML = "";

        document.getElementById("uTip").style.visibility = "hidden";
        document.getElementById("uTip").innerHTML = "";
    }

}


//toggle submit button color
function change_one() {
    this.style.backgroundColor = "#008000";
}

function change_two() {
	this.style.backgroundColor = "#222D49";

}