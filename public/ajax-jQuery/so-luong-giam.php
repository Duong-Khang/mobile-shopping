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
        $quantity = $row['quantity'];
        if($quantity == 1){
            echo "bang_1";
            return false;
        }
        $quantity -= 1;
        //Tiến hành updata quantity
        $sqlu = "UPDATE cart_item SET quantity='$quantity' WHERE customer='$customer' AND color LIKE '%$pcolor%' AND product_id='$pid'";
        if($conn->query($sqlu) === TRUE){
            echo $quantity;
        }
    }

?>