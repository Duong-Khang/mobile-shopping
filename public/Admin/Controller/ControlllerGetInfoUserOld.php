<?php

    include "../connect.php";

    include "../Model/ModelGetInfoUserOld.php";

    $uid = isset($_GET['uid'])?$_GET['uid']:'';

    $get = new GetInfoUserOld();

    $get->getInfoCustomer('user', $conn, $uid);

?>