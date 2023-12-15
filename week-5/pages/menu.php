<?php
    include("../php/database/database.php");
    include ("../php/login-check.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/gen.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="bg"></div>
    <div class="container-index">
        

        <div class="option">

            <a href="show.php">
                Show Orders
            </a>
            <a href="update.php">
                Update Orders
            </a>
            <a href="delete.php">
                Delete Orders
            </a>
            <a href="shop.php">
                Add orders
            </a>
            <a href="logout.php">
                Logout
            </a>
        </div>

    </div>
</body>
</html>