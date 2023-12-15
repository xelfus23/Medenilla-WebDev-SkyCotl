<?php
include "../php/database/database.php"; 
include "../php/login-check.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Orders</title>
    <link rel="stylesheet" href="../css/delete.css">
    <link rel="stylesheet" href="../css/gen.css">
</head>
<body>
    <div class="bg"></div>
    <div class="container">
        <div class="delete">
            <form class="form" method="POST" action="../php/delete.php">
                <div class="id">
                    <h1>Delete Order</h1>
                    <div class="name">
                        <label for="orderID">Name:</label>
                        <input type="text" id="name" name="name" autocomplete="off" required>
                    </div>
                    <div class="ids">
                        <label for="order_id">Order ID:</label>
                        <input type="text" id="orderID" name="orderID" autocomplete="off" required>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Delete" class="btn-1">
                    <a class="btn-1" href="../pages/menu.php">Return</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>