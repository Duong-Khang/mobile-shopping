<?php

    include "connect.php";

    $order_id = isset($_GET['order_id'])?$_GET['order_id']:'';

    $sql = "SELECT * FROM my_discount_code WHERE code_order='$order_id'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        echo $row['value_code'];
    }

?>