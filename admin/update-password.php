<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change admin password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Old password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php 
    //Check when submit button is clicked
    if(isset($_POST['submit']))
    {
        //Get form data
            $id=$_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
        //Check if current password is matching current id
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                //Check avalibility
                $count = mysqli_num_rows($res);
                if($count==1) //one user = 1 id
                {
                    //User = password can be changed
                    if($new_password==$confirm_password) 
                    {
                        //Update password
                        $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password' 
                        WHERE id=$id
                        ";

                        //Execute
                        $res2 = mysqli_query($conn, $sql2);

                        //Check if executed
                        if ($res2==TRUE) {
                            //Successful
                            //Redirect
                            $_SESSION['change-password'] = "<div class='success'>Password changed</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else
                        {
                            //Unsuccessful
                            //Redirect
                            $_SESSION['change-password'] = "<div class='error'>Failed to change password</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        //Redirect
                        $_SESSION['password-not-match'] = "<div class='error'>Password did not match</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else 
                {
                    //!User = password cant change -> redirect
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                    //Redirect
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        //Check if new + confirm password = match

        //Change if above is true
    }
?>

<?php include('partials/footer.php') ?>