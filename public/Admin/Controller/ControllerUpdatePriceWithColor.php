<?php

    include "../connect.php";

    include "../Model/ModelUpdatePriceWithColor.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    $color = isset($_GET['color'])?$_GET['color']:'';
    $discount_id = isset($_GET['discount_id'])?$_GET['discount_id']:'';

    $col = new UpdatePriceWithColor();

    $col->updatePriceWithColor('description', $conn, $pid, $color, $discount_id);

?>