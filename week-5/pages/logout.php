<?php 
    include('../php/database/database.php');
    $_SESSION = array();
    session_destroy();
    header("Location: ../pages/index.php");
?>