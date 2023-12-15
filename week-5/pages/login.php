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
                <a href="index.php">Back</a>
            </div>
            <div class="user-input">
                <label for="name">Username</label>
                <input type="text" name="username" id="name" autocomplete="off">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="err">
                <?php 
                    if(isset($_SESSION['invalid'])){
                        echo $_SESSION['invalid'];
                        unset($_SESSION['invalid']);
                    }
                    if(isset($_SESSION['register'])){
                        echo $_SESSION['register'];
                        unset($_SESSION['register']);
                    }
                    if(isset($_SESSION['log-check'])){
                        echo $_SESSION['log-check'];
                        unset($_SESSION['log-check']);
                    }
                ?>
            </div>
            <div class="reg">
                <p>Don't have an account yet? <a style="opacity: 1; text-decoration:underline;" href="register.php"> Register now!</a></p>
            </div>
            <div class="btn">
                <input class="btn-1" type="submit" name="login" value="Login">
            </div>
        </form>
    </div>
</body>
</html>

<?php 

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        try{
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $checkusername = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $checkusername->bindParam(':username', $username);
            $checkusername->execute();
            if($checkusername->rowCount() > 0){
                $user = $checkusername->fetch(PDO::FETCH_ASSOC);

                if(password_verify($password, $user['password'])){
                    $_SESSION['username'] = $username;
                    header("location: ../pages/menu.php");
                }
                else{
                    $_SESSION['invalid'] = "<div class = 'error'>Invalid username or password.</div>";
                    header("location: ../pages/login.php");
                }
            }
            else{
                $_SESSION['invalid'] = "<div class = 'error'>User does not exist.</div>";
                header("location: ../pages/login.php");
            }
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
?>