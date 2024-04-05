<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Manage Volumes </h1>
        <br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset ($_SESSION['remove']);
            }

            if(isset($_SESSION['unauth']))
            {
                echo $_SESSION['unauth'];
                unset ($_SESSION['unauth']);
            }
            
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }
        ?>

        <a href="<?php echo SITEURL; ?>admin/add-volume.php" class="btn btn-primary">Add Volume</a>

        <br><br><br>
            <table class="tbl">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Get all db volume data
                    $sql = "SELECT * FROM tbl_manga_volumes";

                    $res = mysqli_query($conn, $sql);

                    //Count rows
                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    //Check db data
                    if($count > 0)
                    {
                        //Data avalible
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $img_name = $row ['img_name'];
                            $featured = $row ['featured'];
                            $stock = $row ['stock'];
                            $price = $row ['price'];
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?> </td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            //Image name = avalible
                                            if($img_name != '')
                                            {
                                                //display img
                                                ?>

                                                <img src="<?php echo SITEURL; ?>images/volume/<?php echo $img_name; ?>" width="100px">

                                                <?php
                                            }
                                            else
                                            {
                                                //display message
                                                echo '<div class="error">No Image Avalible</div>';
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $stock; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-volume.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update volume</a>

                                        <a href="<?php echo SITEURL; ?>admin/delete-volume.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>"class="btn btn-delete">Delete volume</a>

                                    </td>
                            <?php
                        }
                    }
                    else
                    {
                        //No data avalible
                        ?>

                        <tr>
                            <td colspan="7"><div class="error">No volume Added</div></td>
                        </tr>

                        <?php
                    }
                ?>
            </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>