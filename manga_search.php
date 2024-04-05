<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_GET['manga_id']))
    {
        //Retrieved ID
        $manga_id = $_GET['manga_id'];
        //Manga = manga_id
        $sql = "SELECT title FROM tbl_manga WHERE id=$manga_id";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $manga_title = $row["title"];
    }
    else
    {
        //!ID -> Redirect
        header('location:'.SITEURL.'home.php');
    }
?>

<section>
    <div class="volume_title">
        <!-- Searched Manga + Manga Volumes -->
        <h2>Volumes on <a href="#">"<?php echo $manga_title; ?>"</a></h2>
    </div>
</section>

<section>
    <div class="container">
    <div class="product_manga_volume">
        <div class="manga_block">
            <h2>Volumes</h2>

            <div class="manga_block_items">
            <?php
                //SQL query
                $sql2 = "SELECT * FROM tbl_manga_volumes WHERE manga_id = $manga_id ";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if ($count2>0)
                {
                    //Volumes
                    while ($row2 = mysqli_fetch_assoc($res2))
                    {
                        //Values
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $description = $row2['description'];
                        $price = $row2['price'];
                        $img_name = $row2['img_name'];
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
                    echo"<div class='error'>No Volumes Available</div>";
                }

            ?>
            </div>
        </div>
    </div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>