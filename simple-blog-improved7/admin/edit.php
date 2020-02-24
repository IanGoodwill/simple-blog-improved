<?php
require '../connection.php';
include './admin_nav.php';

$message= '';

if (isset( $_GET['id'] ) && isset( $_POST)  && !empty( $_POST )) {
    $id = (integer) $_GET['id'];
    $sql = 'UPDATE posts SET title="'.$_POST['title'].'", content="'.$_POST['content']. '", description="'.$_POST['description'].'" WHERE id='.$id.';';
    if ( $connection->query( $sql) ) {
        $message .= 'Successfully updated post : "'.$_POST['title']. '"';
    } else  {
        $message .= 'Failed post update. Please try again.';
    }
}

if (isset( $_GET['id'])) {
    $id = (integer) $_GET['id']; // this is typecasting, it forces the input to be an integer
    $sql = ' SELECT * FROM posts WHERE id=' .$id.';';
    if ( $result = $connection->query( $sql ) ) {
        $message .= 'Post Found!';
        $post;
        // retrieve the post data, only getting one post this time
        while ( $row = $result->fetch_assoc() ) // if one thing you can do it on one line
            $post = $row; 
            // decide values
        $title= $_POST['title'] ?? $post['title'];
        $description = $POST['description'] ?? $post['description'];
        $content = $_POST['content']  ?? $post['content'];
    } else {
        $message .= "an error was encountered while trying to retieve this post.";
        $message .= '<br><pre>' .print_r( $connection->error_list, TRUE ). '</pre>';
    }

} else {
    header( 'Location: blog_index.php' ); // redirect the user to the blog index to try again
    die; // terminate script just incase
}

//set up an sql statement
$sql= 'SELECT * FROM posts(title, content, description,) VALUES("'.$title.'", "'.$content.'", "'.$description.'");';

?><!DOCTYPE html>

<html>

    <head>
        <title>Edit <?php echo $post['title']; ?> </title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
    </head>

    <body>

        <h1>Edit <?php echo $post['title']; ?></h1>

        <?php if ( $message ) echo "<p>{$message}</p>"; // show a message ?>

        <form action="#" method="POST">
            <label for="title"> 
                Title:
                <input type="text" placeholder= "Enter a title..."name="title" title="Enter your title!" <?php if (isset( $title)) echo ' value="' .$title. '"'; ?>>
            </label>
            <label for="content"> 
                Content:
                <textarea name = "content" cols="30" rows="10" placeholder = "enter the blog post content..." > <?php if (isset( $content)) echo $content; ?></textarea>
            </label>
            <label for="description"> 
                Description:
                <input type="text" placeholder= "Enter a description..." name= "description" <?php if (isset( $description)) echo ' value="' . $description.'"'; ?>>
            </label>
            <input type="submit" value="Update Post">    
        </form>

        <a href="../blog_index.php">
            Return to blog index.
        </a>


    </body>

</html>