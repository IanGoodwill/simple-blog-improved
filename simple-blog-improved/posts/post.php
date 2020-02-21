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

    try {

       // Find out how many items are in the table
  
$sql= 'SELECT count(*) AS count FROM posts AS output;';
$target = $sql;

// How many items to list per page
$limit = 20;

// How many pages will there be
$pages = ceil($total / $limit);

// What page are we currently on?
$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));

// Calculate the offset for the query
$offset = ($page - 1)  * $limit;

// Some information to display to the user
$start = $offset + 1;
$end = min(($offset + $limit), $total);

// The "back" link
$prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

// The "forward" link
$nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

// Display the paging information
echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

// Prepare the paged query
$stmt = $dbh->prepare('
    SELECT
        *
    FROM
        posts
    ORDER BY
        name
    LIMIT
        :limit
    OFFSET
        :offset
');

// Bind the query params
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

// Do we have any results?
if ($stmt->rowCount() > 0) {
    // Define how we want to fetch the results
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $iterator = new IteratorIterator($stmt);

    // Display the results
    foreach ($iterator as $row) {
        echo '<p>', $row['name'], '</p>';
    }

} else {
    echo '<p>No results could be displayed.</p>';
}

} catch (Exception $e) {
echo '<p>', $e->getMessage(), '</p>';
}
?>
    </body>

</html>

