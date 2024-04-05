<?php include('partials/menu.php')?>

<?php 
    if(isset($_GET['id']))
    {
        //Get ID -> other details
        $id = $_GET['id'];

        $sql2 = "SELECT * FROM tbl_manga_volumes WHERE id=$id";

        $res2 = mysqli_query($conn, $sql2);

        //Check if data is available
        $row2 = mysqli_fetch_assoc($res2);

        //Check volume data
        $title = $row2['title'];
        $current_image = $row2['img_name'];
        $featured = $row2['featured'];
        $stock = $row2['stock'];
        $current_manga = $row2['manga_id'];
        $price = $row2['price'];
        $description = $row2['description'];
    }
    else
    {
        //Redirect - volume protection
        header('location:'.SITEURL.'admin/manage-manga.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Volume</h1>
        <br><br>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image == "")
                            {
                                //Display message
                                echo"<div class='error'>No Image</div>";
                            }
                            else
                            {
                                //Display img
                                ?>
                                <img src="<?php echo SITEURL; ?>images/volume/<?php echo $current_image ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Stock: </td>
                    <td>
                        <input <?php if($stock=="Yes"){echo "checked";} ?> type="radio" name="stock" value="Yes"> Yes

                        <input <?php if($stock=="No"){echo "checked";} ?> type="radio" name="stock" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Manga: </td>
                    <td>
                        <select name="manga">
                            <?php 
                                $sql = "SELECT * FROM tbl_manga WHERE stock='Yes'";

                                $res = mysqli_query ($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                    //Available
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $manga_title = $row["title"];
                                        $manga_id = $row["id"];

                                        ?>
                                        <option <?php if($current_manga==$manga_id){echo "Selected";}?> value="<?php echo $manga_id; ?>"><?php echo $manga_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //!Available
                                    echo "<option value='0'>Manga Not Available</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update volume" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                //Get updated values
                $id = mysqli_real_escape_string($conn,$_POST['id']);
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $current_image = $_POST['current_image'];
                $featured = mysqli_real_escape_string($conn,$_POST['featured']);
                $stock = mysqli_real_escape_string($conn,$_POST['stock']);
                $manga = mysqli_real_escape_string($conn,$_POST['manga']);
                $price = mysqli_real_escape_string($conn,$_POST['price']);
                $description = mysqli_real_escape_string($conn,$_POST['description']);

                //Check image selection
                if(isset($_FILES['image']['name']))
                {
                    //Img details
                    $img_name = $_FILES['image']['name'];

                    //Check = availability
                    if($img_name !="")
                    {
                        //Image available -> Upload new / Remove old
                        //Auto image rename
                        $ext = end(explode('.', $img_name));

                        //Rename
                        $img_name = "volume_".rand(0000,9999).'.'.$ext; //e.g. output volume_001.png

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/volume/".$img_name;

                        //Upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check for image -> stop and redirect if not
                        if($upload==FALSE)
                        {
                            $_SESSION["upload"] = "<div class='error'>Failed To Upload Image</div>";
                            //Redirect to add volume
                            header("location".SITEURL."admin/manage-volume.php");
                            //Stop process
                            die();
                        }

                        //Remove current image
                        if($current_image != "")
                        {
                            $remove_path = "../images/volume".$current_image;

                            $remove = unlink($remove_path);

                            //Check if !image
                            if($remove==FALSE)
                            {
                                //Failed
                                $_SESSION["failed-remove"] = "<div class='error'>Failed to remove current image</div>";
                                header("location".SITEURL."admin/manage-volume.php");
                                die();
                            }
                        }
                    }
                    else
                    {
                        $img_name = $current_image;
                    }
                }
                else
                {
                    $img_name = $current_image;
                }

                //SQL query -> Update volume details
                $sql3 = "UPDATE tbl_manga_volumes SET
                    title = '$title',
                    img_name = '$img_name',
                    featured = '$featured', 
                    stock = '$stock',
                    manga_id = '$manga',
                    price = $price,
                    description = '$description'
                    WHERE id='$id'
                ";

                $res3 = mysqli_query($conn, $sql3);

                //Successful completition
                if($res3==TRUE)
                {
                    //Successful
                    $_SESSION['update']="<div class='success'>volume Updated</div>";
                    //Redirect
                    header('location:'.SITEURL.'admin/manage-volume.php');
                }
                else
                {
                    //Failed
                    $_SESSION['update']="<div class='error'>Volume Failed To Be Updated</div>";
                    //Redirect
                    header('location:'.SITEURL.'admin/manage-volume.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php')?>