<?php include("partials/menu.php"); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php 
                if(isset($_GET["id"]))
                {
                    //Get Order Details
                    $id = $_GET["id"];

                    $sql = "SELECT * FROM tbl_order WHERE id=$id";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        //Order
                        $row = mysqli_fetch_assoc($res);

                        $manga = $row ["manga"];
                        $price = $row ["price"];
                        $quantity = $row ["quantity"];
                        $status = $row ["status"];
                        $cust_name = $row ["cust_name"];
                        $cust_contact = $row ["cust_contact"];
                        $cust_email = $row ["cust_email"];
                        $cust_address = $row ["cust_address"];
                    }
                    else
                    {
                        //!Order -> Redirect
                        header("location:".SITEURL."admin/manage-order.php");
                    }

                }
                else
                {
                    //Redirect
                    header("location:".SITEURL."admin/manage-order.php");
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Volume Name: </td>
                        <td><b><?php echo $manga; ?></b></td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td><b> R <?php echo $price; ?></b></td>
                    </tr>

                    <tr>
                        <td>Quantity: </td>
                        <td>
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                                <option <?php if($status=="Out For Delivery"){echo "selected";} ?> value="Out For Delivery">Out For Delivery</option>
                                <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                                <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name: </td>
                        <td>
                            <input type="text" name="cust_name" value="<?php echo $cust_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Contact: </td>
                        <td>
                            <input type="text" name="cust_contact" value="<?php echo $cust_contact; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Email: </td>
                        <td>
                            <input type="text" name="cust_email" value="<?php echo $cust_email; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Address: </td>
                        <td>
                            <textarea name="cust_address" cols="30" rows="5"><?php echo $cust_address; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            
                            <input type="submit" name="submit" class="btn btn-secondary" value="Update Order">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>

    <?php 
        if(isset($_POST['submit']))
        {
            //Get Details
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $price = mysqli_real_escape_string($conn,$_POST['price']);
            $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);

            $total = $price * $quantity; // total = price * quantitys

            $status = mysqli_real_escape_string($conn,$_POST['status']); //Order status 

            $cust_name = mysqli_real_escape_string($conn,$_POST['cust_name']);
            $cust_contact = mysqli_real_escape_string($conn,$_POST['cust_contact']);
            $cust_email = mysqli_real_escape_string($conn,$_POST['cust_email']);
            $cust_address = mysqli_real_escape_string($conn,$_POST['cust_address']);

            //Save Order in DB
            $sql2 = "UPDATE tbl_order SET
                quantity = $quantity,
                total = $total,
                status = '$status',
                cust_name = '$cust_name',
                cust_contact = '$cust_contact',
                cust_email = '$cust_email',
                cust_address = '$cust_address'
                WHERE id=$id
            ";

            //Execute
            $res2 = mysqli_query($conn, $sql2);

            if($res2==TRUE)
            {
                //Order Sent
                $_SESSION['order'] = "<div class='success'>Order Updated</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else
            {
                //Order Failed
                $_SESSION['order'] = "<div class='error'>Order Update Failed</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }
    ?>
<?php include("partials/footer.php"); ?>