<?php

    include "../connect.php";
    include "../Model/ModelEditDiscount.php";

    $discount_name = isset($_GET['discount_name'])?$_GET['discount_name']:'';
    $discount_desc = isset($_GET['discount_desc'])?$_GET['discount_desc']:'';
    $discount_value = isset($_GET['discount_value'])?$_GET['discount_value']:'';
    $status = isset($_GET['status'])?$_GET['status']:'';
    $start_date = isset($_GET['start_date'])?$_GET['start_date']:'';
    $end_date = isset($_GET['end_date'])?$_GET['end_date']:'';
    $did = isset($_GET['did'])?$_GET['did']:'';

    $edit = new EditDiscount();

    $edit->editDiscount('discount', $conn, $discount_name, $discount_desc, $discount_value, $status, $start_date, $end_date, $did);

?>