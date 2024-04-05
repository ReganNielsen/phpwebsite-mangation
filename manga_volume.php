<?php include('partials-front/menu.php'); ?>

<section>
    <div class="search">
        <form action="<?php echo SITEURL; ?>manga_volume_search.php" method="POST">
            <input type="search" name="search" placeholder="Search For Manga..." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<section>
    <div class="container">
    <div class="product_manga_volume">
    <div class="manga_block">
            <h2>Volumes</h2>

            <div class="manga_block_items">
            <?php

                //Display Volumes
                $sql = "SELECT * FROM tbl_manga_volumes WHERE stock='Yes'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count>0)
                {
                    //Volumes
                    while ($row = mysqli_fetch_assoc($res))
                    {
                        //Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $img_name = $row['img_name'];
                        ?>

                        <div class="manga_item">
                            <?php
                                if ($img_name == '')
                                {
                                    //!Image
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                    //Image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/volume/<?php echo $img_name ?>">
                                    <?php
                                }
                            ?>
                            <div>
                                <h2><?php echo $title; ?></h2>
                                <p><?php echo $description; ?></p>
                                <p>R <?php echo $price; ?></p>
                                <a class="order_button" href="<?php echo SITEURL; ?>order.php?manga_id=<?php echo $id; ?>" class="">Order</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //!Volumes
                    echo"<div class='error'>Volumes Not Added</div>";
                }

            ?>
            </div>
        </div>
    </div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>