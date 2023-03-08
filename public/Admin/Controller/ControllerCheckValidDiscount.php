<?php

    include "../connect.php";

    include "../Model/ModelCheckValidDiscount.php";

    $day = isset($_GET['day'])?$_GET['day']:'';
    $month = isset($_GET['month'])?$_GET['month']:'';
    $year = isset($_GET['year'])?$_GET['year']:'';

    $check = new CheckValidDiscount();

    $check->checkValidDiscount('discount', $conn, $day, $month, $year)

?>