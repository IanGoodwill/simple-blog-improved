<?php 
require '../connection.php';
include '../nav.php';
include '../user/classes.php';
session_start();

$message = '';


if (isset( $_GET ) && !empty( $_GET['logout'])) {
    /*session_unset();
    session_destroy();*/
    $_SESSION = []; //also unsets the session
} 

if( !isset( $_SESSION['logged_in'] ) || empty( $_SESSION) )  {
    header( 'Location: login.php' );
} else {
    $message .= "Thank you for logging in! Welcome, ". $_SESSION['user_name']. '. ';
}


$sql = 'SELECT * FROM posts;';

if ( $result = $connection->query( $sql )) { // can reference result later
    $message .= 'Blog posts queried successfully!';
} else {
    $message .= ' An error was encountered while trying to retrieve blog posts.';
    $message .= '<br><pre>' .print_r( $connection->error_list, TRUE ). '</pre>';  
}



?><!DOCTYPE html>

<html>

    <head>
        <title> Blog Index </title>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
    </head>

    <body>

        <h1>Blog Index</h1>

        <?php if ( $message ) echo "<p>{$message}</p>"; // Show a message! ?>

        <?php while ( $row = $result->fetch_assoc() ) : // loops through for each row ?>
            <li>
                <article>
                    <h2><?php echo $row['title']; ?></h2>
                    <p> <time> <?php echo date( 'Y.m.d', $row['date'] ); ?></time><br>
                    <?php echo $row['description']; ?> 
                    <form action ="./post.php">
                        <input type="hidden" name = "id" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Read More">
                    </form>
                    <form action ="../admin/edit.php" method = "GET">
                        <input type="hidden" name = "id" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Edit Post">
                    </form>
                    <form action ="../admin/delete.php" method = "POST">
                        <input type="hidden" name = "id" value="<?php echo $row['id']; ?>" >
                        <input type="submit" value="Delete Post">
                    </form>
                    </p>
                </article>
            </li>
        <?php endwhile; ?>

        <h3>Click below to log out</h3>

        <a href="../index.php?logout">Logout</a>

    </body>

</html>