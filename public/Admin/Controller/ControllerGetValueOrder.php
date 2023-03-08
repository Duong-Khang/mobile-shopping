<?php

    include "../connect.php";

    include "../Model/ModelGetValueOrder.php";

    $year = isset($_GET['year'])?$_GET['year']:'';

    $get = new GetValue();

    $get->getValueOrder('order_details', $conn, $year);

?>