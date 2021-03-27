<?php

if(isset($_POST['submit'])) {

		$db = mysqli_connect("studentdb-maria.gl.umbc.edu","marana1","marana1","marana1");

		if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");

		$fName = htmlspecialchars($_POST['firstName']);
		$lName = htmlspecialchars($_POST['lastName']);
		$username = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$pass = htmlspecialchars($_POST['password']);
		$confirm = htmlspecialchars($_POST['confirmPass']);

		$fName = mysqli_real_escape_string($db,$_POST['firstName']);
		$lName = mysqli_real_escape_string($db,$_POST['lastName']);
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$pass = mysqli_real_escape_string($db,$_POST['password']);
		$confirm = mysqli_real_escape_string($db,$_POST['confirmPass']);

		if (empty($fName) || empty($lName) || empty($username) || empty($email) || empty($pass) || empty($confirm)) {
			$msg = "Please fill in all fields.";
			header("Location:registration.php?msg=$msg");
			exit();
		}

		else {

			if (preg_match("/^\w+@[a-z]+\.[a-z]+$/", $email)) {

			if ($pass == $confirm) {

			$constructed_query = "INSERT INTO account (first_name, last_name, user_name, password, email_address) VALUES ('$fName', '$lName', '$username', '$pass', '$email')";

			$result = mysqli_query($db, $constructed_query);

			if(! $result){
			print("Error - query could not be executed");
			$error = mysqli_error($db);
			print "<p> . $error . </p>";
			exit;
			}

			else {
				$msg1 = "Account Created!";
			header("Location:registration.php?msg1=$msg1");
			}

		}

		else {
			$msg = "Passwords do not match.";
			header("Location:registration.php?msg=$msg");
		}
	}

		else{
			$msg = "Please make sure email is in the correct format.";
			header("Location:registration.php?msg=$msg");
		}




	}
}

	else {
		header("location: registration.php");
	}

?>


<!-- Author: Mehar Malik -->
