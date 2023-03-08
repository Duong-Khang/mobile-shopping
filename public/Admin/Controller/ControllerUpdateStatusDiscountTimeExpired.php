<?php

    include "../connect.php";

    include "../Model/ModelDiscountTimeExpired.php";

    $end_date = isset($_GET['end_date'])?$_GET['end_date']:'';

    $up = new DiscountTimeExpired();

    $up->updateStatus('discount', $conn, $end_date);

?>