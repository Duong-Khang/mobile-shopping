<?php

    include "../connect.php";
    include "../Model/ModelUpdateCategory.php";

    $id = isset($_GET['categoryID'])?$_GET['categoryID']:'';
    $name = isset($_GET['name'])?$_GET['name']:'';
    $desc = isset($_GET['desc'])?$_GET['desc']:'';
    $status = isset($_GET['status'])?$_GET['status']:'';

    $update = new UpdateCategory();

    $update->updateCategories('product_category', $conn, $id, $name, $desc, $status);

?>