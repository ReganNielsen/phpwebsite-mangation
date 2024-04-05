<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Order</h1>
                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <br><br>

                <table class="tbl">
                    <tr>
                        <th>S.N.</th>
                        <th>Manga</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Cust Name</th>
                        <th>Cust Contact</th>
                        <th>Cust Email</th>
                        <th>Cust Address</th>
                        <th>Actions</th>

                    </tr>

                    <?php 
                        //retrieve all data from order table in sql db
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //Latest order -> First
                        //Execute query
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        if($count > 0)
                        {
                            //Order Available
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $manga = $row['manga'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $cust_name = $row['cust_name'];
                                $cust_contact = $row['cust_contact'];
                                $cust_email = $row['cust_email'];
                                $cust_address = $row['cust_address'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $manga; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php
                                                //Ordered / Out For Delivery / Delivered / Cancelled
                                                if($status == 'Ordered')
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif ($status == "Out For Delivery")
                                                {
                                                    echo "<label style='color: aqua;'>$status</label>";
                                                }
                                                elseif ($status == "Delivered")
                                                {
                                                    echo "<label style='color: lightgreen;'>$status</label>";
                                                }
                                                elseif ($status == "Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $cust_name; ?></td>
                                        <td><?php echo $cust_contact; ?></td>
                                        <td><?php echo $cust_email; ?></td>
                                        <td><?php echo $cust_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='12' class='error'>No Orders</td></tr>";
                        }
                                    //Display values in table
                                    ?>
                </table>
            </div>
        </div>

<?php include('partials/footer.php'); ?>