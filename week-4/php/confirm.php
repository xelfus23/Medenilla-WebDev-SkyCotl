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
    <div class="container">

        <div class="delete">    
            <form action="delete-confirm.php" method="POST">
                <div class="error">
                    These items will be deleted permanently.
                </div>
                <?php 
                    include "../php/database/database.php";

                    if($_SERVER["REQUEST_METHOD"] === "POST"){

                        if (isset($_POST["order_id"]) && !empty($_POST["order_id"])){
                            $orderID = $_POST["order_id"];
                            $name = $_POST['name'];

                            try{
                                $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username, $db_password);
                                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $stmt = $conn -> prepare("SELECT * FROM orders WHERE orderID = :orderID AND name = :name");
                                $stmt -> bindParam(':orderID', $orderID);
                                $stmt -> bindParam(':name', $name);
                                $stmt -> execute();
                                
                                if($stmt->rowCount() > 0){

                                    $sql = "SELECT * FROM orders WHERE id = $orderID AND name = '$name'";


                                    if($res == true){
                                    
                                        $count = mysqli_num_rows($res);
                                    
                                        if($count > 0){
                                            $rows = mysqli_fetch_assoc($res);

                                            $orderID = $rows['orderID'];
                                            $name = $rows['name'];
                                            $capeType = $rows['cape_type'];
                                            $size = $rows['size'];
                                            $total_price = $rows['total_price'];
                                            $instructions = $rows['instructions'];
                                            $instrumentType = $rows['instrument_type'];

                                            echo $orderID;
                                            echo $name;
                                        }
                                        else{
                                        echo "no data";
                                        }
                                    }
                                }
                                else{
                                    echo "<div class = 'error'>Invalid name or order ID. </div>";
                                }  
                            }
                            catch(PDOException $e){
                                echo "Error: " . $e->getMessage();
                            }
                        }
                        else{
                            echo "Please provide the Order ID";
                        }
                        $conn = null;
                    }
                ?>
                <div class="confirm">
                    <input class="btn-1" type="submit" value="Confirm" id ="submits" name="submit">
                    <a class="btn-1" href="../html/delete.html">Cancel</a>
                </div>

            </form>
            <a class="btn-1" href="../html/index.html">Go Back</a>
        </div>
    </div>
</body>
</html>
