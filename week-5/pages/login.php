<?php  
    include "../php/database/database.php"; //include this because we need to start session and we need the variables too
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
        <!--Form starts -->
        <form method="post">
            <div class="back">
                <a href="index.php">Back</a>
            </div>
            <div class="user-input">
                <!--Username-->
                <label for="name">Username</label>
                <input type="text" name="username" id="name" autocomplete="off">
                <!--Password-->
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="err">
                <!--Sessions this will show when we submit-->
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
                        <!--Register button-->
                <p>Don't have an account yet? <a style="opacity: 1; text-decoration:underline;" href="register.php"> Register now!</a></p>
            </div>
            <div class="btn">
                <!--Submit Button-->
                <input class="btn-1" type="submit" name="login" value="Login">
            </div>
        </form>
        <!-- Form ends -->
    </div>
</body>
</html>
<!--Start PHP-->
<?php 
//if request post
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        //store data from form to variable
        $username = $_POST['username'];
        $password = $_POST['password'];

        try{
            //connect database
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //sql query
            $checkusername = $conn->prepare("SELECT * FROM users WHERE username = :username");
            //bind parameters
            $checkusername->bindParam(':username', $username);
            //execute
            $checkusername->execute();

            //check if we can find the username in our database
            if($checkusername->rowCount() > 0){
                $user = $checkusername->fetch(PDO::FETCH_ASSOC);
                //if we found the username from our databse now we need to verify if the password match with the username we submit
                if(password_verify($password, $user['password'])){
                    $_SESSION['username'] = $username; //add session to use this to check if we logged in or not
                    header("location: ../pages/menu.php"); //redirect to menu
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
