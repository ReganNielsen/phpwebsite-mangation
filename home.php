<?php include ('partials-front/menu.php'); ?>

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

<section>
    <div class="container">
        <div class="product_home">
            <div class="product_info">
                <h1>MANGATION</h1>
                <p>
                Welcome to Mangation, your ultimate destination for manga enthusiasts in South Africa! 
                Nestled in the heart of Cape Town, 
                we take pride in being your premier source for the captivating world of manga, 
                imported directly from Japan and beyond.
                </p>
                <br>
                <p>
                Our commitment to authenticity means that each manga volume you find at our store is carefully 
                sourced from reputable publishers and distributors in Japan. 
                From popular Shonen Jump titles to heartwarming Shojo romances, and everything in between, 
                we've got you covered.
                </p>
            </div>

            <div class="manga_block">
                <h2>Top Manga This Week!</h2>

                <div class="manga_block_items">
                <?php
                //Display manga from db -> sql query
                $sql = "SELECT * FROM tbl_manga WHERE stock = 'Yes' AND featured = 'Yes' LIMIT 3";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res); //Count rows -> Manga present
                
                if ($count > 0) {
                    //Manga
                    while ($row = mysqli_fetch_array($res)) {
                        //Get Values
                        $id = $row["id"];
                        $title = $row["title"];
                        $img_name = $row["img_name"];
                        ?>
                        <a class="manga_item manga_action" href="<?php echo SITEURL; ?>manga_search.php?manga_id=<?php echo $id; ?>">
                            <?php
                            if ($img_name == "") {
                                //!Image
                                echo "<div class='error'>Image Not Available</div>";
                            } else {
                                //Image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/manga/<?php echo $img_name ?>">
                                <?php
                            }
                            ?>

                            <h3 class="">
                                <?php echo $title; ?>
                            </h3>
                        </a>
                        <?php
                    }
                } else {
                    //!Manga
                    echo "<div class='error'>Manga Not Added</div>";
                }
                ?>
                </div>

            </div>
            <a class="all_manga" href="manga.php">Check Out All Our Manga</a>
        </div>
    </div>
</section>



<?php include ('partials-front/footer.php'); ?>