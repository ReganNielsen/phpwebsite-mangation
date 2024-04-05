<?php 
    //Access control - authentication
    if(!isset($_SESSION['user'])) //if session is not set
    {
        //Not logged in -> login page
        $_SESSION['not-login-message'] = '<div class="error text-center">Please login to use Admin panel</div>';
        //Redirect
        header('location:'.SITEURL.'admin/login.php');
    }
?>