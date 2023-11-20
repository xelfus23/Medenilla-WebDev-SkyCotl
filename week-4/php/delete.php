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

                    if($_SERVER["REQUEST_METHOD"] === "POST"){

                        if (isset($_POST["orderID"]) && !empty($_POST["orderID"])){
                            $orderID = $_POST["orderID"];
                            $name = $_POST['name'];

                            try{
                                $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username, $db_password);
                                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $stmt = $conn -> prepare("SELECT * FROM orders WHERE orderID = :orderID AND name = :name");
                                $stmt -> bindParam(':orderID', $orderID);
                                $stmt -> bindParam(':name', $name);
                                $stmt -> execute();

                                $results = $stmt->fetchAll();

                                if($results){
                                    foreach ($results as $result) {

                                        echo   "<form action='confirm-delete.php' method='POST'>
                                                <div class='confirm-id'>
                                                    <label for= 'orderID'>Confirm ID: </label>
                                                    <input type='text' autocomplete='off' name='orderID' id='orderID' required>
                                                </div>
                                                <table>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Name</th>
                                                        <th>Cape Type</th>
                                                        <th>Size</th>
                                                        <th>Total Price</th>
                                                        <th>Instrument</th>
                                                        <th>Instructions</th>
                                                    </tr>
                                                    <tr>
                                                ";
                                            echo "<td>" . $result['orderID'] . "</td>";
                                            echo "<td>" . $result['name'] . "</td>";
                                            echo "<td>" . $result['cape_type'] . "</td>";
                                            echo "<td>" . $result['size'] . "</td>";
                                            echo "<td>₱" . number_format($result['total_price'], 2) . "</td>";
                                            echo "<td>" . $result['instrument_type'] . "</td>";
                                            echo "<td>" . $result['instructions'] . "</td>";
                                            echo "</tr>";
                                            echo "</table>";
    
                                            echo "
                                                    <div class ='ask'>
                                                        <p class='error'>These items will be deleted permanently.</p>
                                                    </div>
    
                                                    <div class='confirm'>
                                                        <input class='btn-1' type='submit' value='Confirm' name='submit'>
                                                    ";
                                    }
                                }
                                else{
                                    echo "<div class='error'> Invalid Order ID or Name. </div>";
                                }
                            } 
                            catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                        } 
                        $conn = null;
                    } 
                ?>
                
                <a class="btn-1" href="../html/delete.html">Return</a>
            </div>
        </div>
    </body>
</html>