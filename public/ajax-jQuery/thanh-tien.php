<?php

    include "connect.php";

    $customer = isset($_GET['customer'])?$_GET['customer']:'';
    //Thực hiện truy vấn
    $sql = "SELECT product.*, cart_item.*, description.*
    FROM ((cart_item
    LEFT JOIN product ON product.id = cart_item.product_id)
    LEFT JOIN description ON description.product_id = cart_item.product_id)
    WHERE cart_item.customer LIKE '%$customer%'";

    $result = $conn->query($sql);

    $total = 0;
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            //Lấy %discount
            $discount_id = $row['discount_id'];
            //$total += $row['price']*$row['quantity'];
            $sqld = "SELECT * FROM discount WHERE id='$discount_id'";
            $resultd = $conn->query($sqld);
            if($resultd->num_rows > 0){
                while($rowd = $resultd->fetch_assoc()){
                    if(strpos($row['color'], $row['dcolor1']) !== false){
                        if($rowd['active'] == 1){
                            $total+=(($row['price_color1']*(100-$rowd['discount_percent']))/100)*$row['quantity'];
                        }else if($rowd['active'] == 0||$rowd['active'] == 2){
                            $total+=$row['price_color1']*$row['quantity'];
                        }
                    }else if(strpos($row['color'], $row['dcolor2']) !== false){
                        if($rowd['active'] == 1){
                            $total+=(($row['price_color2']*(100-$rowd['discount_percent']))/100)*$row['quantity'];
                        }else if($rowd['active'] == 0||$rowd['active'] == 2){
                            $total+=$row['price_color2']*$row['quantity'];
                        }
                    }else if(strpos($row['color'], $row['dcolor3']) !== false){
                        if($rowd['active'] == 1){
                            $total+=(($row['price_color3']*(100-$rowd['discount_percent']))/100)*$row['quantity'];
                        }else if($rowd['active'] == 0||$rowd['active'] == 2){
                            $total+=$row['price_color3']*$row['quantity'];
                        }
                    }
                }
            }
        }
    }
    echo number_format($total).'đ';
?>

