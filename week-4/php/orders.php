<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="../css/order.css">
    <link rel="stylesheet" href="../css/gen.css">
</head>
<body>
    <div class="bg"></div>
    <?php 
        //display order summary function
        function displayOrderSummary(){

            if ($_SERVER["REQUEST_METHOD"] === "POST"){
                echo "<div class = 'Summary'>";
                echo "<h2> Order Summary</h2>">
                //cape price
                $cape_prices = [
                    "blue-cape" => 1000,
                    "red-cape" => 1000,
                    "green-cape" => 1000,
                    "yellow-cape" => 1000,
                    "white-cape" => 1500,
                    "black-cape" => 1500,
                ];
                //size price
                $size_prices = [
                    "chibi" => 0.00,
                    "normal" => 199.99,
                    "big" => 499.99,
                ];
                //instrument price
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
                //get the value from form
                $name = htmlspecialchars($_POST['name']);
                $capeType = htmlspecialchars($_POST["capes"]);
                $size = htmlspecialchars($_POST["sizes"]);
                $instructions = htmlspecialchars($_POST["instructions"]);

                $capeType = $_POST['capes'];
                $size = $_POST['sizes'];
                $instrumentType = isset($_POST["instruments"]) ? $_POST["instruments"] : [];
                
                //use the functions that I created bellow
                
                $total_price = calculateTotalPrice($cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType);

                displayOrderDetails($name, $cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType, $total_price);
                $receiptContent = generateReceiptContent($name, $capeType, $cape_prices, $size, $size_prices, $instrumentType, $instrument_prices, $total_price, $instructions);
                saveReceiptToFile($receiptContent);

                insertDataToDatabase($name, $capeType, $size, $total_price, $instructions, $instrumentType);
        
            }
        }
        //calculate total price function
        function calculateTotalPrice($cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType){
            //calculate the total price of cape price + sizes price + instrument
            $total_price = $cape_prices[$capeType] + $size_prices[$size];

            foreach ($instrumentType as $instrument) {
                $total_price += $instrument_prices[$instrument];
            }
            return $total_price;
        }
        //display order details function
        function displayOrderDetails($name, $cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType, $total_price){
            ?>
            <div class="container">
                
                <div class="result">
                    <h1 class="h1">Order Summary</h1>
                    <table>
                        <tr>
                            <td>
                                <h2>
                                    Name: 
                                </h2>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($name);?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>
                                    Cape type:
                                </h2>
                            </td>
                            <td>
                                <p>
                                    <?php echo htmlspecialchars($capeType);?>
                                     - ₱ 
                                     <?php echo number_format($cape_prices[$capeType], 2);?>
                                    </p>
                                </td>
                            </tr>
                        <tr>
                            <td>
                                <h2>
                                    Size:
                                </h2>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($size);?>
                                - ₱ 
                                <?php echo number_format($size_prices[$size], 2);?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>
                                    Instruments:
                                </h2>
                            </td>
                            <td>
                                <p>
                                    <?php
                                        if (!empty($instrumentType)){
                                            echo implode(", " , $instrumentType) . " - ₱ " . number_format(array_sum(array_intersect_key($instrument_prices, array_flip($instrumentType))), 2);
                                        }
                                    ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>
                                    Total Price:
                                </h2>
                            </td>
                            <td>
                                <p>
                                    <?php echo number_format($total_price, 2); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h2>
                                    Instructions:
                                </h2>
                            </td>
                            <td>
                                <p>
                                    <?php echo htmlspecialchars($_POST['instructions']); ?>
                                </p>
                            </td>
                        </tr>
                    </table>

                    
            <?php

        }

        function generateReceiptContent($name, $capeType, $cape_prices, $size, $size_prices, $instrumentType, $instrument_prices, $total_price, $instructions){
            $receiptContent = "Order Summary\n";
            $receiptContent .= "----------------------------\n";
            $receiptContent .= "Name: " . $name ."\n";
            $receiptContent .= "Cape Type: " . $capeType . " ₱- " . number_format($cape_prices[$capeType], 2). "\n";
            $receiptContent .= "Size: " . $size ." ₱- " . number_format($size_prices[$size], 2) . "\n";
            if (!empty($instrumentType)){
                $receiptContent .= "Instrument: " . implode(", " , $instrumentType) . " - ₱ " . number_format(array_sum(array_intersect_key($instrument_prices, array_flip($instrumentType))), 2) . "\n";
            }

            $receiptContent .= "Total Price: ₱" . number_format($total_price, 2) . "\n";
            $receiptContent .= "\n";
            $receiptContent .= "Thank you for your order!";

            return $receiptContent;
        }

        function saveReceiptToFile($receiptContent){
            $file = fopen("Sky online shop order summary.txt", "w") or die("Unable to open File!");

            fwrite($file, $receiptContent);
            fclose($file);

            echo "<div class = 'success'>Receipt crated successfully as Sky online shop order summary.txt!</div>";
        }


        displayOrderSummary();

        function insertDataToDatabase($name, $capeType, $size, $total_price, $instructions, $instrumentType){
            include ("../php/database/database.php");

            try{
                $conn = new PDO("mysql:host=$db_host; dbname=$db_name", $db_username, $db_password);

                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn -> prepare("INSERT INTO orders (name, cape_type, size, total_price, instructions, instrument_type)
                    VALUES (:name, :cape_type, :size, :total_price, :instructions, :instrument_type)");

                $extraString = implode(", ", $instrumentType);

                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':cape_type', $capeType);
                $stmt->bindParam(':size', $size);
                $stmt->bindParam(':total_price', $total_price);
                $stmt->bindParam(':instructions', $instructions);
                $stmt->bindParam(':instrument_type', $extraString);

                $stmt->execute();
                echo "<div class = 'success'>Order details inserted into the database successfully!</div>";
            }
            catch (PDOException $e){
                echo "Error:" . $e -> getMessage();
            }

        }
        $conn = null;
    ?>

                    <div class="button">
                        <form action="../html/shop.html">
                            <button class="btn-1" type="submit">Back to Shop</button>
                        </form>
                    </div>
                </div>
            </div>    
</body>
</html>