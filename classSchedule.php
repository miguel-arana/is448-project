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

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="style.css" rel="stylesheet" />
	<title>Class Schedule</title>
	<script src="classSchedule.js" type="text/javascript"> </script>
</head>

<body>
	

	<div class="sidebar">
		<img class="logo" src="images/logo.png" alt="todo app logo" />
		<a href="homepage.php"><img class="icon" src="images/home.png" alt="home icon" /> Home</a>
		<a href="workout.php"><img class="icon" src="images/dumbbell.png" alt="dumbbell icon" /> Workout</a>
		<a href="groceryshopping.php"><img class="icon" src="images/grocery.png" alt="grocery shopping logo" /> Grocery
			Shopping</a>
		<a class="active" href="classSchedule.php"><img class="icon" src="images/tick-mark.png" alt="class schedule icon" /> Class Schedule</a>
		<a href="general.php"><img class="icon" src="images/gear.png" alt="security logo" /> Settings</a>
		<a href='logout.php'>Logout</a>
	</div>

	<div class="content">
		<h2>Class Schedule</h2>

		<div class="inputSide">
			<h3>Class Details</h3>
			<p>
				<form name="addClass" action="classSchedule.php" method="post">
					<strong>Enter Class Name:</strong>
					<br>
					<input type="text" name="class_name" id="class_name" />
					<span id="classTip" style="visibility: hidden;"></span>
					<br>
					<br>
					<strong>Enter Days of Class (e.g. M-Monday, Tu-Tuesday):</strong>
					<br>
					<input type="checkbox" name="mon" id="mon" />
					<label for="mon">M</label>
					<input type="checkbox" name="tue" id="tue" />
					<label for="tue">Tu</label>
					<input type="checkbox" name="wed" id="wed" />
					<label for="wed">W</label>
					<input type="checkbox" name="thu" id="thu" />
					<label for="thu">Th</label>
					<input type="checkbox" name="fri" id="fri" />
					<label for="fri">F</label>
					<br>
					<br>
					<strong>Enter Start Time of Class (e.g. 3:00PM):</strong>
					<br>
					<input type="text" name="start_time" id="start_time" />
					<span id="startTimeTip" style="visibility: hidden;"></span>
					<br>
					<br>
					<strong>Enter End Time of Class (e.g. 4:15PM):</strong>
					<br>
					<input type="text" name="end_time" id="end_time" />
					<span id="endTimeTip" style="visibility: hidden;"></span>
					<br>
					<br>

					<input type="submit" name="submitClass" id="submitClass" />
				</form>
					<?php
					if (!empty($_POST['submitClass'])) {
						$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
						$className = $_POST['class_name'];
						$className = htmlspecialchars($_POST['class_name']); //strip html
						$className = mysqli_real_escape_string($db, $className); //prevent sql injection
						$classDays = "";
						if (isset($_POST['fri'])) {
							$classDays = "F $classDays";
						}
						if (isset($_POST['thu'])) {
							$classDays = "Th $classDays";
						}
						if (isset($_POST['wed'])) {
							$classDays = "W $classDays";
						}
						if (isset($_POST['tue'])) {
							$classDays = "Tu $classDays";
						}
						if (isset($_POST['mon'])) {
							$classDays = "M $classDays";
						}
						$startTime = $_POST['start_time'];
						$startTime = htmlspecialchars($_POST['start_time']); //strip html
						$startTime = mysqli_real_escape_string($db, $startTime); //prevent sql injection
						$endTime = $_POST['end_time'];
						$endTime = htmlspecialchars($_POST['end_time']); //strip html
						$endTime = mysqli_real_escape_string($db, $endTime); //prevent sql injection

						$db2 = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
						if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");
						$constructed_query2 = "INSERT INTO class (account_id, class_name, class_start, class_end, class_days) VALUES ('{$_SESSION['accountId']}','$className','$startTime','$endTime','$classDays')";
						$result2 = mysqli_query($db2, $constructed_query2);
						if (!$result2) {
							echo "Error ", $constructed_query2, "<br>", mysqli_error($db2);
						}
						// header("Refresh: 0");
					} 

					?>
				<p>
		</div>

		<div class="displaySide">
			<h3>Your Classes</h3>
			<?php
			$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
			if (mysqli_connect_errno())	exit("Failed to connect to MySQL");

			$constructed_query = "Select class_id, class_name, class_days, class_start, class_end from class where account_id = '{$_SESSION['accountId']}'";
			$result = mysqli_query($db, $constructed_query);

			if (!$result)	exit("Error - query could not be executed");
			print("<table>");
			print("<tr>");
			print("<th>
						Class ID</th>
						<th>Class Name</th>
						<th>Class Days</th>
						<th>Class Start Time</th>
						<th>Class End Time</th>");
			print("</tr>");
			$num_rows = mysqli_num_rows($result);
			if ($num_rows != 0) {
				while ($row_array = mysqli_fetch_array($result)) {
					print("<tr>");
					print("<td>
						$row_array[class_id]</td>
						<td>$row_array[class_name]</td>
						<td>$row_array[class_days]</td>
						<td>$row_array[class_start]</td>
						<td>$row_array[class_end]</td>");
					print("</tr>");
				}
			}
			print("</table>");
			?>
			<br>
			<form method="POST" action="classSchedule.php">
				<input type="text" name="class_ids" id="class_ids" placeholder="Enter class id" name="ID">
				<input type="submit" name="deleteClass" id="deleteClass" value="Remove Class">
			</form>
			<?php
			// Delete Query
			if (!empty($_POST['deleteClass'])) {
				if ((isset($_POST['ID'])  && !empty($_POST['ID']))) {
					$id = htmlspecialchars($_POST['ID']);
					$id = mysqli_real_escape_string($db, $_POST['ID']);

					$delete_query = "DELETE FROM class WHERE class_id = '$id' and account_id = '{$_SESSION['accountId']}'";
					$delete_result = mysqli_query($db, $delete_query);
					header("Refresh: 0");
				}
			}
			print("</div>");


			$dayOfWeek = date("l");
			if ($dayOfWeek == "Monday") {
				$today = "M";
			} else if ($dayOfWeek == "Tuesday") {
				$today = "Tu";
			} else if ($dayOfWeek == "Wednesday") {
				$today = "W";
			} else if ($dayOfWeek == "Thursday") {
				$today = "Th";
			} else if ($dayOfWeek == "Friday") {
				$today = "F";
			} else {
				$today = "Weekend";
			}

			?>
			<div class='classToday'>
				<h3>Today's Classes</h3>
				<form method='POST' action='classSchedule.php'>
					<table>
						<tr>
							<th>Class ID</th>
							<th>Class Name</th>
							<th>Time Of Class</th>
							<th>Attended</th>
						</tr>
						<?php
						ob_start();
						$db3 = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
						if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");

						$constructed_query3 = "Select class_id, class_name, class_start, class_id, class_attend from class where instr(class_days, '{$today}') and account_id = '{$_SESSION['accountId']}'";

						$result3 = mysqli_query($db3, $constructed_query3);
						if (!$result3) {
							echo "Error ", $constructed_query3, "<br>", mysqli_error($db3);
						}
						$num_rows3 = mysqli_num_rows($result3);
						$rowNum = 0;

						
						if ($num_rows3 != 0) {
							while ($row_array3 = mysqli_fetch_array($result3)) {
								if ($row_array3['class_attend'] == 0) {

									print("<tr>");
									print("<td>$row_array3[class_id]</td>");
									print("<td>$row_array3[class_name]</td>");
									print("<td>$row_array3[class_start]</td>");
									print("<td><input type='checkbox' name='$rowNum' value='$row_array3[class_id]'></td>");
									print("</tr>");
									$rowNum++;
								}
								
							}

							if (!empty($_POST['submitAttendance']) or !empty($_POST['updateClass'])) {
								$db4 = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
								if (mysqli_connect_errno()) exit("Error - could not connect to MySQL");

								$currentRow = 0;
								while ($currentRow <= $rowNum) {
									if (isset($_POST[$currentRow])) {
										$dateT = date('Y-m-d');
										$constructed_query4 = "Update class set attended= '$dateT', class_attend='1' where class_id=$_POST[$currentRow] and account_id = '{$_SESSION['accountId']}'";
										$result4 = mysqli_query($db4, $constructed_query4);
										if (!$result4) {
											echo "Error ", $constructed_query4, "<br>", mysqli_error($db4);
										}
										if ($currentRow + 1 <= $rowNum) {
											header("Refresh: 0");
										}
									}
									$currentRow++;
								}
							}
						}

						$db6 = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
						if (mysqli_connect_errno()) exit("Error - could not connect to MySQL");
						if (!empty($_POST['updateClass'])) {
							if ((isset($_POST['ID2'])  && !empty($_POST['ID2']))) {
								$id2 = htmlspecialchars($_POST['ID2']);
								$id2 = mysqli_real_escape_string($db6, $id2);
								$constructed_query6 = "Update class set class_attend = 0 where class_id = $id2 and account_id = '{$_SESSION['accountId']}'";
								$result6 = mysqli_query($db6, $constructed_query6);
								header("Refresh: 0");
								if (!$result6) {
									print "Error";
								}
							}
						}
						?>
					</table>
					<br />
					<input type='submit' id='submitAttendance' name='submitAttendance' value='Submit'>
				</form>
			</div>

			<div class='classAttended'>
				<h3>Classes Attended</h3>
				<table>
					<tr>
						<th>Class ID</th>
						<th>Class Name</th>
					</tr>
					<?php
					$db5 = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
					if (mysqli_connect_errno()) exit("Error - could not connect to MySQL");
					$currentDate = date('Y-m-d');
					$constructed_query5 = "Select class_id, class_name from class where attended = '$currentDate' and class_attend = 1 and class_attend = 1 and account_id = '{$_SESSION['accountId']}'";
					$result5 = mysqli_query($db5, $constructed_query5);

					if (!$result5) {
						echo "Error ", $constructed_query5, "<br>", mysqli_error($db5);
					}
					$num_rows5 = mysqli_num_rows($result5);
					if ($num_rows5 != 0) {
						while ($row_array5 = mysqli_fetch_array($result5)) {
							print("<tr>");
							print("<td>$row_array5[class_id]</td>");
							print("<td>$row_array5[class_name]</td>");
							print("</tr>");
						}
					}
					?>
				</table>
				<form method='POST' action='classSchedule.php'>
					<input type='text' id='class_ids2' placeholder="Enter class id" name='ID2'>
					<input type='submit' name='updateClass' id='updateClass' value='Remove Class'>
				</form>


			</div>

</body>

</html>