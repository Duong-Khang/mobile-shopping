<?php

    include "../connect.php";

    include "../Model/ModelCodeTimeExpired.php";

    $end_date = isset($_GET['end_date'])?$_GET['end_date']:'';

    $up = new CodeTimeExpired();

    $up->updateStatus('discount_code', $conn, $end_date);

?>