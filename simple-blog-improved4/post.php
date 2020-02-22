<?php
require './connection.php';
include './nav.php';

if (isset( $_GET['id'])) {
    $id = (integer) $_GET['id']; // this is typecasting, it forces the input to be an integer
    $sql = ' SELECT * FROM posts WHERE id=' .$id.';';
    if ( $result = $connection->query( $sql ) ) {
        $message = 'Post Found!';
        $post;
        // retrieve the post data, only getting one post this time
        while ( $row = $result->fetch_assoc() ) // if one thing you can do it on one line
            $post = $row; 
    } else {
        $message = "an error was encountered while trying to retieve this post.";
        $message .= '<br><pre>' .print_r( $connection->error_list, TRUE ). '</pre>';
    }

} else {
    header( 'Location: index.php' ); // redirect the user to the index to try again
    die; // terminate script just incase
}



?><!DOCTYPE html>

<html>

    <head>
        <title><?php echo $post['title']; ?> </title>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
    </head>

    <body>

        <h1><?php echo $post['title']; ?></h1>
        <?php if ( $message ) echo "<p>{$message}</p>"; // show a message ?>
        <p>
            <time><?php echo date( 'Y.m.d', $post['date']); ?> </time>
            <?php echo $post['content']; ?>
        </p>

    <?php
    // setting up pagination.
  
    if(isset($_GET['page'])){
        // if get page number through url and check it is a valid number
        $page_num = filter_var($_GET['page'], FILTER_VALIDATE_INT,[
            'options' => [
                'default' => 1,
                'min_range' => 1
            ]
        ]); 

        if(isset($_GET['page']) ) {
            $_GET['id'] = $_GET['page'];
        }
        
    }else{
        //default page number
        $page_num = 1;
    }
    // set how much show posts in a single page
    $page_limit = 2;
    // Set Offset
    $page_offset = $page_limit * ($page_num - 1);
    
    function showPosts($connection, $current_page_num, $page_limit, $page_offset){
        
        // query of fetching posts
        $query = mysqli_query($connection,"SELECT * FROM `posts` ORDER BY id LIMIT $page_limit OFFSET $page_offset");
        
        // check database is not empty
        if(mysqli_num_rows($query) > 0){
            
            // fetching data
            while($row = mysqli_fetch_array($query)){ 
                echo '<li><h2>'.$row['title'].'</h2><p>'.$row['description'].'</p></li>';
            }
            
            // total number of posts
            $total_posts = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM `posts`"));
            
            // total number of pages
            $total_page = ceil($total_posts / $page_limit);
            // set next page number
            $next_page = $current_page_num+1; 
            // set prev page number
            $prev_page = $current_page_num-1; 
            
           echo "<li>";
            //showing prev button and check current page number is greater than 1
            if($current_page_num > 1){
               echo '<a href="?page='.$prev_page.'" class="page_link">Prev</a>';
            }
            // show all number of pages
            for($i = 1; $i <= $total_page; $i++){
                //highlight the current page number
                if($i == $current_page_num){
                    echo '<a href="?page='.$i.'" class="page_link active_page">'.$i.'</a>';
                }else{
                    echo '<a href="?page='.$i.'" class="page_link">'.$i.'</a>';
                }
                
            }
            // showing next button and check this is last page
            if($total_page+1 != $next_page){
               echo '<a href="?page='.$next_page.'" class="page_link">Next</a>';
            }
            
            echo "</li>";  
            
        }else{
            echo "No Data found !";
        }
    }
    ?>

        <div class="container">
            <ul class="posts">
    <?php 
    // call showPosts function 
    showPosts($connection, $page_num, $page_limit, $page_offset);
    ?>  


   
    </body>

</html>

