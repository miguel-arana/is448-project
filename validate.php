<?php

if (isset($_POST['login'])) {

	$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");

	if (mysqli_connect_errno())	exit("Error - could not connect to MySQL");

	$email = htmlspecialchars($_POST['email']);
	$pass = htmlspecialchars($_POST['password']);

	$email = mysqli_real_escape_string($db, $_POST['email']);
	$pass = mysqli_real_escape_string($db, $_POST['password']);




	if (empty($email) || empty($pass)) {
		$msg = "Please fill in all fields.";
			header("Location:login.php?msg=$msg");
		exit();
	} else {
		$constructed_query = "SELECT * FROM account WHERE email_address='$email' and password='$pass'";
		$id_query = "SELECT account_id
                   FROM account 
                   WHERE email_address = '$email' 
                   and password = '$pass'";


		$result = mysqli_query($db, $constructed_query);

		if (mysqli_num_rows($result) > 0) {
			session_start();
			$_SESSION['email'] = $email;
			$_SESSION['pass'] = $pass;
			$_SESSION['loggedIn'] = true;

			$id_query_result = mysqli_query($db, $id_query);
			$row_array = mysqli_fetch_array($id_query_result);
			$_SESSION['accountId'] = $row_array[0];
			header("location: homepage.php");
		} else {
			$msg = "The username or password is incorrect!";
			header("Location:login.php?msg=$msg");
			
		}
	}
} else {
	header("location: login.php");
}
?>
<!-- Author: Mehar Malik -->