<?php
session_start();
if (!$_SESSION['loggedIn']) {
	mysqli_close($db); // Closing Connection
	header('Location: login.php'); // Redirecting To Home Page
} else {
	$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
	if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");

	$id_query = "SELECT account_id
                   FROM account 
                   WHERE email_address = '{$_SESSION['email']}' 
                   and password = '{$_SESSION['pass']}'";

	$id_query_result = mysqli_query($db, $id_query);
	$row_array = mysqli_fetch_array($id_query_result);
	$_SESSION['accountId'] = $row_array[0];
	// echo $_SESSION['accountId'];
}
?>

<!-- Author: Peter Bwewusa -->

<!DOCTYPE html>
<html lang="EN">

<head>
	<title>Workouts and Exercises</title>
	<link rel="stylesheet" type="text/css" href="style.css" title="styles">
</head>

<body>
	<script type="text/javascript" src="workout.js"></script>

	<div class="sidebar">
		<img class="logo" src="images/logo.png" alt="todo app logo" />
		<a href="homepage.php"><img class="icon" src="images/home.png" alt="home icon" /> Home</a>
		<a class="active" href="workout.php"><img class="icon" src="images/dumbbell.png" alt="dumbbell icon" /> Workout</a>
		<a href="groceryshopping.php"><img class="icon" src="images/grocery.png" alt="grocery shopping logo" /> Grocery Shopping</a>
		<a href="classSchedule.php"><img class="icon" src="images/tick-mark.png" alt="class schedule icon" /> Class Schedule</a>
		<a href="general.php"><img class="icon" src="images/gear.png" alt="security logo" /> Settings</a>
		<a href='logout.php'>Logout</a>;
	</div>

	<div class="content">
		<h2>Workouts and Exercises</h2>
		<h3>Enter Workouts for <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?> </h3>


		<form method="POST" action="workout.php">
			Workout&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Enter workout name" id="workouts" name="workout"><br />
			Sets&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Enter number of sets" id="sets" name="sets"><br />
			Reps&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Enter number of reps" id="reps" name="repetitions" ><br />

			<?php
			// Adding new workout to the table (Today's Routine)
			if (!empty($_POST['workoutForm'])) {
				if ((isset($_POST['workout'])  && !empty($_POST['workout'])) &&
					(isset($_POST['sets'])  && !empty($_POST['sets'])) &&
					(isset($_POST['repetitions'])  && !empty($_POST['repetitions']))
				) {
					$workout = htmlspecialchars($_POST['workout']);
					$sets = htmlspecialchars($_POST['sets']);
					$repetitions = htmlspecialchars($_POST['repetitions']);

					$workout = mysqli_real_escape_string($db, $workout);
					$sets = mysqli_real_escape_string($db, $sets);
					$repetitions = mysqli_real_escape_string($db, $repetitions);

					if (preg_match("/^[A-z\s]+$/", $workout) && preg_match("/^\d+$/", $sets) && preg_match("/^\d+$/", $repetitions)) {

						//query requires a foreign key which has to be specified
						$insert_query = "INSERT INTO workouts (account_id, workout_name, num_sets, num_reps, completed) VALUES ('{$_SESSION['accountId']}', '$workout', '$sets', '$repetitions', 0)";
						$insert_result = mysqli_query($db, $insert_query);
						header("Refresh: 0");
					} else {
						echo "Please correct input. Workouts should only have words and spaces. Sets and reps should only have integers. <br /> <br />";
					}
				} else {
					echo "Please fill in all fields. <br /> <br />";
				}
			}
			?>
			
			<input type="submit" value="Add Workout" id = "workoutForm" name="workoutForm">

		</form>


		<br /> <br />
		<div class="one">
			<h3>Today's Routine</h3>

			<?php
			//Fill in the workouts in Today's Routine
			// while loop to print all workouts
			$workout_query = "SELECT workout_name, num_sets, num_reps, workout_id FROM workouts WHERE account_id = '{$_SESSION['accountId']}' and completed = 0"; // change to where account_id = users current account_id to monitor session
			$resultworkout = mysqli_query($db, $workout_query);
			while ($first_workout_array = mysqli_fetch_array($resultworkout)) {
				print("Workout ID: " . " " . $first_workout_array['workout_id'] . ", " . $first_workout_array['workout_name'] . ", " . $first_workout_array['num_sets'] . " sets, " . $first_workout_array['num_reps'] . " reps. <br />");
			}
			?>


			<br /><br /><br />

			<!-- here is where I attempt to do deletion. from Today's Routine/Additions into Completed Workouts -->
			<form method="POST" action="workout.php">
				Remove Workout &nbsp;&nbsp;&nbsp;<input type="text" placeholder="Enter workout ID" id="workout_ids" name="removeID"><br />

				<?php
				// Delete Query
				if (!empty($_POST['removeForm'])) {
					if ((isset($_POST['removeID'])  && !empty($_POST['removeID']))) {
						$id = htmlspecialchars($_POST['removeID']);

						if (preg_match("/^\d+$/", $id)) {

							$delete_query = "DELETE FROM workouts WHERE workout_id = '$id' and account_id = '{$_SESSION['accountId']}'";
							$delete_result = mysqli_query($db, $delete_query);
							header("Refresh: 0");
						} else {
							echo "Please only enter integers. <br /> <br />";
						}
					} else {
						echo "Please enter the workout ID. <br /> <br />";
					}
				}
				?>
				<input type="submit" value="Remove Workout" id ="removeForm" name="removeForm">
				
			</form>




			<br /><br />

			<form method="POST" action="workout.php">
				Mark Workout Completed&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Enter workout ID" id="workout_ID" name="completeID"><br />

				<?php
				// Workouts Completed Query
				if (!empty($_POST['completeForm'])) {
					if ((isset($_POST['completeID'])  && !empty($_POST['completeID']))) {
						$id = htmlspecialchars($_POST['completeID']);
						$id = mysqli_real_escape_string($db, $id);


						if (preg_match("/^\d+$/", $id)) {
							$complete_query = "UPDATE workouts SET completed = 1 WHERE workout_id = '$id' and account_id = '{$_SESSION['accountId']}'";
							$complete_result = mysqli_query($db, $complete_query);
							header("Refresh: 0");
						} else {
							echo "Only integers are accepted. Please try again. <br /> <br />";
						}
					} else {
						echo "Please enter workout ID. <br /> <br />";
					}
				}
				?>
				<input type="submit" value="Complete Workout" id ="completeForm" name="completeForm">
			</form>






		</div>


		<div class="two">
			<h3>Completed</h3>

			<?php
			//Fill in the workouts in Completed Workouts
			// while loop to print all workouts
			$true = 1;
			$finished_query = "SELECT workout_name, num_sets, num_reps, workout_id FROM workouts WHERE completed = 1 and account_id = '{$_SESSION['accountId']}'"; // change to where account_id = users current account_id to monitor session
			$doneworkout = mysqli_query($db, $finished_query);
			while ($second_workout_array = mysqli_fetch_array($doneworkout)) {
				print("Workout ID: " . " " . $second_workout_array['workout_id'] . ", " . $second_workout_array['workout_name'] . ", " . $second_workout_array['num_sets'] . " sets, " . $second_workout_array['num_reps'] . " reps. <br />");
			}
			?>

			<br /><br /><br />

			<!-- here is where I attempt to do deletion. from Today's Routine/Additions into Completed Workouts -->
			<form method="POST" action="workout.php">
				Remove Completed Workout (Enter Workout ID)&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Enter workout ID" id="workouts_id" name="ID"><br />
				<?php
				// Delete Query
				if (!empty($_POST['removeCompleteForm'])) {
					if ((isset($_POST['ID'])  && !empty($_POST['ID']))) {
						$id = htmlspecialchars($_POST['ID']);
						$id = mysqli_real_escape_string($db, $id);

						if (preg_match("/^\d+$/", $id)) {
							$delete_query = "DELETE FROM workouts WHERE workout_id = '$id' and completed = 1 and account_id = '{$_SESSION['accountId']}'";
							$delete_result = mysqli_query($db, $delete_query);
							header("Refresh: 0");
						} else {
							echo "Only integers are accepted. Please try again. <br /> <br />";
						}
					} else {
						echo "Please enter workout ID. <br /> <br />";
					}
				}
				?>
				<input type="submit" value="Remove Workout" id="removeCompleteForm" name="removeCompleteForm">
			</form>


		</div>


	</div>

</body>

</html>