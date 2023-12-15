<?php 
    if(!isset($_SESSION['username'])){
        $_SESSION['log-check'] = "<div class = 'error'> Please log in.</div>";
        header('Location: ../pages/login.php');
    }
?>