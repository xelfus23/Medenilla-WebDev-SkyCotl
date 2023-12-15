<?php 

    try{
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM orders");
        $stmt->execute();

        $results = $stmt->fetchAll();
        $number = 0;

        
            foreach ($results as $result) {

                $number++;
                echo "<tr>";
                echo "<td><div id = '" . $result['name'] . "'>" . $number . "<div></td>";
                echo "<td>" . $result['name'] . "</td>";
                echo "<td>" . $result['orderID'] . "</td>";
                echo "<td>" . $result['cape_type'] . "</td>";
                echo "<td>" . $result['size'] . "</td>";
                echo "<td>₱" . number_format($result['total_price'], 2) . "</td>";
                echo "<td>" . $result['instrument_type'] . "</td>";
                echo "<td>" . $result['instructions'] . "</td>";
                echo "</tr>";
            }
            if($number == 0){
                echo "<div class ='error'>No Orders Found.</div><br>" ;
            }
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
    $conn = null;
?>