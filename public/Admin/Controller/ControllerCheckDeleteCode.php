<?php

    include "../connect.php";

    include "../Model/ModelCheckDeleteCode.php";

    $cid = isset($_GET['cid'])?$_GET['cid']:'';

    $check = new CheckDeleteCode();

    $check->checkDeleteCode('discount_code', $conn, $cid);

?>