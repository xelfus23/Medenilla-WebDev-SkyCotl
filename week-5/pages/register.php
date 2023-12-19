<?php 
    include "../php/database/database.php";
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
                    if(isset($_SESSION['register'])){
                        echo $_SESSION['register'];
                        unset($_SESSION['register']);
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

        if($password != '' && $password != '' && $con_pass != '' && $email != ''){

            if($password == $con_pass){
                try{
                    $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username, $db_password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                    $checkregistered = $conn->prepare("SELECT * FROM users WHERE username = :username");
                    $checkregistered->bindParam(':username', $username);
                    $checkregistered->execute();
        
                    if($checkregistered->rowCount() > 0){
                        $_SESSION['register'] = "<div class = 'error'>Username already exists.</div>";
                        header("Location: ../pages/register.php");
                    }
                    else{
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
                        $insertregistered = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
                        $insertregistered->bindParam(':username', $username);
                        $insertregistered->bindParam(':password', $hashedPassword);
                        $insertregistered->bindParam(':email', $email);
                        $insertregistered->execute();
        
                        $_SESSION['register'] ="<div class ='success'> Registered Successfully.</div>";
                        header("Location: ../pages/login.php");
                    }
        
                }
                catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
                }
            }
            else{
                $_SESSION['register'] = "<div class = 'error'>Password don't match.</div>";
                header("Location: ../pages/register.php");
            }
        }
        else{
            $_SESSION['register'] = "<div class = 'error'>Fill the blank.</div>";
        }
    }
?>
