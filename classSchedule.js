"use strict";
window.onload=pageLoad;
function pageLoad()
{
	document.getElementById("submitClass").onclick = validate;
	document.getElementById("deleteClass").onclick = validateId;
	document.getElementById("updateClass").onclick = validateId2;

	document.getElementById("class_name").onmouseover = tip;
	document.getElementById("class_name").onmouseout = tip;

	document.getElementById("start_time").onmouseover = tip;
	document.getElementById("start_time").onmouseout = tip;

	document.getElementById("end_time").onmouseover = tip;
	document.getElementById("end_time").onmouseout = tip;

	document.getElementById("submitClass").onmouseover = change_one;
	document.getElementById("deleteClass").onmouseover = change_three;
	document.getElementById("submitAttendance").onmouseover = change_one;
    document.getElementById("updateClass").onmouseover = change_three;
    
    document.getElementById("submitClass").onmouseout = change_two;
	document.getElementById("deleteClass").onmouseout = change_two;
	document.getElementById("submitAttendance").onmouseout = change_two;
	document.getElementById("updateClass").onmouseout = change_two;

}

function validate()
{
	var class_name = document.getElementById("class_name").value;

	if(class_name == "")
	{
		alert("Class name field is empty. Please input a class name.");
        document.getElementById("class_name").select();
		return false;
	}
	var fri = document.getElementById('fri').checked;
	var thu = document.getElementById('thu').checked;
	var wed = document.getElementById('wed').checked;
	var tue = document.getElementById('tue').checked;
	var mon = document.getElementById('mon').checked;
	if(fri == false && thu == false && wed == false && tue == false && mon == false)
	{
		alert("No boxes checked for day of class. Please check at least one day of the week.");
		return false;
	}
	var start_time = document.getElementById("start_time").value;
	if(start_time == "")
	{
		alert("Start time of class field is empty. Please input a class start time.");
		document.getElementById("start_time").select();
		return false;
	}
	var end_time = document.getElementById("end_time").value;
	if(end_time == "")
	{
		alert("End time of class field is empty. Please input a class end time.");
		document.getElementById("end_time").select();
		return false;
	}

	var name_pattern = /^[\w\s]+$/;
	var nameMatch = name_pattern.test(class_name);
	if(nameMatch == false)
	{
		alert("Invalid class name. Only alphanumeric characters and spaces are allowed.");
		return false;
	}
	var time_pattern = /^[0-1]?[0-9]:[0-5][0-9][APap][Mm]$/;
	var startMatch = time_pattern.test(start_time);
	if(startMatch == false)
	{
		alert("Start Time format is incorrect. Example: 4:15PM.");
		document.getElementById("start_time").select();
		return false;
	}
	var endMatch = time_pattern.test(end_time);
	if(endMatch == false)
	{
		alert("End Time format is incorrect. Example: 4:15PM.");
		document.getElementById("end_time").select();
		return false;
	}
}

function validateId()
{
	var classIds = document.getElementById("class_ids").value;
	if(classIds == "")
	{
		alert("Enter a class id to remove. Refer to the first column for the class id.");
		document.getElementById("class_ids").select();
		return false;
	}

	var idPattern = /^[0-9]+$/;
	var idMatch = idPattern.test(classIds);
	if(idMatch == false)
	{
		alert("Class ID format is incorrect. Please enter a number that matches one of your classes listed.");
		document.getElementById("class_ids").select();

		return false;
	}
}

function validateId2()
{
	var classIds2 = document.getElementById("class_ids2").value;
	if(classIds2 == "")
	{
		alert("Enter a class id to remove. Refer to the first column for the class id.");
		document.getElementById("class_ids2").select();
		return false;
	}

	var idPattern2 = /^[0-9]+$/;
	var idMatch2 = idPattern2.test(classIds2);
	if(idMatch2 == false)
	{
		alert("Class ID format is incorrect. Please enter a number that matches one of your classes listed.");
		document.getElementById("class_ids2").select();
		return false;
	}
}


function tip()
{
	if((event.type == "mouseover"))
	{
		switch (event.target.id)
		{
			case "class_name":
				document.getElementById("classTip").style.visibility = "visible";
				document.getElementById("classTip").style.fontSize = "10pt";
				document.getElementById("classTip").innerHTML = "Class name should be only alphanumeric and space characters."
				break;
			case "start_time":
				document.getElementById("startTimeTip").style.visibility = "visible";
				document.getElementById("startTimeTip").style.fontSize = "10pt";
				document.getElementById("startTimeTip").innerHTML = "Start time should be in the same format as 4:15PM or 11:30AM."
				break;
			case "end_time":
				document.getElementById("endTimeTip").style.visibility = "visible";
				document.getElementById("endTimeTip").style.fontSize = "10pt";
				document.getElementById("endTimeTip").innerHTML = "Start time should be in the same format as 4:15PM or 11:30AM."
				break;
		}
	}
	else if (event.type == "mouseout")
	{
		document.getElementById("classTip").style.visibility = "hidden";
		document.getElementById("classTip").innerHTML = "";

		document.getElementById("startTimeTip").style.visibility = "hidden";
		document.getElementById("startTimeTip").innerHTML = "";

		document.getElementById("endTimeTip").style.visibility = "hidden";
		document.getElementById("endTimeTip").innerHTML = "";

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