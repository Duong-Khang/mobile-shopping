<?php

    include "../connect.php";

    include "../Model/ModelShowChooseColorProduct.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';

    $color = isset($_GET['color'])?$_GET['color']:'';

    $choose = new ShowColorChoose();

    $choose->showColor('description', $conn, $pid, $color);

?>