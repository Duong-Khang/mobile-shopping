<?php

    include "../connect.php";
    include "../Model/ModelAddCustomer.php";

    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';

    $add = new AddCustomer();

    $add->addUser('user', $conn, $username, $password);
