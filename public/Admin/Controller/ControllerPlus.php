<?php

    include "../connect.php";

    include "../Model/ModelPlus.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    $color = isset($_GET['color'])?$_GET['color']:'';

    $plus = new PlusProduct();

    $plus->plusProduct('cart_item_admin', $conn, $customer, $pid, $color);

?>