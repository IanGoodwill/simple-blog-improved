<?php
require '../connection.php';

$message = FALSE;

if ( isset( $_POST['id'] ) ) {
    $id = (integer) $_POST['id'];
    $sql= 'DELETE FROM posts WHERE id='.$id.';';
    if ( $connection->query( $sql )) {
        $message = 'Post successfully deleted!';
    } else  {
        $message = 'Unable to delete target post.';
    }
}
?><!DOCTYPE html>

<html>

    <head>
        <title>Delete Post </title>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
    </head>

    <body>
        <h1>Delete Post</h1>

        <?php if ( $message ) echo "<p>{$message}</p>"; // Show a message! ?>

        <a href="../posts/blog_index.php">
            Return to blog index.
        </a>

    </body>

</html>