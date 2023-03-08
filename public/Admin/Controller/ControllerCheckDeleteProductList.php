<?php

    include "../connect.php";

    include "../Model/ModelCheckDeleteProductList.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';

    $check = new CheckDeleteProductList();

    $check->checkDelete('product', $conn, $pid);

?>