<?php

    include "../connect.php";
    include "../Model/ModelDeleteDiscount.php";

    $did = isset($_GET['did'])?$_GET['did']:'';

    $de = new DeleteDiscount();

    $de->removeDiscount('discount', $conn, $did);

?>