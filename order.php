<?php include('partials-front/menu.php'); ?>

<?php
    //Check ID
    if(isset($_GET['manga_id']))
    {
        //Food ID
        $manga_id = $_GET['manga_id'];

        $sql = "SELECT * FROM tbl_manga_volumes WHERE id=$manga_id";

        $res = mysqli_query($conn, $sql);
        
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            //Data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $img_name = $row['img_name'];
        }
        else
        {
            //!Data
            header('location:'.SITEURL.'home.php');
        }
    }
    else
    {
        //!Food ID
        header('location:'.SITEURL.'home.php');
    }
?>

<section>
<div class="container">
        <div class="product_order">
        <h1>Fill The Form To Confirm Order</h1>
        <form action="" method="POST">
            <fieldset>
                <legend>Order Info</legend>

                <div>
                    <?php
                        if($img_name=='')
                        {
                            //!Image
                            echo "<div class='error'>Image Not Available</div>";
                        }
                        else
                        {
                            //Image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/volume/<?php echo $img_name; ?>" alt="Product Image" width="200px">
                            <?php
                        }
                    ?>
                    <div class="order_inputs">
                        <h2><?php echo $title; ?></h2>
                        <input type="hidden" name="manga" value='<?php echo $title; ?>'>

                        <p><?php echo $price; ?></p>
                        <input type="hidden" name="price" value='<?php echo $price; ?>'>

                        <p>Quantity</p>
                        <input type="number" name="quantity" value="1" required>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Detail</legend>

                <p>Full Name</p>
                <input type="text" name="full-name" placeholder="E.g. Bob Builder" class="" required>

                <p>Phone Number</p>
                <input type="text" name="contact" placeholder="E.g. 011 111 1111" class="" required>

                <p>Email</p>
                <input type="text" name="email" placeholder="E.g. Bob14@gmail.com" class="" required>

                <p>Address</p>
                <textarea name="address" rows="10" placeholder="E.g. no. 12, Builders Warehouse" class="" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
            //Check submit clicked
            if(isset($_POST['submit']))
            {
                //Get Details
                $manga = $_POST['manga'];
                $price = $_POST['price'];
                $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

                $total = $price * $quantity; // total = price * quantity

                $order_date = date('Y-m-d H:i:sa'); //Order date

                $status = "Ordered"; //Order status 

                $cust_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                $cust_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                $cust_email = mysqli_real_escape_string($conn, $_POST['email']);
                $cust_address = mysqli_real_escape_string($conn, $_POST['address']);

                //Save Order in DB
                $sql2 = "INSERT INTO tbl_order SET
                    manga = '$manga',
                    price = $price,
                    quantity = $quantity,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    cust_name = '$cust_name',
                    cust_contact = '$cust_contact',
                    cust_email = '$cust_email',
                    cust_address = '$cust_address'
                ";

                //Execute
                $res2 = mysqli_query($conn, $sql2);

                if($res2==TRUE)
                {
                    //Order Sent
                    $_SESSION['order'] = "<div class='success text-center'>Order Sent</div>";
                    header('location:'.SITEURL.'home.php');
                }
                else
                {
                    //Order Failed
                    $_SESSION['order'] = "<div class='error text-center'>Order Failed</div>";
                    header('location:'.SITEURL.'home.php');
                }

            }
        ?>

    </div>
</div>
</section>
<?php include('partials-front/footer.php'); ?>