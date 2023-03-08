<?php

    include "../connect.php";

    include "../Model/ModelUpdateProduct.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $name = isset($_GET['name'])?$_GET['name']:'';
    $desc = isset($_GET['desc'])?$_GET['desc']:'';
    $short_desc = isset($_GET['short_desc'])?$_GET['short_desc']:'';
    $rom = isset($_GET['rom'])?$_GET['rom']:'';
    $ram = isset($_GET['ram'])?$_GET['ram']:'';
    $chip_gpu = isset($_GET['chip_gpu'])?$_GET['chip_gpu']:'';
    $chip_set = isset($_GET['chip_set'])?$_GET['chip_set']:'';
    $screen = isset($_GET['screen'])?$_GET['screen']:'';
    $status = isset($_GET['status'])?$_GET['status']:'';
    $discount = isset($_GET['discount'])?$_GET['discount']:'';
    $category = isset($_GET['category'])?$_GET['category']:'';
    $price_color1 = isset($_GET['price_color1'])?$_GET['price_color1']:'';
    $quantity_color1 = isset($_GET['quantity_color1'])?$_GET['quantity_color1']:'';
    $price_color2 = isset($_GET['price_color2'])?$_GET['price_color2']:'';
    $quantity_color2 = isset($_GET['quantity_color2'])?$_GET['quantity_color2']:'';
    $price_color3 = isset($_GET['price_color3'])?$_GET['price_color3']:'';
    $quantity_color3 = isset($_GET['quantity_color3'])?$_GET['quantity_color3']:'';

    $up = new UpdateProduct();

    $up->updateProduct(
        $conn,
        $pid,
        $name,
        $desc,
        $short_desc,
        $rom,
        $ram,
        $chip_gpu,
        $chip_set,
        $screen,
        $status,
        $discount,
        $category,
        $price_color1,
        $quantity_color1,
        $price_color2,
        $quantity_color2,
        $price_color3,
        $quantity_color3
    );

?>