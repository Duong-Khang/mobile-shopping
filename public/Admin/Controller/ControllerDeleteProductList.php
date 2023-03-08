<?php

    include "../connect.php";

    include "../Model/ModelDeleteProductList.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';

    $de = new DeleteProductList();

    $de->removeProductList('product', $conn, $pid);

?>