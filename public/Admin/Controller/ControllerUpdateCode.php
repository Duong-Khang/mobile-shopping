<?php

    include "../connect.php";
    include "../Model/ModelUpdateCode.php";

    $cid = isset($_GET['cid'])?$_GET['cid']:'';
    $code = isset($_GET['code'])?$_GET['code']:'';
    $value = isset($_GET['value'])?$_GET['value']:'';
    $start_date = isset($_GET['start_date'])?$_GET['start_date']:'';
    $end_date = isset($_GET['end_date'])?$_GET['end_date']:'';
    $status = isset($_GET['status'])?$_GET['status']:'';

    $update = new UpdateCode();

    $update->updateCode('discount_code', $conn, $code, $value, $status, $start_date, $end_date, $cid)

?>