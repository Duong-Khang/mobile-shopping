<?php

    include "../connect.php";

    include "../Model/ModelCheckDeleteOrder.php";

    $order_id = isset($_GET['order_id'])?$_GET['order_id']:'';

    $check = new CheckDeleteOrder();

    $check->checkDeleteOrder('order_details', $conn, $order_id);

?>