<?php

    include "../connect.php";

    include "../Model/ModelShowCart.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';

    $show = new ShowCart();

    $show->showCart('cart_item_admin', $conn, $customer);

?>