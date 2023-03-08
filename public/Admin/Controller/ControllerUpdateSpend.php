<?php

    include "../connect.php";

    include "../Model/ModelUpdateSpend.php";

    $oid = isset($_GET['oid'])?$_GET['oid']:'';
    $total = isset($_GET['resultSubTotal'])?$_GET['resultSubTotal']:'';
    $spend = isset($_GET['spend'])?$_GET['spend']:'';

    $up = new UpdateSpend();

    $up->updateSpend($conn, $oid, $total, $spend);
    

?>