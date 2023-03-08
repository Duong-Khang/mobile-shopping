<?php

    include "../connect.php";
    include "../Model/ModelShowCodeOld.php";

    $cid = isset($_GET['cid'])?$_GET['cid']:'';

    $old = new ShowCodeOld();

    $old->showCode('discount_code', $conn, $cid);

?>