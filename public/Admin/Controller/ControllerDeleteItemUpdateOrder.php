<?php

    include "../connect.php";

    include "../Model/ModelDeleteItemUpdateOrder.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $oid = isset($_GET['oid'])?$_GET['oid']:'';
    $color = isset($_GET['color'])?$_GET['color']:'';
    $total_quantity = isset($_GET['total_quantity'])?$_GET['total_quantity']:'';
    $total = isset($_GET['total'])?$_GET['total']:'';

    $de = new DeleteItemUpdateOrder();

    $de->remove('order_items', $conn, $pid, $oid, $color);

?>