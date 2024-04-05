<?php 
    include("../config/constant.php");
    //End session
    session_destroy(); //unsets $_SESSION['user']

    //Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>