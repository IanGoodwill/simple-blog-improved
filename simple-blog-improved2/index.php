<?php 
require './connection.php';
include './user/classes.php';
session_start();

$message = '';

 if ( $message ) echo "<p>{$message}</p>"; // Show a message! 

// ... ask if we are logged in here:
    if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
        header( 'location: posts/blog_index.php');
    
    } else {
        include("user/login.php");
        include("user/register.php");
    }
    


