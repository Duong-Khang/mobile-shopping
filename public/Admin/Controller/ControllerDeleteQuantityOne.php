<?php

    include "../connect.php";

    include "../Model/ModelDeleteQuantityOne.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    $color = isset($_GET['color'])?$_GET['color']:'';

    $de = new DeleteQuantityOne();

    $de->removeQuantityOne('cart_item_admin', $conn, $customer, $pid, $color);

?>