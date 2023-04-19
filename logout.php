<?php
    session_start();
    $current_url = $_SESSION['current_url']; 
    session_unset();
    session_destroy();
    setcookie('username', '', time() - 3600, '/');
    setcookie('password', '', time() - 3600, '/');
    header('Location: '.$current_url); 
    exit();
?>
