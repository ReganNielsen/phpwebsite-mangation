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
            <h2 class="">Explore Mangas</h2>
            <div class="manga_block_items">
                <?php
                    //Display All Mangas
                    $sql = "SELECT * FROM tbl_manga WHERE stock = 'Yes'";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    //Check availablity
                    if ($count > 0)
                    {
                        //Manga
                        while ($row = mysqli_fetch_assoc($res))
                        {
                            //Values
                            $id = $row["id"];
                            $title = $row["title"];
                            $img_name = $row["img_name"];

                            ?>
                            <a class="manga_item manga_action" href="<?php echo SITEURL; ?>manga_search.php?manga_id=<?php echo $id; ?>">
                                    <?php
                                        if($img_name == "")
                                        {
                                            //!Image
                                            echo "<div class='error'>No Image</div>";
                
                                        }
                                        else
                                        {
                                            //Image
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/manga/<?php echo $img_name ?>">
                                            <?php
                                        }
                                    ?>
                                    <h3><?php echo $title; ?></h3>
                            </a>
                            <?php
                        }
                    }
                    else
                    {
                        //!Manga
                        echo "<div class='error'>No Manga</div>";
                    }

                ?>
            </div>
        </div>
    </div>
    </div>
</section>
    
<?php include('partials-front/footer.php'); ?>