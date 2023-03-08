<?php

    include "../connect.php";

    include "../Model/ModelAddOrderFinish.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    $fullname = isset($_GET['fullname'])?$_GET['fullname']:'';
    $email = isset($_GET['email'])?$_GET['email']:'';
    $phone = isset($_GET['phone'])?$_GET['phone']:'';
    $address = isset($_GET['address'])?$_GET['address']:'';
    $total = isset($_GET['total'])?$_GET['total']:'';
    $spend = isset($_GET['spend'])?$_GET['spend']:'';

    $add = new AddOrderFinish();

    $add->addOrder('order_details', $conn, $customer, $fullname, $email, $phone, $address, $total, $spend);

?>