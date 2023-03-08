<?php

    include "connect.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';

    echo $customer;

?>