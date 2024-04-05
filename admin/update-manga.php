<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Manga</h1>
        <br><br>

        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                //Get ID -> other details
                $id=$_GET['id'];

                $sql="SELECT * FROM tbl_manga WHERE id=$id";

                $res=mysqli_query($conn,$sql);

                //Check if data is available
                $count = mysqli_num_rows($res);
                //Check manga data
                if($count==1)
                {
                    //Display details
                    $row=mysqli_fetch_assoc($res);
                    $title = $row["title"];
                    $current_image = $row["img_name"];
                    $featured = $row["featured"];
                    $stock = $row["stock"];
                }
                else
                {
                    //Redirect - manga protection
                    $_SESSION['no-manga-found'] = "<div class='error'>Manga Not Found</div>";
                    header("location:".SITEURL."admin/manage-manga.php");
                }
            }
            else
            {
                //Redirect - manga protection
                header('location:'.SITEURL.'admin/manage-manage.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Manga Title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //Display img
                                ?>
                                <img src="<?php echo SITEURL; ?>images/manga/<?php echo $current_image ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display message
                                echo"<div class='error'>No Image</div>";
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
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Manga" class="btn-secondary">
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

                //Check image selection
                if(isset($_FILES['image']['name']))
                {
                    //Img details
                    $img_name = $_FILES['image']['name'];

                    //Check = availability
                    if($img_name != '')
                    {
                        //Image available -> Upload new / Remove old
                        //Auto image rename
                        $ext = end(explode('.', $img_name));

                        //Rename
                        $img_name = "Manga_".rand(000,999).'.'.$ext; //e.g. output Manga_001.png

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/manga/".$img_name;

                        //Upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check for image -> stop and redirect if not
                        if($upload==FALSE)
                        {
                            $_SESSION["upload"] = "<div class='error'>Failed To Upload Image</div>";
                            //Redirect to add manga
                            header("location".SITEURL."admin/manage-manga.php");
                            //Stop process
                            die();
                        }

                        //Remove current image
                        if($current_image != "")
                        {
                            $remove_path = "../images/manga/".$current_image;

                            $remove = unlink($remove_path);

                            //Check if !image
                            if($remove==FALSE)
                            {
                                //Failed
                                $_SESSION["failed-remove"] = "<div class='error'>Failed to remove current image</div>";
                                header("location".SITEURL."admin/manage-manga.php");
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

                //SQL query -> Update manga details
                $sql2 = "UPDATE tbl_manga SET
                    title = '$title',
                    img_name = '$img_name',
                    featured = '$featured', 
                    stock = '$stock'
                    WHERE id='$id'
                ";

                $res2 = mysqli_query($conn, $sql2);

                //Successful completition
                if($res2==TRUE)
                {
                    //Successful
                    $_SESSION['update']="<div class='success'>Manga Updated</div>";
                    //Redirect
                    header('location:'.SITEURL.'admin/manage-manga.php');
                }
                else
                {
                    //Failed
                    $_SESSION['update']="<div class='error'>Manga Failed To Be Updated</div>";
                    //Redirect
                    header('location:'.SITEURL.'admin/manage-manga.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php')?>