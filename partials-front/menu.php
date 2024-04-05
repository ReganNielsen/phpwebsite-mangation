<?php 
    include("config/constant.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Online Store</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header class="menu_header">
        <h1>Welcome to Mangation</h1>
    </header>
    <nav>
        <a href="<?php echo SITEURL; ?>home.php">Home</a>
        <a href="<?php echo SITEURL; ?>manga.php">Manga</a>
        <a href="<?php echo SITEURL; ?>manga_volume.php">Volumes</a>
    </nav>