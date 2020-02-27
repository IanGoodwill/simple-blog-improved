<?php
require '../connection.php';

$message = FALSE;



if ( isset( $_POST ) && !empty( $_POST )) {
    // Retrieve POSTed values.
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $description = $_POST['description'] ?? ''; // ?? makes 
    $date = strtotime( 'now' ); // Set to current time and date
    $category = $_POST['category'] ?? '';
   
    //set up an sql statement
    $sql= 'INSERT INTO posts(title, content, description, date, category_name) VALUES("'.$title.'", "'.$content.'", "'.$description.'", "'.$date.'","'.$category.'");';


    // execute SQL statement
    if($connection->query( $sql )) {
        $message = 'Successfully added "'.$title.'" post to the database.';
        $_POST = array();
    } else {
        $message = 'Unable to add your "'.$title.'" post to the database. Please try again.';
        foreach ( $connection->error_list as $error ) {
            $message = '<br><pre>' .print_r( $connection->error_list, TRUE ). '</pre>';
        }
    }
}


if ( isset( $_POST['category'] ) && !empty( $_POST['category'] )) {
    $category = $_POST['category'] ?? '';
    $sql= 'INSERT INTO categories(name) VALUES("'.$category.'");';
    if($connection->query( $sql )) {
        $message = 'Successfully added "'.$category.'" category to the database.';
        $_POST = array();
    } else {
        $message = 'Unable to add your "'.$category.'" category to the database. Please try again.';
        foreach ( $connection->error_list as $error ) {
            $message = '<br><pre>' .print_r( $connection->error_list, TRUE ). '</pre>';
        }
    }
}


?><!DOCTYPE html>

<html>

    <head>
        <title> New Post </title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
    </head>

    <header class = "simple-blog-header">

<a href="../blog_index.php">Blog Index</a>    

<a href="./newpost.php">Create New Post</a>

<a href="./delete.php">Delete A Post</a>

<a href="./category.php">Categories</a>

</header>

    <body>

        <h1>New Post</h1>

        <?php if ( $message ) echo "<p>{$message}</p>"; // Show a message! ?>

        <form action="./newpost.php" method="POST">
            <label for="title"> 
                Title:
                <input type="text" placeholder= "Enter a title..."name="title" title="Enter your title!" <?php if (isset( $_POST['title'])) echo ' value="' . $_POST['title'].'"' ?>>
            </label>
            <label for="content"> 
                Content:
                <textarea name = "content" cols="30" rows="10" placeholder = "enter the blog post content..." <?php if (isset( $_POST['content'])) echo  $_POST['content']; ?>></textarea>
            </label>
            <label for="description"> 
                Description:
                <input type="text" placeholder= "Enter a description..." name= "description" <?php if (isset( $_POST['description'])) echo ' value="' . $_POST['description'].'"'; ?>>
            </label>

            <label for="category"> 
                Choose a Category: 
                <input type="text" placeholder= "Enter a category..." name= "category" <?php if (isset( $_POST['category'])) echo ' value="' . $_POST['category'].'"'; ?>>
            </label>
            <input type="submit" value="Add New Post">    
        </form>



        <h3>Return to Blog Index</h3>

        <form action = "../blog_index.php" method = "POST">
            <input type= "submit" name="toBlogIndex" value="Back">
        </form>

    </body>

</html>
