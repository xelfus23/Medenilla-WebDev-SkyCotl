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
    <?php 
        function displayOrderSummary(){

            if ($_SERVER["REQUEST_METHOD"] === "POST"){
                echo "<div class = 'Summary'>";
                echo "<h2> Order Summary</h2>">

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
                    "normal" => 199.99,
                    "big" => 499.99,
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

                $name = htmlspecialchars($_POST['name']);
                $capeType = htmlspecialchars($_POST["capes"]);
                $size = htmlspecialchars($_POST["sizes"]);
                $instructions = htmlspecialchars($_POST["instructions"]);

                $capeType = $_POST['capes'];
                $size = $_POST['sizes'];
                $instrumentType = isset($_POST["instruments"]) ? $_POST["instruments"] : [];

                $total_price = calculateTotalPrice($cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType);

                displayOrderDetails($name, $cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType, $total_price);
                $receiptContent = generateReceiptContent($name, $capeType, $cape_prices, $size, $size_prices, $instrumentType, $instrument_prices, $total_price, $instructions);
                saveReceiptToFile($receiptContent);

                insertDataToDatabase($name, $capeType, $size, $total_price, $instructions, $instrumentType);
        
            }
        }

        function calculateTotalPrice($cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType){
            
            $total_price = $cape_prices[$capeType] + $size_prices[$size];

            foreach ($instrumentType as $instrument) {
                $total_price += $instrument_prices[$instrument];
            }
            return $total_price;
        }

        function displayOrderDetails($name, $cape_prices, $size_prices, $instrument_prices, $capeType, $size, $instrumentType, $total_price){
            ?>
            <div class="container">
                
                <div class="result">
                    <h1>Order Summary</h1>
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
            $receiptContent .= "-------------\n";
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

            echo "Receipt crated successfully as Sky online shop order summary.txt!";
        }


        displayOrderSummary();

    ?>

                    <div class="button">
                        <form action="../html/index.html">
                            <button class="btn-1" type="submit">Back to Shop</button>
                        </form>
                    </div>
                </div>
            </div>    
</body>
</html>
