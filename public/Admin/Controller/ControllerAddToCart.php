<?php

    include "../connect.php";

    include "../Model/ModelAddToCart.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $color = isset($_GET['color'])?$_GET['color']:'';
    $customer = isset($_GET['customer'])?$_GET['customer']:'';

    $add = new AddToCart();

    $add->addToCart('cart_item_admin', $conn, $pid, $customer, $color);

?>