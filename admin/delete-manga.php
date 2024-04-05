<?php 
    include("../config/constant.php");
    //Check img_name + id value is set
    if (isset($_GET['id']) AND isset($_GET['img_name']))
    {
        //Get value -> delete
        $id = $_GET['id'];
        $img_name = $_GET['$img_name'];

        //Remove actual image file if available
        if ($img_name != "")
        {
            //Del -> img present
            $path = "../images/manga/".$img_name;
            //Remove img
            $remove = unlink($path);

            //Fail to remove -> stop process + msg
            if ($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class='error'>Failed To Remove Manga Image</div>";
                header("location:".SITEURL."admin/manage-manga.php");
                die("");
            }
        }
        //Delete from db
        $sql = "DELETE FROM tbl_manga WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        //Check if data is deleted from db
        if ($res==TRUE)
        {
            //Success -> Redirect
            $_SESSION["delete"] = "<div class='success'>Successfully deleted manga</div>";
            //Redirect
            header("location:".SITEURL."admin/manage-manga.php");
        }
        else
        {
            //Error -> Redirect
            $_SESSION["delete"] = "<div class='error'>Failed to delete manga</div>";
            //Redirect
            header("location:".SITEURL."admin/manage-manga.php");
        }

        //Redirect to manage-manga

    }
    else
    {
        //Redirect -> manage-manga page
        header('location:'.SITEURL.'admin/manage-manga.php');
    }
?>