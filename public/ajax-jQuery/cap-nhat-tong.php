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
        //lấy giá và discount_percent
        $sqlu = "SELECT product.*, discount.*, description.*
        FROM ((product
        LEFT JOIN discount ON product.discount_id = discount.id)
        LEFT JOIN description ON product.id = description.product_id)
        WHERE product.id='$pid'
        ";
        $resultu = $conn->query($sqlu);
        if($resultu->num_rows > 0){
            $rowu = $resultu->fetch_assoc();
            //Xử lý chọn giá theo màu
            if(strpos($rowu['dcolor1'], $pcolor) !== false){
                if($rowu['active'] == 1){
                    echo number_format((($rowu['price_color1']*(100-$rowu['discount_percent']))/100)*$quantity).' đ';
                }else if($rowu['active'] == 0||$rowu['active'] == 2){
                    echo number_format($rowu['price_color1']*$quantity).' đ';
                }
            }else if(strpos($rowu['dcolor2'], $pcolor) !== false){
                if($rowu['active'] == 1){
                    echo number_format((($rowu['price_color2']*(100-$rowu['discount_percent']))/100)*$quantity).' đ';
                }else if($rowu['active'] == 0||$rowu['active'] == 2){
                    echo number_format($rowu['price_color2']*$quantity).' đ';
                }
            }else if(strpos($rowu['dcolor3'], $pcolor) !== false){
                if($rowu['active'] == 1){
                    echo number_format((($rowu['price_color3']*(100-$rowu['discount_percent']))/100)*$quantity).' đ';
                }else if($rowu['active'] == 0||$rowu['active'] == 2){
                    echo number_format($rowu['price_color3']*$quantity).' đ';
                }
            }
        }
    }

?>

