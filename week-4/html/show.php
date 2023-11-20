<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order details</title>
    <link rel="stylesheet" href="../css/gen.css">
    <link rel="stylesheet" href="../css/show.css">
</head>
<body>
    <div class="bg"></div>
    <div class="container-show">
        
        <div class="box-show">
            
            <div class="top">
                <h1>Order details</h1>
                <div class="r-top">
                    <a class="btn-1" href="../html/index.html">Back</a> 
                </div>
            </div>

            <a class="to-top" href="#"></a>

            <table>
                <tr>
                    <th>Count</th>
                    <th>Name</th>
                    <th>Order ID</th>
                    <th>Cape Type</th>
                    <th>Size</th>
                    <th>Total Price</th>
                    <th>Instrument</th>
                    <th>Instructions</th>
                    
                </tr>
                <?php include '../php/order-details.php'; ?>
        </div>
    </div>
</body>
</html>