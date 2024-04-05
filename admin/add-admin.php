<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //session message
                unset($_SESSION['add']); //remove session messaage
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
//process value from form -> save to db
//check submit button -> if clicked -> post

    if(isset($_POST['submit']))
    {
        //Obtain form data
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = md5($_POST['password']); //md5 = encrypted password
        //md5 is encrypted therefore real escape string not needed

        //SQL query to submit data to db
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //Execute -> Save data in db
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check if submit worked
        if($res==TRUE)
        {
            //Submitted
            $_SESSION['add'] = "Added Admin Successfully!";
            //Redirect page -> Manage admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed
            $_SESSION['add'] = "Failed To Add Admin...";
            //Redirect page -> Manage admin
            header('location:'.SITEURL.'admin/add-admin.php');
        }

    }

?>