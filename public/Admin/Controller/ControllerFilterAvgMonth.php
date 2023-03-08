<?php

    include "../connect.php";

    include "../Model/ModelFilterAvgMonth.php";

    $monthAndYear = isset($_GET['monthAndYear'])?$_GET['monthAndYear']:'';

    $g = new FilterAvgMonth();

    $g->getAvg('order_details', $conn, $monthAndYear);

?>