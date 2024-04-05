<?php 
    include('../config/constant.php');
    include('auth.php');
?>

<html> 
    <head>
        <title>Manga website - home page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    <header>
        <h1>Admin section</h1>
    </header>
        <div class="menu">
            <nav>
                <a href="admin.php">Home</a>
                <a href="manage-admin.php">Admin</a>
                <a href="manage-manga.php">Manga</a>
                <a href="manage-volume.php">Volume</a>
                <a href="manage-order.php">Orders</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>