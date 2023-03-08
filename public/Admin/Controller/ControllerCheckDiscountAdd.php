<?php

    include "../connect.php";

    include "../Model/ModelCheckDiscountAdd.php";

    $discount_name = isset($_GET['discount_name'])?$_GET['discount_name']:'';
    $discount_value = isset($_GET['discount_value'])?$_GET['discount_value']:'';

    $check = new CheckDiscountAdd();

    $check->checkDiscountAdd('discount', $conn, $discount_name, $discount_value);

?>