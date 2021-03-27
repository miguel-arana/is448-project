"use strict";
window.onload = pageLoad;
function pageLoad() {
	document.getElementById("homeLogin").onclick = validate;
	document.getElementById("email").onchange = resetBorder;
	document.getElementById("password").onchange = resetBorder;




}

function validate() {
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;


	if (email == "") {
		alert("Email is empty. Go back and re-enter.");
		var newText1 = document.getElementById("email");
		newText1.style.border = "2px solid red";
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

	if (password == "") {
		alert("Password is empty. Go back and re-enter.");
		var newText5 = document.getElementById("password");
		newText5.style.border = "2px solid red";
		return false;
	}


}

function resetBorder(){
	this.style.border = "2px solid lightblue";
}

