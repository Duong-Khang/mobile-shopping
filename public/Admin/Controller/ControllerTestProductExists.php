<?php

    include "../connect.php";

    include "../Model/ModelTestProductExists.php";

    $name = isset($_GET['name'])?$_GET['name']:'';

    $file = isset($_GET['fileToUpload_1'])?$_GET['fileToUpload_1']:'';

    $test = new TestProductExists();

    $test->productExists('product', $conn, $name, $file);

?>