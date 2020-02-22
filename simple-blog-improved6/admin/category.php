<?php
require '../connection.php';
include './admin_nav.php';

$message= '';

if ( isset( $_POST['NewCategory'] ) && !empty( $_POST )) {
    // Retrieve POSTed values.
    $category = $_POST['NewCategory'] ?? '';
    $message .= "You have successfully created a new category";
    $sql= 'INSERT INTO categories(name) VALUES("'.$category.'");';
}
    
?><!DOCTYPE html>

<html>

    <head>
        <title>Categories </title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
    </head>

    <body>

        <h1>Create a Category</h1>

        <?php if ( $message ) echo "<p>{$message}</p>"; // Show a message! ?>

        <form action="#" method="POST">
            <label for="NewCategory">
                New Category:
                <input type="text" placeholder= "Enter a new Category..."name="NewCategory" title="Enter your new category!" >
            </label>
            <input type="submit" value="New Category"> 
        </form>


        <h1>Delete a Category</h1>

        <form action="#" method="POST">
            <label for="deleteCategory">
                Delete Category:
                <input type="text" placeholder= "Enter name of category yo would like to delete. "name="DeleteCategory" title="Delete a category!" >
            </label>
            <input type="submit" value="Delete Category"> 
        </form>

        <?php

        if (isset($_POST['DeleteCategory'])) {
            $destroy_category = $_POST['DeleteCategory'] ?? '';
            $sql= 'DELETE FROM categories WHERE name='.$destroy_category.';';
            $message .= "You have successfully deleted this category";
        } else {
            $message .= "An error has occured deleting this category";
        }

        ?>

        <a href="../blog_index.php">
            Return to blog index.
        </a>

    </body>

</html>