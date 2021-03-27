"use strict";
window.onload = pageLoad;
function pageLoad() {
	document.getElementById("homeLogin").onclick = validate;
	document.getElementById("firstName").onchange = resetBorder;
	document.getElementById("lastName").onchange = resetBorder;
	document.getElementById("username").onchange = resetBorder;
	document.getElementById("email").onchange = resetBorder;
	document.getElementById("pass").onchange = resetBorder;
	document.getElementById("confirmPass").onchange = resetBorder;
}

function validate() {
	var fName = document.getElementById("firstName").value;
	var lName = document.getElementById("lastName").value;
	var username = document.getElementById("username").value;
	var email = document.getElementById("email").value;
	var pass = document.getElementById("pass").value;
	var confirmPass = document.getElementById("confirmPass").value;



	if (fName == "") {
		alert("First name is empty. Go back and re-enter.");
		var newText1 = document.getElementById("firstName");
		newText1.style.border = "2px solid red";


		return false;
	}


	if (lName == "") {
		alert("Last name is empty. Go back and re-enter.");

		var newText2 = document.getElementById("lastName");
		newText2.style.border = "2px solid red";


		return false;
	}


	if (username == "") {
		alert("Username is empty. Go back and re-enter.");

		var newText3 = document.getElementById("username");
		newText3.style.border = "2px solid red";


		return false;
	}

	if (email == "") {
		alert("Email is empty. Go back and re-enter.");


		var newText4 = document.getElementById("email");
		newText4.style.border = "2px solid red";
		return false;
	}

	var pattern = /^\w+@[a-z]+\.[a-z]+$/;
	var result = pattern.test(email);
	if (result == false) {

		alert("Email is in the incorrect format. Go back and re-enter.");

		var newText = document.getElementById("email");
		newText.style.border = "2px solid red";
		return false;
	}


	if (pass == "") {
		alert("Password is empty. Go back and re-enter.");


		var newText5 = document.getElementById("password");
		newText5.style.border = "2px solid red";
		return false;
	}

	if (confirmPass == "") {
		alert("Confirm Password is empty. Go back and re-enter.");


		var newText6 = document.getElementById("confirmPass");
		newText6.style.border = "2px solid red";
		return false;
	}

	if (pass !== confirmPass) {
		alert("Passwords do not match.");
		var newText6 = document.getElementById("confirmPass");
		newText6.style.border = "2px solid red";
		return false;

	}


}
function resetBorder() {
	this.style.border = "2px solid lightblue";
}
