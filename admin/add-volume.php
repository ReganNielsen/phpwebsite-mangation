<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add volume</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Volume Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Stock: </td>
                    <td>
                        <input type="radio" name="stock" value="Yes"> Yes
                        <input type="radio" name="stock" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Manga: </td>
                    <td>
                        <select name="manga">

                            <?php 
                                //Display manga from db
                                //SQL -> Get active manga
                                $sql = "SELECT * FROM tbl_manga WHERE stock = 'Yes'";

                                $res = mysqli_query($conn, $sql);

                                //Count rows -> manga
                                $count = mysqli_num_rows($res);
                                if($count > 0)
                                {
                                    //Manga present
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //Values of manga
                                        $id = $row["id"];
                                        $title = $row["title"];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No manga found</option>
                                    <?php
                                }

                                //Display -> drop down
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Volume description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add volume" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            //Check if submit clicked
            if(isset($_POST['submit']))
            {
                //Get form value
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $manga = mysqli_real_escape_string($conn,$_POST['manga']);
                $price = mysqli_real_escape_string($conn,$_POST['price']);
                $description = mysqli_real_escape_string($conn,$_POST['description']);

                //Radio -> check if selected
                if(isset($_POST['featured']))
                {
                    //Get value
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set default
                    $featured = 'No';
                }

                if(isset($_POST['stock']))
                {
                    $stock = $_POST['stock'];
                }
                else
                {
                    $stock = 'No';
                }

                //Check image
                if(isset($_FILES['image']['name']))
                {
                    //Upload
                    $img_name = $_FILES['image']['name'];

                    //Upload if image is selected
                    if($img_name != "")
                    {

                        //Auto image rename
                        $ext = end(explode('.', $img_name));

                        //Rename
                        $img_name = "volume_".rand(000,999).'.'.$ext; //e.g. output volume_001.png

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/volume/".$img_name;

                        //Upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check for image -> stop and redirect if not
                        if($upload==FALSE)
                        {
                            $_SESSION["upload"] = "<div class='error'>Failed To Upload Image</div>";
                            //Redirect to add volume
                            header("location".SITEURL."admin/add-volume.php");
                            //Stop process
                            die();
                        }
                    }
                }
                else
                {
                    //Dont upload - value blank
                    $img_name = '';
                }

                //SQL query -> insert volume
                // String value -> '' / Int value -> do not need ''
                $sql2 ="INSERT INTO tbl_manga_volumes SET 
                    title = '$title', 
                    img_name = '$img_name',
                    featured = '$featured', 
                    stock = '$stock',
                    manga_id = $manga,
                    price = $price,
                    description = '$description'
                ";

                //Execute + Save in db
                $res2 = mysqli_query($conn, $sql2);

                //Check if executed correctly
                if($res2==TRUE)
                {
                    //volume added
                    $_SESSION["add"] = "<div class='success'>Volume Added</div>";
                    //Redirect -> manage volume page
                    header('location:'.SITEURL.'admin/manage-volume.php');
                }
                else
                {
                    //Failed to add volume
                    $_SESSION["add"] = "<div class='error'>Failed to add volume</div>";
                    //Redirect -> manage volume page
                    header('location:'.SITEURL.'admin/manage-volume.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php')?>