<?php

    include "../connect.php";

    include "../Model/ModelCheckDeleteDiscount.php";

    $did = isset($_GET['did'])?$_GET['did']:'';

    $check = new CheckDeleteDiscount();

    $check->checkDiscount('discount', $conn, $did);

?>