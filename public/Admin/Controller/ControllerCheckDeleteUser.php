<?php

    include "../connect.php";

    include "../Model/ModelCheckDeleteUser.php";

    $user_id = isset($_GET['user_id'])?$_GET['user_id']:'';

    $check = new CheckDelete();

    $check->checkDeleteUser('user', $conn, $user_id);

?>