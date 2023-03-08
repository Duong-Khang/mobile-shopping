<?php

    include "../connect.php";

    include "../Model/ModelDeleteOrder.php";

    $order_id = isset($_GET['order_id'])?$_GET['order_id']:'';

    $de = new DeleteOrder();

    $de->removeOrder('order_details', $conn, $order_id);
?>