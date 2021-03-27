<?php
session_start();
if (session_destroy()) // Destroying All Sessions
{
	header("Location: login.php"); // Redirecting To login Page
}
// // "You have logged out. <a href='login.php'>Login Again</a>";
?>

<!-- Author: Mehar Malik -->
