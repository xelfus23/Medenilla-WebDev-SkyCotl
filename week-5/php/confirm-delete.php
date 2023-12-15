<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Deleted</title>
    <link rel="stylesheet" href="../css/gen.css">
    <link rel="stylesheet" href="../css/delete.css">
</head>
<body>
    <div class="bg"></div>
    <div class="container">
        <div class="form">
    
    <?php

        include "../php/database/database.php";
        include "../php/login-check.php"; 

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            if (isset($_POST["orderID"]) && !empty($_POST["orderID"])) {
                $orderID = $_POST["orderID"];

                try {
                    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("DELETE FROM orders WHERE orderID = :orderID");
                    $stmt->bindParam(':orderID', $orderID);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        echo "<div class ='success'>Order with ID $orderID has been deleted successfully.</div>";
                    } else {
                        echo "<div class ='error'>Invalid ID.</div>";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } 
            else {
                echo "Please provide the Order ID.";
            }
            $conn = null;
        }

    ?>
        <a class="btn-1" href="../pages/delete.php">Return</a>
        </div>
    </div>
</body>
</html>