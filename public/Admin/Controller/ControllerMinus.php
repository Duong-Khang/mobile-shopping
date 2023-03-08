<?php

    include "../connect.php";

    include "../Model/ModelMinus.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    $color = isset($_GET['color'])?$_GET['color']:'';

    $minus = new MinusProduct();

    $minus->minusProduct('cart_item_admin', $conn, $customer, $pid, $color);

?>