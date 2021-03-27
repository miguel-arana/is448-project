<?php
session_start();

if (!$_SESSION['loggedIn']) {
    mysqli_close($db); // Closing Connection
    header('Location: login.php'); // Redirecting To Home Page
} else {
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
    if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");

    $name_query = "SELECT first_name, last_name FROM account WHERE email_address = '{$_SESSION['email']}' and password = '{$_SESSION['pass']}'";
    $name_result = mysqli_query($db, $name_query);
    $row_array_name = mysqli_fetch_array($name_result);

    $_SESSION['firstname'] = $row_array_name[0];
    $_SESSION['lastname'] = $row_array_name[1];
}
?>

<!-- Author: Miguel Arana -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Home </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" title="style" />
</head>

<body>
    <div class="sidebar">
        <img class="logo" src="images/logo.png" alt="todo app logo" />
        <a class="active"><img class="icon" src="images/home.png" alt="home icon" /> Home</a>
        <a href="workout.php"><img class="icon" src="images/dumbbell.png" alt="dumbbell icon" /> Workout</a>
        <a href="groceryshopping.php"><img class="icon" src="images/grocery.png" alt="grocery shopping logo" /> Grocery Shopping</a>
        <a href="classSchedule.php"><img class="icon" src="images/tick-mark.png" alt="class schedule icon" /> Class Schedule</a>
        <a href="general.php"><img class="icon" src="images/gear.png" alt="security logo" /> Settings</a>
        <a href='logout.php'>Logout</a>

    </div>

    <div class="content">
        <h2>Welcome, <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?>!</h2>
        <h3>To get started, pick one of the modules from the Todo App!</h3>
    </div>

</body>

</html>