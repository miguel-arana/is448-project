<?php
session_start();
if (!$_SESSION['loggedIn']) {
	mysqli_close($db); // Closing Connection
	header('Location: login.php'); // Redirecting To Home Page
} else {
	$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
	if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");
}
?>
<!DOCTYPE html>
<html>

<!-- Author: Stephen Otto -->

<head>
	<title>Grocery Shopping List</title>
	<link rel="stylesheet" type="text/css" href="style.css" title="styles">
	<script type="text/javascript"  src="groceryValidate.js" ></script>
</head>


<body>


	<div class="sidebar">
		<img class="logo" src="images/logo.png" alt="todo app logo" />
		<a href="homepage.php"><img class="icon" src="images/home.png" alt="home icon" /> Home</a>
		<a href="workout.php"><img class="icon" src="images/dumbbell.png" alt="dumbbell icon" /> Workout</a>
		<a class="active" href="groceryshopping.php"><img class="icon" src="images/grocery.png" alt="grocery shopping logo" /> Grocery Shopping</a>
		<a href="classSchedule.php"><img class="icon" src="images/tick-mark.png" alt="class schedule icon" /> Class Schedule</a>
		<a href="general.php"><img class="icon" src="images/gear.png" alt="security logo" /> Settings</a>
		<a href='logout.php'>Logout</a>
	</div>


	<div class="content">
		<h2>Grocery List</h2>


		<h3>Enter Item</h3>
		<form action="groceryshopping.php" method="post">
			<input type="text" id="item" name="item" placeholder="Enter item name" >
			<input type="submit" id = "addItem" value=" Add Item" name="addItem"><br />
			<?php
			if (!empty($_POST['addItem'])) {
				if ((isset($_POST['item']) && (!empty($_POST['item'])))) {
					$item_name = htmlspecialchars($_POST['item']);
					$item_name = mysqli_real_escape_string($db, $item_name);

					if (preg_match("/^[A-z]+$/", $item_name)) {
						$constructed_query = "INSERT INTO grocery (account_id, item_name) VALUES ('{$_SESSION['accountId']}','$item_name')";
						$result = mysqli_query($db, $constructed_query);

						if (!$result) {
							print("Error - query could not be executed");
							$error = mysqli_error($db);
							print "<p> . $error . </p>";
							exit;
						}
					} else {
						echo "Please enter letters only.";
					}
				} else {
					echo "Please enter an item.";
				}
			}
			?>

		</form>




		<form action="groceryshopping.php" method="post">
			<h3>Quick Add</h3>
			<input type="checkbox" id="item1" name="item1" value="Bread">
			<label for="item1">Bread</label><br>
			<input type="checkbox" id="item2" name="item2" value="Milk">
			<label for="item2">Milk</label><br>
			<input type="checkbox" id="item3" name="item3" value="Eggs">
			<label for="item3">Eggs</label><br><br>

			<input type="submit" value="Quick Add" id="quickAdd" name="quickAdd">
		</form>


		<?php
		// QUICK ADD

		if (!empty($_POST['quickAdd'])) {
			//BREAD
			if (!isset($_POST['item1']) && !isset($_POST['item2']) && !isset($_POST['item3'])) {
				echo "Please select an item to quick add.";
			} else {

				if ((isset($_POST['item1']))) {
					$constructed_query1 = "INSERT INTO grocery (account_id, item_name) VALUES 
			('{$_SESSION['accountId']}','Bread')";

					$result1 = mysqli_query($db, $constructed_query1);

					if (!$result1) {
						print("Error - query could not be executed");
						$error = mysqli_error($db);
						print "<p> . $error . </p>";
						exit;
					}
				}

				//MILK
				if ((isset($_POST['item2']))) {
					$constructed_query2 = "INSERT INTO grocery (account_id, item_name) VALUES 
			('{$_SESSION['accountId']}','Milk')";

					$result2 = mysqli_query($db, $constructed_query2);

					if (!$result2) {
						print("Error - query could not be executed");
						$error = mysqli_error($db);
						print "<p> . $error . </p>";
						exit;
					}
				}


				//EGGS
				if ((isset($_POST['item3']))) {
					$constructed_query3 = "INSERT INTO grocery (account_id, item_name) VALUES 
			('{$_SESSION['accountId']}','Eggs')";

					$result3 = mysqli_query($db, $constructed_query3);

					if (!$result3) {
						print("Error - query could not be executed");
						$error = mysqli_error($db);
						print "<p> . $error . </p>";
						exit;
					}
				}
			}
		}

		?>

		<!-- here is where I attempt to do deletion. -->
		<h3>Remove Item</h3>
		<form method="POST" action="groceryshopping.php">
			<input type="text" id="itemRemove" placeholder="Enter item name" name="itemRemove">
			<input type="submit" value=" Remove" id = "removeItem" name="removeItem"><br />

			<?php
			// Delete Query
			if (!empty($_POST['removeItem'])) {
				if (isset($_POST['itemRemove']) && (!empty($_POST['itemRemove']))) {
					$itemRemove = htmlspecialchars($_POST['itemRemove']);
					$itemRemove = mysqli_real_escape_string($db, $_POST['itemRemove']);

					$delete_query = "DELETE FROM grocery WHERE item_name = '$itemRemove' and account_id = '{$_SESSION['accountId']}'";
					$delete_result = mysqli_query($db, $delete_query);
					header("Refresh: 0");
				} else {
				}
			}


			$print_query = "SELECT item_name FROM grocery WHERE account_id = '{$_SESSION['accountId']}'";
			$print_result = mysqli_query($db, $print_query);
			$num_rows = mysqli_num_rows($print_result);

			//Printing from the Database
			if ($print_result->num_rows > 0) {
				print "<ul>";
				while ($row = $print_result->fetch_assoc()) {

					print "<li>" . $row["item_name"] . "</li>";
				}
				print "</ul>";
			} else {
				print "No information available";
				print "<br/>";
			}

			?>
		</form>

	</div>
</body>


</html>