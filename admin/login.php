<?php include('../config/constant.php'); ?>

<html>
    <head>
        <title>Login - Manga Store</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['not-login-message']))
                {
                    echo $_SESSION['not-login-message'];
                    unset($_SESSION['not-login-message']);
                }
            ?>

            <br><br>

            <form action="" method="POST" class="text-center">
                <p>Username: </p><br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>

                <p>Password: </p><br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>
            </form>

            <P class="text-center">Created by Regan</P>
        </div>
    </body>
</html>

<?php 

    //Check if submit button -> clicked
    if (isset($_POST['submit']))
    {
        //Login process
        //Get form login data
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //SQL check user with username/password -> exist
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //Execute query
        $res = mysqli_query($conn, $sql);
        
        //Count row to check user = exist
        $count = mysqli_num_rows($res);
        if ($count == 1)
        {
            //User + Login success
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username; //Checks if user = logged in

            //Redirect -> Dashboard
            header('location:'.SITEURL.'admin/admin.php');
        }
        else
        {
            //!User + Login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
            //Redirect -> Login
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>