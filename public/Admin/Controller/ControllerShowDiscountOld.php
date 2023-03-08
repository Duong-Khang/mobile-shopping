<?php

    include "../connect.php";
    include "../Model/ModelShowDiscountOld.php";

    $did = isset($_GET['did'])?$_GET['did']:'';

    $old = new ShowDiscountOld();

    $old->getDiscountOld('discount', $conn, $did);

?>