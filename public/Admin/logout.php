<?php
    ob_start();
    session_start();
    if(isset($_SESSION['username'])){
        session_unset();
        session_destroy();
    }

    if(isset($_COOKIE['username'])){
        $username = $_COOKIE['username'];
        setcookie("username", $username, time() - 3600);
        header("location: ../Admin/login-admin.php");
    }
    ob_flush();
