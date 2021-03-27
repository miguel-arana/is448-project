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
    <script type="text/javascript" src="security.js"></script>

    <div class="sidebar">
        <img class="logo" src="images/logo.png" alt="todo app logo" />
        <a href="homepage.php"><img class="icon" src="images/home.png" alt="home icon" /> Home</a>
        <a href="general.php"><img class="icon" src="images/gear.png" alt="cog wheel" /> General</a>
        <a class="active" href="security.php"><img class="icon" src="images/shield_w.png" alt="security logo" />
            Security</a>
    </div>

    <div class="content">
        <h2>Security Settings</h2>
        <div>
            <h3>Email</h3>
            <p class="formContent">Current email: <?php echo $_SESSION['email'] ?></p>
            <form class="indent" method="POST" action="security.php">
                <label for="email">New email </label>
                <input type="text" id="email" name="email" value="<?php echo $_SESSION['email'] ?>">
                <span id="emailTip" style="visibility: hidden;"></span><br />
                <br />

                <?php
                if (!empty($_POST['emailsubmit'])) {
                    if (
                        isset($_POST['email'])  && !empty($_POST['email'])
                    ) {
                        $given_email = htmlspecialchars($_POST['email']);
                        $given_email = mysqli_real_escape_string($db, $given_email);

                        if (preg_match("/^\w+@[a-z]+\.[a-z]+$/", $given_email)) {

                            $constructed_query = "UPDATE account
                                        SET email_address = '$given_email'
                                        WHERE
                                            account_id = '{$_SESSION['accountId']}'";

                            #Execute query
                            //for each query you have to have a constructed query and a result query
                            $result = mysqli_query($db, $constructed_query);
                            $_SESSION['email'] = $given_email;
                            header("Refresh: 0"); //refresh to display new email


                            #if result object is not returned, then print an error and exit the PHP program
                            if (!$result) {
                                print("Error - query could not be executed");
                                $error = mysqli_error($db);
                                print "<p> . $error . </p>";
                                exit;
                            }
                        } else {
                            //prompt user to go back and re-enter credentials
                            echo "<strong> $given_email </strong> is in an incorrect format. Example of accepted format is abc_123@gmail.com. <br /> <br />";
                        }
                    }
                }
                ?>
                <input type="submit" id="emailSubmit" name="emailsubmit" value="Save email" />
            </form>
        </div>

        <br /><br />
        <div>
            <h3>Password</h3>
            <form class="indent" method="POST" action="security.php">
                <label for="password">New password </label>
                <input type="password" id="password" name="password"><br />
                <label for="confirmpass">Confirm new password </label>
                <input type="password" id="confpass" name="confpass"><br />
                <input type="checkbox" id="seePassword">Show Password<br />
                <br />
                <?php

                if (!empty($_POST['passwordsubmit'])) {
                    if (
                        isset($_POST['password'])  && !empty($_POST['password']) &&
                        isset($_POST['confpass'])  && !empty($_POST['confpass'])
                    ) {


                        $given_password = htmlspecialchars($_POST['password']);
                        $given_password = mysqli_real_escape_string($db, $given_password);

                        $confirmPass = htmlspecialchars($_POST['confpass']);
                        $confirmPass = mysqli_real_escape_string($db, $confirmPass);

                        if ($given_password == $confirmPass) {

                            $password_query = "UPDATE account
                                            SET password = '$given_password'
                                            WHERE
                                                account_id = '{$_SESSION['accountId']}'";


                            #Execute query
                            //for each query you have to have a constructed query and a result query
                            $result = mysqli_query($db, $password_query);
                            $_SESSION['pass'] = $given_password;
                            header("Refresh: 0"); //refresh to display new email


                            #if result object is not returned, then print an error and exit the PHP program
                            if (!$result) {
                                print("Error - query could not be executed");
                                $error = mysqli_error($db);
                                print "<p> . $error . </p>";
                                exit;
                            }
                        } else {
                            echo "Passwords do not match.";
                        }
                    } else {
                        echo "Please fill in both fields.";
                    }
                }
                ?>
                
                <input type="submit" id="passwordSubmit" name="passwordsubmit" value="Save password" />
            </form>
        </div>


        <br /><br />



    </div>

</body>

</html>