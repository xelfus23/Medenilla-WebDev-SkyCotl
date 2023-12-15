<?php 
    include "../php/database/database.php";
    include "../php/login-check.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/gen.css">
</head>
<body>
    <div class="login">
        <form method="post">
            <div class="back">
                <a href="login.php">Back</a>
            </div>
            <div class="user-input">
                <label for="name">Username</label>
                <input type="text" name="username" id="name" autocomplete="off" >
                <label for="email">Email</label>
                <input type="email" name="email" id="email" autocomplete="off" >
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <label for="password">Confirm Password</label>
                <input type="password" name="confirm-password" id="password">
            </div>
            <div class="err">
                <?php 
                    if(isset($_SESSION['done'])){
                        echo $_SESSION['done'];
                        unset($_SESSION['done']);
                    }
                ?>
            </div>
            <div class="btn">
                <input class="btn-1" type="submit" name="register" value="Register">
            </div>
        </form>
    </div>
</body>
</html>

<?php 

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $con_pass = $_POST['confirm-password'];
        $email = $_POST['email'];

        
    }
?>