<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Update</title>
    <link rel="stylesheet" href="../css/gen.css">
    <link rel="stylesheet" href="../css/update.css">
</head>
<body>
    <div class="bg"></div>
    <div class="containers">
        <div class="confirm-boxs">
            <h1>Order Update</h1>
            <div class="before-after">

            <?php
                    include "../php/database/database.php";

                    $cape_prices = [
                        "blue-cape" => 1000,
                        "red-cape" => 1000,
                        "green-cape" => 1000,
                        "yellow-cape" => 1000,
                        "white-cape" => 1500,
                        "black-cape" => 1500,
                    ];

                    $size_prices = [
                        "chibi" => 0.00,
                        "normal" => 200.00,
                        "big" => 500.00,
                    ];

                    $instrument_prices = [
                        "guitar" => 2000.00,
                        "piano" => 1500.00,
                        "harp" =>  1500.00,
                        "xylophone" => 1500.00,
                        "saxophone" => 1500.00,
                        "drums" => 1500.00,
                        "horn" => 1000.00,
                        "kalimba" => 2000.00,
                        "flute" => 1500.00,
                        "contrabass" => 1000.00,
                    ];
                    

                    if($_SERVER["REQUEST_METHOD"] === "POST"){

                        $orderID = $_POST['orderID'];
                        $name = $_POST['name'];
                            
                        try{
                            $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username, $db_password);
                            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $conn -> prepare("SELECT * FROM orders WHERE orderID=:orderID AND name=:name");
                            $stmt -> bindParam(':orderID', $orderID);
                            $stmt -> bindParam(':name', $name);
                            $stmt -> execute();
                            $stmtt = $conn -> prepare("SELECT * FROM orders WHERE name = :name");
                                $stmtt -> bindParam(':name', $name);
                                $stmtt -> execute();

                                $resultt = $stmtt -> fetchAll();

                            $result = $stmt->fetch();

                            if($result){
                                

                                $capeType = isset($_POST['capes']) && $_POST["capes"] !== "" ? $_POST['capes'] : $result['cape_type'];
                                $size = isset($_POST['sizes']) && $_POST["sizes"] !== "" ? $_POST['sizes'] : $result['size'];
                                $instrumentType = isset($_POST['instruments']) && is_array($_POST['instruments']) ? $_POST['instruments'] : explode(", ",  $result['instrument_type']);
                                $instructions= isset($_POST['instructions']) && $_POST['instructions'] !== ""  ? $_POST['instructions'] : $result['instructions'];
                                
                                
                                $total_price = calculateTotalPrice($cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType);
                                

                                $updateStmt = $conn -> prepare("UPDATE orders SET cape_type = :capeType, size=:sizes, total_price = :total_price, instructions = :instructions, instrument_type = :instrumentType WHERE orderID = :orderID");
                                $updateStmt->execute(array(
                                    ':capeType' => $capeType,
                                    ':sizes' => $size,
                                    ':instrumentType' => implode(", ", $instrumentType),
                                    ':total_price' => $total_price,
                                    ':instructions' => $instructions,
                                    ':orderID' => $orderID
                                ));
                                $stmtt = $conn -> prepare("SELECT * FROM orders WHERE name = :name");
                                $stmtt -> bindParam(':name', $name);
                                $stmtt -> execute();

                                $resultt = $stmtt -> fetchAll();

                                if($resultt){
                                    foreach ($resultt as $result){
                                        echo "<table>

                                        <tr>
                                            <td>
                                                <h2>Name:</h2>
                                            </td>
                                            <td>" 
                                                . $result['name'] . 
                                            "</td>
                                        </tr>      
                                            
                                        <tr>
                                            <td>
                                                <h2>Cape Type:</h2>
                                            </td>
                                            <td>" 
                                                . $result['cape_type'] . 
                                            "</td>
                                        </tr> 

                                        <tr>
                                            <td>
                                                <h2>Size:</h2>
                                            </td>
                                            <td>" 
                                                . $result['size'] . 
                                            "</td>
                                        </tr> 

                                        <tr>
                                            <td>
                                                <h2>Total Price:</h2>
                                            </td>
                                            <td> ₱" 
                                                . number_format($result['total_price'], 2) . 
                                            "</td>
                                        </tr> 

                                        <tr>
                                            <td>
                                                <h2>Instructions:</h2>
                                            </td>
                                            <td class ='instruct'>" 
                                                . $result['instructions']  . 
                                            "</td>
                                        </tr> 

                                        <tr>
                                            <td>
                                                <h2>Name:</h2>
                                            </td>
                                            <td>" 
                                                . $result['name'] . 
                                            "</td>
                                        </tr> 

                                        <tr>
                                            <td>
                                                <h2>Instrument Type:</h2>
                                            </td>
                                            <td>" 
                                                . $result['instrument_type'] . 
                                            "</td>
                                        </tr> 
                                    </table>
                                    </div>";

                                    }
                                }

                                echo "<div class='success'>Order details updated successfully.</div>";
                                
                            }   
                                else{
                                echo "<div class ='error'>Invalid Name or Order ID.</div>";
                            }
                        }
                        catch(PDOException $e){
                            echo "Error: " . $e->getMessage();
                        }

                        $conn = null;
                    }

                    function calculateTotalPrice($cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType){
                        $total_price = $cape_prices[$capeType] + $size_prices[$size];

                        foreach($instrumentType as $instrument){
                            $total_price += $instrument_prices[$instrument];
                        }
                        return $total_price;
                    }
                ?>
                <a class="btn-1" href="../pages/update.php">Return</a>
        </div>
    </div>
</body>
</html>
