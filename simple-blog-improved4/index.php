<?php 
session_start();
require './connection.php';
include './classes.php';

$login = new Login();

$registration = new Registration();

$message = '';
 
// ... ask if we are logged in here:
    if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
        header( 'location: blog_index.php');
    
    } else {
        include("login.php");
        include("register.php");
    }

  
    


