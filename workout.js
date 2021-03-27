"use strict";
window.onload = pageLoad;

function pageLoad() {
    document.getElementById("workoutForm").onclick = validWorkout;
    document.getElementById("removeForm").onclick = validRemove;
	document.getElementById("completeForm").onclick = validComplete;
	document.getElementById("removeCompleteForm").onclick = validRemoval;

    document.getElementById("workoutForm").onmouseover = change_one;
	document.getElementById("removeForm").onmouseover = change_three;
	document.getElementById("completeForm").onmouseover = change_one;
    document.getElementById("removeCompleteForm").onmouseover = change_three;
    
    document.getElementById("workoutForm").onmouseout = change_two;
	document.getElementById("removeForm").onmouseout = change_two;
	document.getElementById("completeForm").onmouseout = change_two;
	document.getElementById("removeCompleteForm").onmouseout = change_two;


}

function validWorkout() {
	var workout = document.getElementById("workouts").value;
	var sets =  document.getElementById("sets").value;
	var reps =  document.getElementById("reps").value;

    //check empty field
    if (workout == "") {
        alert("Please fill out the Workout.");
        return false;
	}
	if (sets == "") {
        alert("Please fill out the Sets.");
        return false;
	}
	if (reps == "") {
        alert("Please fill out the Repetitions.");
        return false;
    }

    var workout_pattern = /^[A-z\s]+$/;
	var workout_result = workout_pattern.test(workout);
	
	var sets_pattern = /^\d+$/;
	var sets_result = sets_pattern.test(sets);
	
	var reps_pattern = /^\d+$/;
    var reps_result = reps_pattern.test(reps);


    if (!workout_result) {
        alert("Workout is not in the correct format. Example of accepted format is 'Pushups' or 'bench press'.\nPlease go back re-enter workout.");
        document.getElementById("workouts").select();
        return false;
	}
	
	if (!sets_result) {
        alert("Sets are not in the correct format. Example of accepted format is '5' or '30'.\nPlease go back re-enter sets.");
        document.getElementById("email").select();
        return false;
	}
	
	if (!reps_result) {
        alert("Repetitions are not in the correct format. Example of accepted format is '5' or '30'.\nPlease go back re-enter reps.");
        document.getElementById("email").select();
        return false;
    }

    else {
        alert("Success!\n You have added the following workout: " + workout + ", " + sets + " sets," + " " + reps + " repetitions.");
        return true;
    }

}

function validRemove() {
    var workoutID = document.getElementById("workout_ids").value;
   
	if (workoutID == "") {
        alert("Workout ID must be filled out.");
        document.getElementById("workout_ids").select();
        return false;
	}

	var workouts_pattern = /^\d+$/;
	var workouts_result = workouts_pattern.test(workoutID);
	
	if (!workouts_result) {
        alert("Workout ID is not in the correct format. Example of accepted format is '5' or '3'.\n Note; Try copying one of the workout IDs you see displayed on the page.\nPlease go back re-enter sets.");
        document.getElementById("workout_ids").select();
        return false;
	}

    else {
        alert("Success!\nWorkout has been removed");
        return true;
    }
}

function validComplete() {
    var workID = document.getElementById("workout_ID").value;
    
    if (workID == "") {
        alert("Workout ID must be filled out.");
        document.getElementById("workout_ID").select();
        return false;
	}
	
	var work_pattern = /^\d+$/;
	var work_result = work_pattern.test(workID);
	
	if (!work_result) {
        alert("Workout ID is not in the correct format. Example of accepted format is '5' or '3'.\n Note; Try copying one of the workout IDs you see displayed on the page.\nPlease go back re-enter sets.");
        document.getElementById("workout_ID").select();
        return false;
	}
    
    else {
        alert("Success!\nWorkout has been marked completed");
        return true;
    }
}

function validRemoval() {
    var workoutID = document.getElementById("workouts_id").value;
    
    if (workoutID == "") {
        alert("Workout ID must be filled out.");
        document.getElementById("workouts_id").select();
        return false;
	}
	
	var workoutpattern = /^\d+$/;
	var workoutresult = workoutpattern.test(workoutID);
	
	if (!workoutresult) {
        alert("Workout ID is not in the correct format. Example of accepted format is '5' or '3'.\n Note; Try copying one of the workout IDs you see displayed on the page.\nPlease go back re-enter sets.");
        document.getElementById("workouts_id").select();
        return false;
	}

    else {
        alert("Success!\nWorkout has been removed");
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

