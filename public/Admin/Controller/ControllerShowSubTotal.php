<?php

    include "../connect.php";

    include "../Model/ModelShowSubTotal.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';

    $total = new ShowSubTotal();

    $total->showSubTotal('cart_item_admin', $conn, $customer);

?>