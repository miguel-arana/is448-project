"use strict";
window.onload = pageLoad;

function pageLoad() {
    document.getElementById("emailSubmit").onclick = checkEmail;
    document.getElementById("passwordSubmit").onclick = checkPassword;
    document.getElementById("seePassword").onchange = seePassword;

    document.getElementById("email").onmouseover = showTip;
    document.getElementById("email").onmouseout = showTip;

    document.getElementById("emailSubmit").onmouseover = change_one;
    document.getElementById("passwordSubmit").onmouseover = change_one;
    document.getElementById("emailSubmit").onmouseout = change_two;
    document.getElementById("passwordSubmit").onmouseout = change_two;
}

function checkEmail() {
    //email
    var email = document.getElementById("email").value;

    //check empty username field
    if (email == "") {
        alert("Please fill out the email.");
        return false;
    }

    var email_pattern = /^\w+@[a-z]+\.[a-z]+$/;
    var email_result = email_pattern.test(email);


    if (!email_result) {
        alert("Email is not in the correct format. Example of accepted format is abc_def@gmail.com or abc123@verizon.net.\nPlease go back re-enter email.");
        document.getElementById("email").select();
        return false;
    }

    else {
        alert("Success!\nEmail has been set to: " + email);
        return true;
    }

}

function checkPassword() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confpass").value;

    // var username_pattern = /^[A-z0-9]+$/;
    // var username_result = username_pattern.test(username);

    if (password == "") {
        alert("Password must be filled out.");
        document.getElementById("password").select();
        return false;
    }

    if (confirm_password == "") {
        alert("Password must be filled out.");
        document.getElementById("confpass").select();
        return false;
    }

    if (password !== confirm_password) {
        alert("Passwords do not match. \nPlease re-enter confirmation password.");
        document.getElementById("confpass").select();
        return false;
    }

    else {
        alert("Success!\nPassword has been changed!");
        return true;
    }
}

//toggle password visibility
function seePassword() {
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confpass"); //confirmation password

    if (password.type === "password") {
        password.type = "text";
        confirm_password.type = "text";
    }

    else {
        password.type = "password";
        confirm_password.type = "password";
    }



}

function showTip() {

    if ((event.type == "mouseover")) {
        switch (event.target.id) {
            case "email":
                document.getElementById("emailTip").style.visibility = "visible";
                document.getElementById("emailTip").style.fontSize = "10pt";
                document.getElementById("emailTip").innerHTML = "Your email address must have the form: user@domain";
                break;
        }
    }
    else if (event.type == "mouseout") {
        document.getElementById("emailTip").style.visibility = "hidden";
        document.getElementById("emailTip").innerHTML = "";
    }

}

//toggle submit button color
function change_one() {
    this.style.backgroundColor = "#008000";
}

function change_two() {
	this.style.backgroundColor = "#222D49";

}