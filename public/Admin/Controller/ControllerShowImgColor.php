<?php

    include "../connect.php";

    include "../Model/ModelShowImgColor.php";

    $pid = isset($_GET['pid'])?$_GET['pid']:'';

    $color = isset($_GET['color'])?$_GET['color']:'';

    $show = new ShowImgColor();

    $show->showImgColor('description', $conn, $pid, $color);

?>