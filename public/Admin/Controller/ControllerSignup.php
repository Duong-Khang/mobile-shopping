<?php
    ob_start();
    session_start();
    include "../connect.php";

    include "../Model/ModelSignin.php";
    include "../Model/ModelSignup.php";

    $username = isset($_POST['username'])?$_POST['username']:false;
    $password = isset($_POST['password'])?$_POST['password']:false;

    $username = trim($username);  
    $username= stripslashes($username);  
    $username = htmlspecialchars($username); 
    $username = $conn->real_escape_string($username);

    $password = trim($password);  
    $password= stripslashes($password);  
    $password = htmlspecialchars($password);
    $password = $conn->real_escape_string($password);

    $acc = new Signup($username, $password);

    $acc->signupAccount($conn, 'tb_admin');
    ob_flush();
?>