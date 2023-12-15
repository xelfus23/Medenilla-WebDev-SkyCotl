<?php 
//check if the user is logged in if not they will redirect to login.php
    if(!isset($_SESSION['username'])){
        $_SESSION['log-check'] = "<div class = 'error'> Please log in.</div>";
        header('Location: ../pages/login.php');
    }
?>
