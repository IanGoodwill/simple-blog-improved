<?php
// connect to db
$connection = new mysqli(
    'localhost',
    'root',
    '',
    'simple_blog_improved'
);
// handle error
if( $connection->error )  {
    echo 'CONNECTION ERROR:' . $connection->error;
    die;
} 

