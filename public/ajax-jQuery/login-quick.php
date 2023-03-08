<?php

    include "connect.php";

    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['username'] = $username;
        echo $username;
    }else{
        echo "error";
    }

?>