<?php

    include "../connect.php";
    include "../Model/ModelAddCode.php";

    $code = isset($_GET['code'])?$_GET['code']:'';
    $value = isset($_GET['value'])?$_GET['value']:'';
    $start_date = isset($_GET['start_date'])?$_GET['start_date']:'';
    $end_date = isset($_GET['end_date'])?$_GET['end_date']:'';
    $status = isset($_GET['status'])?$_GET['status']:'';

    $add = new AddCode();

    $add->addCode('discount_code',$conn, $code, $value, $status, $start_date, $end_date);

?>