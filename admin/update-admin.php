<?php include("partials/menu.php"); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php 
                //Get selected admin id
                $id=$_GET['id'];

                //Create sql query to retrieve details
                $sql="SELECT * FROM tbl_admin WHERE id=$id";

                //Run query
                $res=mysqli_query($conn,$sql);

                if($res==TRUE)
                {
                    //Check if data is available
                    $count = mysqli_num_rows($res);
                    //Check admin data
                    if($count==1)
                    {
                        //Display details
                        $row=mysqli_fetch_assoc($res);
                        $full_name = $row["full_name"];
                        $username = $row["username"];
                    }
                    else
                    {
                        //Redirect - admin protection
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full name: </td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>

    <?php 
    if(isset($_POST['submit']))
    {
        //Get updated values
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);

        //SQL query -> Update admin details
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        $res = mysqli_query($conn, $sql);

        //Successful completition
        if($res==TRUE)
        {
            //Successful
            $_SESSION['update']="<div class='success'>Admin Updated</div>";
            //Redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed
            $_SESSION['update']="<div class='error'>Admin Failed To Be Updated</div>";
            //Redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
    
    ?>

<?php include("partials/footer.php"); ?>