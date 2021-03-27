<?php
session_start();

if (isset($_SESSION['loggedIn'])) {
	if ($_SESSION['loggedIn'])
		header('Location: homepage.php'); // Redirecting To Home Page
} else {
	$_SESSION['loggedIn'] = false;
}
?>

<!-- Author: Mehar Malik -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Log In Page</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="login.js"></script>
</head>

<body>
	<div class="blueBox">
		<img class="logo" src="images/logo.png" alt="todo app logo" />
		<h1>Welcome Back</h1>

		<!-- redirect to homepage for now -->
		<!-- <form name="logIn" id="logIn" method="POST" action="login.php"> -->
		<form name="logIn" method="POST" action="validate.php">
			<p class="leftAlign">
				Email Address <br />
				<input type="text" name="email" id="email" /> <br />
			</p>

			<p class="leftAlign">Password <br />
				<input type="password" name="password" id="password" /> <br />
			</p>

			<p class="leftAlign"> <?php if(isset($_GET['msg']))
							echo $_GET['msg']; ?>
			</p>

			<p class="centerAlign"> <br />
				<input type="submit" id="homeLogin" name="login" value="Log In">
			</p>

			<p class="centerAlign">
				<a href="registration.php">Need to create an account?</a>
			</p>
		</form>

	</div>

</body>

</html>