<?php

    include "../connect.php";
    include "../Model/ModelUpdateOrder.php";

    $oid = isset($_GET['oid'])?$_GET['oid']:'';
    $statusXuLy = isset($_GET['statusXuLy'])?$_GET['statusXuLy']:'';
    $statusHuy = isset($_GET['statusHuy'])?$_GET['statusHuy']:'';
    $delivery_date = isset($_GET['delivery_date'])?$_GET['delivery_date']:'';

    $update = new UpdateOrder();

    $update->updateOrder('order_details', $conn, $oid, $statusXuLy, $statusHuy, $delivery_date);

?>