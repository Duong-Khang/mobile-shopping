<?php

    include "../connect.php";

    include "../Model/ModelShowStock.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';

    $color = isset($_GET['color'])?$_GET['color']:'';

    $stock = new ShowStock();

    $stock->showStock('product_inventory', $conn, $pid, $color);

?>