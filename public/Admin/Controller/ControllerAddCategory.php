<?php

    include "../connect.php";

    $category_name = isset($_GET['category_name'])?$_GET['category_name']:'';
    $category_desc = isset($_GET['category_desc'])?$_GET['category_desc']:'';

    include "../Model/ModelAddCategory.php";

    $add = new AddCategory();

    $add->addCategories('product_category', $conn, $category_name, $category_desc);

?>