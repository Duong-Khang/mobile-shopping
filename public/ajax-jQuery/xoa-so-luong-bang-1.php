<?php

    include "connect.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    $pcolor = isset($_GET['pcolor'])?$_GET['pcolor']:'';
    $pid = isset($_GET['pid'])?$_GET['pid']:'';
    //Thực hiện truy vấn
    $sql = "SELECT * FROM cart_item WHERE customer='$customer' AND color LIKE '%$pcolor%' AND product_id='$pid'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $cart_id = $row['cartid'];
        $sqld = "DELETE FROM cart_item WHERE cartid='$cart_id'";
        if($conn->query($sqld) === TRUE){
            echo "removed";
        }
    }

?>