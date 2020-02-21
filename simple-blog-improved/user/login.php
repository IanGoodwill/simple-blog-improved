<?php
include './classes.php';
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}

$login = new Login();
    
?><!DOCTYPE html>

<html>
    <head>
        <title> Login Page </title>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
    </head>
    <body>

        <h1>Please Login Here</h1>

        <p>
            <?php
                if ( $message ) echo "<p>{$message}</p>"; // Show a message! 
            ?>
        </p>

        <form method="post" action="../index.php" name="loginform">

            <label for="login_input_username">Username</label>
            <input id="login_input_username" class="login_input" type="text" name="user_name" required />

            <label for="login_input_password">Password</label>
            <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

            <input type="submit"  name="login" value="Log in" />

        </form>

    </body>

</html>