<?php

    class ShowSubTotal{

        public function showSubTotal($table, $conn, $customer){

            $total = 0;

            $sql = "SELECT $table.*, description.*, product.id, product.discount_id
            FROM (($table
            INNER JOIN product ON product.id = $table._product_id)
            INNER JOIN description ON $table._product_id = description.product_id)
            WHERE $table._customer='$customer'
            ";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    //Lấy discount_percent
                    $discount_id = $row['discount_id'];
                    $sqld = "SELECT * FROM discount WHERE id='$discount_id'";
                    $resultd = $conn->query($sqld);
                    if($resultd->num_rows > 0){
                        while($rowd = $resultd->fetch_assoc()){
                            //Kiểm tra xem discount có còn hoạt động không
                            if($rowd['active'] == '1' && $rowd['delete_at'] == NULL){
                                //Còn hoạt động
                                if($row['_color'] == $row['dcolor1']){
                                    $total += ($row['price_color1']*(100-$rowd['discount_percent'])/100)*$row['_quantity'];
                                }else if($row['_color'] == $row['dcolor2']){
                                    $total += ($row['price_color2']*(100-$rowd['discount_percent'])/100)*$row['_quantity'];
                                }else if($row['_color'] == $row['dcolor3']){
                                    $total += ($row['price_color3']*(100-$rowd['discount_percent'])/100)*$row['_quantity'];
                                }

                            }else if($rowd['active'] == 0 || $rowd['delete_at'] != NULL){
                                //Không còn hoạt động
                                if($row['_color'] == $row['dcolor1']){
                                    $total += $row['price_color1']*$row['_quantity'];
                                }else if($row['_color'] == $row['dcolor2']){
                                    $total += $row['price_color2']*$row['_quantity'];
                                }else if($row['_color'] == $row['dcolor3']){
                                    $total += $row['price_color3']*$row['_quantity'];
                                }
                            }
                        }
                    }
                }
            }

            //Kiểm tra xem có mã giảm giá không
            $sql = "SELECT * FROM my_discount_code WHERE customer='$customer' AND active_code='1'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                echo $total-$row['value_code'];
            }else{
                echo $total;
            }

        }

    }

?>