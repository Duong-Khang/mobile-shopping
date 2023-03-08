<?php

    include "../connect.php";

    include "../Model/ModelGetStatistics.php";

    $year = isset($_GET['year'])?$_GET['year']:'';

    $get = new GetStatistics();

    $get->getStatistics('order_details', $conn, $year);

?>