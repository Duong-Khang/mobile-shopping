<?php

    include "../connect.php";

    include "../Model/ModelUpdateTotalProduct.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    $color = isset($_GET['color'])?$_GET['color']:'';

    $up = new UpdateTotalProduct();

    $up->updateTotalProduct('cart_item_admin', $conn, $customer, $pid, $color);

?>