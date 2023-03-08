<?php

    include "../connect.php";

    include "../Model/ModelSetDiscountCode.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    $discount_code = isset($_GET['discount_code'])?$_GET['discount_code']:'';

    $set = new SetDiscountCode();

    $set->setDiscountCode('my_discount_code', $conn, $customer, $discount_code);

?>