<?php 
    include("../config/constant.php");

//Get id of admin to be delete
    $id = $_GET['id'];

//SQL query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
        //Sucess -> admin delete
        $_SESSION['delete'] = "<div class='success'>Deleted Admin Successfully!</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed -> admin not deleted
        $_SESSION['delete'] = "<div class='error'>Admin deletion failed</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

//Redirect to manage admin page + message

?>