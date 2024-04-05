<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //add session message
                        unset($_SESSION['add']); //remove session message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; 
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; 
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['password-not-match']))
                    {
                        echo $_SESSION['password-not-match'];
                        unset($_SESSION['password-not-match']);
                    }
                    if(isset($_SESSION['change-password']))
                    {
                        echo $_SESSION['change-password'];
                        unset($_SESSION['change-password']);
                    }
                ?>

                <br>
                <!-- add admin -->
                <a href="add-admin.php" class="btn btn-primary">Add Admin</a>
                <br><br><br>

                <table class="tbl">
                    <tr>
                        <th>I.D.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //retrieve all data from admin table in sql db
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute query
                        $res = mysqli_query($conn, $sql);

                        //Check execution
                        if($res==TRUE)
                        {
                            //Check rows -> check for data in db
                            $count = mysqli_num_rows($res);

                            $sn=1; //Variable instead of ID

                            //Check num rows
                            if($count> 0)
                            {
                                //data is present
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //User while loop to collect all data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display values in table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn btn-delete">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            else
                            {
                                //no data is present
                            }

                        }
                    ?>
                </table>

            </div>
        </div>

<?php include('partials/footer.php'); ?>