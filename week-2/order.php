<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
        <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                echo "<div class='summary'>";
                echo "<h2>📝 Order Summary</h2>";

                $cape_prices = [
                    "red-cape" => 1000,
                    "blue-cape" => 1000,
                    "green-cape" => 1000,
                    "yellow-cape" => 1000,
                ];

                $size_prices = [
                    "small" => 0.00,
                    "medium" => 100.0,
                    "large" => 200.0,
                ];

                $candle_prices = [
                    "ten" => 9.99,
                    "twenty" => 19.99,
                    "thirty" => 29.99,
                ];

                $capeType = $_POST["cape"];
                $size = $_POST["size"];

                $candles = isset($_POST["candles"]) ? $_POST["candles"] : [];

                $total_price = $cape_prices[$capeType] + $size_prices[$size];

                foreach ($candles as $candle) {
                    $total_price += $candle_prices[$candle];
                }

                echo "<table>";

                echo "<tr><td>Name</td><td>" . htmlspecialchars($_POST["name"]) . "</td></tr>";

                echo "<tr><td>Cape Type</td><td>" . htmlspecialchars($_POST["cape"]) . " (₱" . number_format($cape_prices[$capeType], 2) . ")</td></tr>";

                echo "<tr><td>Size</td><td>" . htmlspecialchars($_POST["size"]) . " (₱" . number_format($size_prices[$size], 2) . ")</td></tr>";

                if (!empty($extras)) {
                    echo "<tr><td>Extras:</td><td>" . implode(", ", $candles) . " (₱" . number_format(array_sum(array_intersect_key($candle_prices, array_flip($candles))), 2) . ")</td></tr>";
                }

                echo "<tr><td>Total Price</td><td>₱" . number_format($total_price, 2) . "</td></tr>";
                echo "<tr><td>Special Instructions</td><td>" . htmlspecialchars($_POST["instructions"]) . "</td></tr>";

                echo "</table>";

                if ($capeType == "red-cape") {
                    echo "Hey, " . htmlspecialchars($_POST["name"]);
                    echo "<p>You chose color red</p>";
                }
                elseif($capeType == "blue-cape"){
                    echo "Hey, " . htmlspecialchars($_POST["name"]);
                    echo "<p>You chose color blue</p>";
                }
                elseif($capeType == "green-cape"){
                    echo "Hey, " . htmlspecialchars($_POST["name"]);
                    echo "<p>You chose color Green</p>";
                }
                elseif($capeType == "yellow-cape"){
                    echo "Hey, " . htmlspecialchars($_POST["name"]);
                    echo "<p>You chose color Yellow</p>";
                }
                

                if ($total_price >= 1200) {
                    echo "<p>You got free 4 candles.</p>";
                }
                elseif ($total_price >= 1100) {
                    echo "<p>You got free 2 candles.</p>";
                }
                elseif ($total_price >= 1000) {
                    echo "";
                } 
                
                echo "</div>";
            }

        ?>
        <form action="index.html">
            <input class="btn" type="submit" value="Go Back">
        </form>
</body>
</html>