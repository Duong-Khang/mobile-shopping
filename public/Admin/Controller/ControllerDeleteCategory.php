<?php

    include "../connect.php";

    include "../Model/ModelDeleteCategory.php";

    $cid = isset($_GET['cid'])?$_GET['cid']:'';

    $de = new DeleteCategory();

    $de->removeCategory('product_category', $conn, $cid);

?>