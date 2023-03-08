<?php

    include "../connect.php";
    include "../Model/ModelDeleteCode.php";

    $cid = isset($_GET['cid'])?$_GET['cid']:'';

    $de = new DeleteCode();

    $de->removeCode('discount_code', $conn, $cid);

?>