<?php 
    //Session start
    session_start();

    //Constants for repeating variables
    define('SITEURL', 'http://localhost/phpwebsite/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'manga-db');

    //Execute -> Save data in db
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //db connect
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //db select
        
?>