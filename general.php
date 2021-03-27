<?php
session_start();
if (!$_SESSION['loggedIn']) {
    mysqli_close($db); // Closing Connection
    header('Location: login.php'); // Redirecting To Home Page
} else {

    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "marana1", "marana1", "marana1");
    if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");

    $username_query = "SELECT user_name, first_name, last_name 
                   FROM account 
                   WHERE email_address = '{$_SESSION['email']}' 
                   and password = '{$_SESSION['pass']}'";

    $username_query_result = mysqli_query($db, $username_query);
    $row_array = mysqli_fetch_array($username_query_result);
    $_SESSION['username'] = $row_array[0];
    $_SESSION['firstname'] = $row_array[1];
    $_SESSION['lastname'] = $row_array[2];
}
?>

<!-- Author: Miguel Arana -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title> General Settings </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" title="style" />
</head>

<body>
    <script type="text/javascript" src="general.js"></script>

    <div class="sidebar">
        <img class="logo" src="images/logo.png" alt="todo app logo" />
        <a href="homepage.php"><img class="icon" src="images/home.png" alt="home icon" /> Home</a>
        <a class="active" href="general.php"><img class="icon" src="images/gear.png" alt="cog wheel" /> General</a>
        <a href="security.php"><img class="icon" src="images/shield_w.png" alt="security logo" /> Security</a>
    </div>

    <div class="content">
        <h2>General Account Settings</h2>
        <div>
            <h3>Name</h3>
            <p class="formContent">Current Name: <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?></p>
            <form class="indent" method="POST" action="general.php">
                <label for="fname">First </label>
                <input type="text" id="fname" name="fname" value="<?php echo $_SESSION['firstname'] ?>">
                <span id="nameTip" style="visibility: hidden;"></span>
                <br />
                <label for="lname">Last </label>
                <input type="text" id="lname" name="lname" value="<?php echo $_SESSION['lastname'] ?>"><br />
                <br />

                <!-- first, last name PHP form handler starts here -->
                <?php
                if (!empty($_POST['nameSubmit'])) {
                    if (
                        isset($_POST['fname'])  && !empty($_POST['fname']) &&
                        isset($_POST['lname'])  && !empty($_POST['lname'])

                    ) {

                        $firstname = htmlspecialchars($_POST['fname']); //strip html
                        $lastname = htmlspecialchars($_POST['lname']);

                        $firstname = mysqli_real_escape_string($db, $firstname); //prevent sql injection
                        $lastname = mysqli_real_escape_string($db, $lastname);


                        if (preg_match("/^[A-z\s]+$/", $firstname) && preg_match("/^[A-z\s]+$/", $lastname)) {

                            $constructed_query = "UPDATE account
                                    SET first_name = '$firstname',
                                        last_name = '$lastname'
                                    WHERE
                                        email_address = '{$_SESSION['email']}' 
                                        and password = '{$_SESSION['pass']}'";

                            #Execute query to update first name and last name
                            $result = mysqli_query($db, $constructed_query);
                            header("Refresh: 0"); //refresh to display new username

                            #if result object is not returned, then print an error and exit the PHP program
                            if (!$result) {
                                print("Error - query could not be executed");
                                $error = mysqli_error($db);
                                print "<p> . $error . </p>";
                                exit;
                            }
                        } else {
                            //prompt user to go back and re-enter first name and last name
                            echo "<strong> $firstname $lastname </strong> is in an incorrect format. Only characters 'A' to 'Z' or 'a' to 'z' are allowed. No numbers or special characters. <br /> <br />";
                        }
                    }
                }
                ?>

                <!-- first, last name PHP form handler ends here -->

                <input type="submit" id="nameSubmit" name="nameSubmit" value="Save name" />

                <h3>Username</h3>
                <p class="formContent">Current username: <?php echo $_SESSION['username'] ?></p>
                <label for="uname">New username </label>
                <input type="text" id="uname" name="uname" value="<?php echo $_SESSION['username'] ?>">
                <span id="uTip" style="visibility: hidden;"></span><br /><br />

                <!-- username PHP form handler starts here -->

                <?php
                //username
                if (!empty($_POST['usernameSubmit'])) {
                    if (
                        isset($_POST['uname']) && !empty($_POST['uname'])
                    ) {

                        $username = htmlspecialchars($_POST['uname']);
                        $username = mysqli_real_escape_string($db, $username);

                        if (preg_match("/^[A-z_0-9]+$/", $username)) { //only allow this input format

                            $constructed_query = "UPDATE account
                                                    SET
                                                    user_name = '$username'
                                                    WHERE
                                                    email_address = '{$_SESSION['email']}'
                                                    and password = '{$_SESSION['pass']}'";

                            #Execute query
                            //for each query you have to have a constructed query and a result query
                            $result = mysqli_query($db, $constructed_query);
                            header("Refresh: 0"); //refresh to display new username


                            #if result object is not returned, then print an error and exit the PHP program
                            if (!$result) {
                                print("Error - query could not be executed");
                                $error = mysqli_error($db);
                                print "<p> . $error . </p>";
                                exit;
                            }
                        } else {
                            //prompt user to go back and re-enter username
                            echo "<strong> $username </strong> is in an incorrect format. Only numbers and characters from 'A' to 'Z' or 'a' to 'z' are allowed. No spaces or special characters. <br /> <br />";
                        }
                    }
                }
                ?>

                <!-- username PHP form handler ends here -->

                <input type="submit" id="usernameSubmit" name="usernameSubmit" value="Save username" />
            </form>
        </div>

        <br /><br />

    </div>

</body>

</html>