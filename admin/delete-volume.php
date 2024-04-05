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
            $path = "../images/volume/".$img_name;
            //Remove img
            $remove = unlink($path);

            //Fail to remove -> stop process + msg
            if ($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class='error'>Failed To Remove volume Image</div>";
                header("location:".SITEURL."admin/manage-volume.php");
                die("");
            }
        }
        //Delete from db
        $sql = "DELETE FROM tbl_manga_volumes WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        //Check if data is deleted from db
        if ($res==TRUE)
        {
            //Success -> Redirect
            $_SESSION["delete"] = "<div class='success'>Successfully deleted volume</div>";
            //Redirect
            header("location:".SITEURL."admin/manage-volume.php");
        }
        else
        {
            //Error -> Redirect
            $_SESSION["delete"] = "<div class='error'>Failed to delete volume</div>";
            //Redirect
            header("location:".SITEURL."admin/manage-volume.php");
        }

        //Redirect to manage-volume

    }
    else
    {
        //Redirect -> manage-volume page
        $_SESSION["unauth"] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-volume.php');
    }
?>