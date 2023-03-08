<?php

    include "../connect.php";
    include "../Model/ModelUpdateInfoUser.php";

    $uid = isset($_GET['uid'])?$_GET['uid']:'';
    $username = isset($_GET['username'])?$_GET['username']:'';
    $password = isset($_GET['password'])?$_GET['password']:'';
    $status = isset($_GET['status'])?$_GET['status']:'';

    $update = new UpdateInfoUser();

    $update->updateInfoUser('user', $conn, $uid, $username, $password, $status);

?>