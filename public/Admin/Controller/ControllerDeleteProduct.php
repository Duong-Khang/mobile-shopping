<?php

    include "../connect.php";

    include "../Model/ModelDeleteProduct.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    $color = isset($_GET['color'])?$_GET['color']:'';

    $de = new DeleteProduct();

    $de->removeProduct('cart_item_admin', $conn, $customer, $pid, $color);

?>