<?php

    class DeleteItemUpdateOrder{

        public function remove($table, $conn, $pid, $oid, $color){
            $totalQuantity = 0;
            $total = 0;
            //Kiểm tra xem order_id có còn trong order_items không
            $sql = "SELECT *, COUNT(order_id) AS countOrder FROM order_items WHERE order_id='$oid'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if($row['countOrder'] > 1){
                    //Còn trong order
                    //Xóa item
                    $sqld = "DELETE FROM order_items WHERE color='$color' AND product_id='$pid' AND order_id='$oid'";
                    if($conn->query($sqld) === TRUE){
                        //Cập nhật lại số lượng ở trong kho
                        
                        //Lấy tổng số lượng của mặt hàng
                        $sqlQuantity = "SELECT * FROM order_items WHERE order_id='$oid'";
                        $resultQuantity = $conn->query($sqlQuantity);
                        if($resultQuantity->num_rows > 0){
                            while($rowQuantity = $resultQuantity->fetch_assoc()){
                                $totalQuantity += $rowQuantity['quantity'];
                            }
                        }
                        //Tính lại tổng tiền
                        $sqlt = "SELECT $table.*, description.*, product.id, product.discount_id
                        FROM (($table
                        INNER JOIN product ON product.id = $table.product_id)
                        INNER JOIN description ON $table.product_id = description.product_id)
                        WHERE $table.order_id='$oid'
                        ";
                        $resultt = $conn->query($sqlt);
                        if($resultt->num_rows>0){
                            while($rowt = $resultt->fetch_assoc()){
                                //Màu
                                if($rowt['discount_percent_available'] != NULL){
                                    //Còn hoạt động
                                    if($rowt['color'] == $rowt['dcolor1']){
                                        $total += ($rowt['price_color1']*(100-$rowt['discount_percent_available'])/100)*$rowt['quantity'];
                                    }else if($rowt['color'] == $rowt['dcolor2']){
                                        $total += ($rowt['price_color2']*(100-$rowt['discount_percent_available'])/100)*$rowt['quantity'];
                                    }else if($rowt['color'] == $row['dcolor3']){
                                        $total += ($rowt['price_color3']*(100-$rowt['discount_percent_available'])/100)*$rowt['quantity'];
                                    }
    
                                }else if($rowt['discount_percent_available'] == NULL){
                                    //Không còn hoạt động
                                    if($rowt['color'] == $rowt['dcolor1']){
                                        $total += $rowt['price_color1']*$rowt['quantity'];
                                    }else if($rowt['color'] == $rowt['dcolor2']){
                                        $total += $rowt['price_color2']*$rowt['quantity'];
                                    }else if($rowt['color'] == $rowt['dcolor3']){
                                        $total += $rowt['price_color3']*$rowt['quantity'];
                                    }
                                }
                            }
                        }
                        //echo "Success";
                    }else{
                        //echo "Error";
                    }

                    //Kiểm tra xem có mã giảm giá không
                    $sqlm = "SELECT * FROM my_discount_code WHERE code_order='$oid' AND active_code='0'";
                    $resultm = $conn->query($sqlm);
                    if($resultm->num_rows > 0){
                        $rowm = $resultm->fetch_assoc();
                        $total = $total-$rowm['value_code'];
                    }

                    $arr = array();
                    $arr[] = array(
                        'quantity_total' => $totalQuantity,
                        'remove_all' => 0,
                        'total' => $total
                    );
                    die(json_encode($arr));

                }else if($row['countOrder'] == 1){
                    //Không còn trong order_items
                    //Xóa hết những gì liên quan đến order này
                    //echo "RemoveAll";
                   
                    //Lấy tổng số lượng của mặt hàng
                    $sqlQuantity = "SELECT * FROM order_items WHERE order_id='$oid'";
                    $resultQuantity = $conn->query($sqlQuantity);
                    if($resultQuantity->num_rows > 0){
                        while($rowQuantity = $resultQuantity->fetch_assoc()){
                            $totalQuantity += $rowQuantity['quantity'];
                        }
                    }

                    //Tính lại tổng tiền
                    $sqlt = "SELECT $table.*, description.*, product.id, product.discount_id
                    FROM (($table
                    INNER JOIN product ON product.id = $table.product_id)
                    INNER JOIN description ON $table.product_id = description.product_id)
                    WHERE $table.order_id='$oid'
                    ";
                    $resultt = $conn->query($sqlt);
                    if($resultt->num_rows>0){
                        while($rowt = $resultt->fetch_assoc()){
                            //Màu
                            if($rowt['discount_percent_available'] != NULL){
                                //Còn hoạt động
                                if($rowt['color'] == $rowt['dcolor1']){
                                    $total += ($rowt['price_color1']*(100-$rowt['discount_percent_available'])/100)*$rowt['quantity'];
                                }else if($rowt['color'] == $rowt['dcolor2']){
                                    $total += ($rowt['price_color2']*(100-$rowt['discount_percent_available'])/100)*$rowt['quantity'];
                                }else if($rowt['color'] == $row['dcolor3']){
                                    $total += ($rowt['price_color3']*(100-$rowt['discount_percent_available'])/100)*$rowt['quantity'];
                                }

                            }else if($rowt['discount_percent_available'] == NULL){
                                //Không còn hoạt động
                                if($rowt['color'] == $rowt['dcolor1']){
                                    $total += $rowt['price_color1']*$rowt['quantity'];
                                }else if($rowt['color'] == $rowt['dcolor2']){
                                    $total += $rowt['price_color2']*$rowt['quantity'];
                                }else if($rowt['color'] == $rowt['dcolor3']){
                                    $total += $rowt['price_color3']*$rowt['quantity'];
                                }
                            }
                        }
                    }
                    //Kiểm tra xem có mã giảm giá không
                    //Kiểm tra xem có mã giảm giá không
                    $sqlm = "SELECT * FROM my_discount_code WHERE code_order='$oid' AND active_code='0'";
                    $resultm = $conn->query($sqlm);
                    if($resultm->num_rows > 0){
                        $rowm = $resultm->fetch_assoc();
                        $total = $total-$rowm['value_code'];
                    }
                    //$sqlCode = "SELECT * FROM my_discount_code "

                    $arr = array();
                    $arr[] = array(
                        'quantity_total' => $totalQuantity,
                        'remove_all' => 1,
                        'total' => $total
                    );
                    die(json_encode($arr));
                }
            }
        }

    }

?>