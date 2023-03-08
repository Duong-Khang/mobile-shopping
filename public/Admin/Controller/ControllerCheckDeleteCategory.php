<?php

    include "../connect.php";

    include "../Model/ModelCheckDeleteCategory.php";

    $cid = isset($_GET['cid'])?$_GET['cid']:'';

    $check = new CheckDeleteCategory();

    $check->checkDeleteCategory('product_category', $conn, $cid);

?>