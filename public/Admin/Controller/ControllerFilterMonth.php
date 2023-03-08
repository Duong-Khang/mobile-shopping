<?php

    include "../connect.php";

    include "../Model/ModelFilterMonth.php";


    $monthAndYear = isset($_GET['monthAndYear'])?$_GET['monthAndYear']:'';

    $f = new FilterMonth();

    $f->getValueMonth('order_details', $conn, $monthAndYear);

?>