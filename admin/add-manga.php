<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Manga</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Manga Title">
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
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Manga" class="btn-secondary">
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

                //Radio -> check if selected
                if(isset($_POST['featured']))
                {
                    //Get value
                    $featured = mysqli_real_escape_string($conn, $_POST['featured']);
                }
                else
                {
                    //Set default
                    $featured = 'No';
                }

                if(isset($_POST['stock']))
                {
                    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
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
                            header("location".SITEURL."admin/add-manga.php");
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

                //SQL query -> insert manga
                $sql ="INSERT INTO tbl_manga SET 
                    title = '$title', 
                    img_name = '$img_name',
                    featured = '$featured', 
                    stock = '$stock'
                ";

                //Execute + Save in db
                $res = mysqli_query($conn, $sql);

                //Check if executed correctly
                if($res==TRUE)
                {
                    //Manga added
                    $_SESSION["add"] = "<div class='success'>Manga Added</div>";
                    //Redirect -> manage manga page
                    header('location:'.SITEURL.'admin/manage-manga.php');
                }
                else
                {
                    //Failed to add manga
                    $_SESSION["add"] = "<div class='error'>Failed to add manga</div>";
                    //Redirect -> manage manga page
                    header('location:'.SITEURL.'admin/add-manga.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php')?>