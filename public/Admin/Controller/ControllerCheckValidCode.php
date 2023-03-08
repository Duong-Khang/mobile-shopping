<?php

    include "../connect.php";

    include "../Model/ModelCheckValidCode.php";

    $day = isset($_GET['day'])?$_GET['day']:'';
    $month = isset($_GET['month'])?$_GET['month']:'';
    $year = isset($_GET['year'])?$_GET['year']:'';

    $check = new CheckValidCode();

    $check->checkValidCode('discount_code', $conn, $day, $month, $year)

?>