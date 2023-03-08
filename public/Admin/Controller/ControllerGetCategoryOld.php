<?php

    include "../connect.php";
    include "../Model/ModelGetCategoryOld.php";

    $id = isset($_GET['categoryID'])?$_GET['categoryID']:'';

    $edit = new GetCategoryOld();

    $edit->getCategoriesOld('product_category', $conn, $id);

?>