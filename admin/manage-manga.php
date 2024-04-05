<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Manage Manga </h1>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset ($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }

            if(isset($_SESSION['no-manga-found']))
            {
                echo $_SESSION['no-manga-found'];
                unset ($_SESSION['no-manga-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset ($_SESSION['failed-remove']);
            }

        ?>

        <br>
            <!-- add admin -->
            <a href="<?php echo SITEURL; ?>admin/add-manga.php" class="btn btn-primary">Add manga</a>
            <br><br><br>

            <table class="tbl">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Get all db manga data
                    $sql = "SELECT * FROM tbl_manga";

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

                                                <img src="<?php echo SITEURL; ?>images/manga/<?php echo $img_name; ?>" width="100px">

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
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-manga.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update Manga</a>

                                        <a href="<?php echo SITEURL; ?>admin/delete-manga.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>"class="btn btn-delete">Delete Manga</a>

                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //No data avalible
                        ?>

                        <tr>
                            <td colspan="6"><div class="error">No Manga Added</div></td>
                        </tr>

                        <?php
                    }
                ?>

            </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>