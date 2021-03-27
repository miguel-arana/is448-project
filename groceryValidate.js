"use strict";

window.onload=pageLoad;
function pageLoad(){
    document.getElementById("addItem").onclick=validate;
	document.getElementById("removeItem").onclick=validateRemove;

	document.getElementById("addItem").onmouseover = change_one;
	document.getElementById("quickAdd").onmouseover = change_one;
	document.getElementById("removeItem").onmouseover = change_three;
	
    
    document.getElementById("addItem").onmouseout = change_two;
	document.getElementById("quickAdd").onmouseout = change_two;
	document.getElementById("removeItem").onmouseout = change_two;
}

function validate(){
	
	//Checks Item
		var userItem = document.getElementById("item").value;

		if(userItem == ""){
			alert("Item name is empty, Re-enter");
			document.getElementById("item").select();
			return false;
		}
		var patternItem = /^[A-z\s]+$/;
		var resultItem = patternItem.test(userItem);

		if(resultItem == false){
			alert("Please enter only letters for item name");
			document.getElementById("item").select();
			return false;
		}
		else{
			return true;
		}
	
}

function validateRemove(){
	
	//Checks Item
		var userItem = document.getElementById("itemRemove").value;

		if(userItem == ""){
			alert("Item name is empty, Re-enter");
			document.getElementById("itemRemove").select();
			return false;
		}
		var patternItem = /^[A-z\s]+$/;
		var resultItem = patternItem.test(userItem);

		if(resultItem == false){
			alert("Please enter only letters for item name");
			document.getElementById("itemRemove").select();
			return false;
		}
		else{
			return true;
		}
	
}

//toggle submit button color
function change_one() {
    this.style.backgroundColor = "#008000";
}

function change_two() {
	this.style.backgroundColor = "#222D49";

}

function change_three() {
	this.style.backgroundColor = "#B22222";

}

