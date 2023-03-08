<?php

    include "connect.php";

    $arr = array();

    $order_id = isset($_GET['order_id'])?$_GET['order_id']:'';

    $sql = "SELECT * FROM order_details WHERE id='$order_id'";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        //Lấy value_code
        $sqlGet = "SELECT * FROM my_discount_code WHERE code_order='$order_id'";
        $resultGet = $conn->query($sqlGet);
        if($resultGet->num_rows>0){
            $rowGet = $resultGet->fetch_assoc();
            $t = $row['spend'] + $rowGet['value_code'];
            $arr[] = array(
                'total' => $row['total'],
                'subtotal' => $t
            );
            die(json_encode($arr));
        }else{
            $arr[] = array(
                'total' => $row['total'],
                'subtotal' => $row['spend']
            );
            die(json_encode($arr));
        }
    }else{
        echo "0 đ";
    }

?>