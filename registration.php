<!-- Author: Mehar Malik -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Registration Page</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="create.js"></script>

</head>

<body>

	<div class="blueBox">
		<img class="logo" src="images/logo.png" alt="todo app logo" />

		<h1>Create an Account</h1>

		<form name="createAcc" id="createAcc" method="POST" action="create.php">

			<p class="leftAlign">
				First Name
				<input type="text" name="firstName" id="firstName" /> 
				<br /><br />
				Last Name
				<input type="text" name="lastName" id="lastName" />
				<br />
			</p>

			<p class="leftAlign">Username <br />
				<input type="text" name="username" id="username" /> <br />
			</p>

			<p class="leftAlign">Email Address <br />
				<input type="text" name="email" id="email" /> <br />
			</p>

			<p class="leftAlign">
				Password <br />
				<input type="password" name="password" id="pass"/> <br />
			</p>

			<p class="leftAlign">Confirm Password <br />
				<input type="password" name="confirmPass" id="confirmPass" /> <br />
			</p>


			<p class="centerAlign"> <?php if(isset($_GET['msg']))
							echo $_GET['msg']; ?>
			</p> 

			<p class="centerAlign"> <?php if(isset($_GET['msg1']))
							echo $_GET['msg1']; ?>
			</p>

			<br />

			<p class="centerAlign">
				<input type="submit" id="homeLogin" name="submit" value="Create Account">
			</p>

			


		</form>

		<p class="centerAlign">
			<a href="login.php">Already have an account?</a>
		</p>
	</div>


</body>

</html>