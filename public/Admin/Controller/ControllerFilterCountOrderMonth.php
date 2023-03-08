<?php

    include "../connect.php";

    include "../Model/ModelFilterCountOrder.php";

    $monthAndYear = isset($_GET['monthAndYear'])?$_GET['monthAndYear']:'';

    $s = new CountOrder();

    $s->showCountOrder('order_details', $conn, $monthAndYear);

?>