<?php

    include "../connect.php";
    include "../Model/ModelShowOrderOld.php";

    $oid = isset($_GET['oid'])?$_GET['oid']:'';

    $old = new ShowOrderOld();

    $old->getOrderOld('order_details', $conn, $oid);

?>