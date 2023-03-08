<?php

    class UpdateTotalProduct{

        public function updateTotalProduct($table, $conn, $customer, $pid, $color){

            $sql = "SELECT $table.*, product.id, product.discount_id, description.*
            FROM (($table
            INNER JOIN product ON product.id = $table._product_id)
            INNER JOIN description ON description.product_id = $table._product_id)
            WHERE _product_id='$pid' AND _customer='$customer' AND _color='$color'";

            $result = $conn->query($sql);

            if($result-> num_rows > 0){
                $row = $result->fetch_assoc();

                //Hiển thị giá
                //Xử lý tính giá có áp dụng khuyến mãi
                $discount_id = $row['discount_id'];
                $sqldis = "SELECT * FROM discount WHERE id='$discount_id'";

                $resultdis = $conn->query($sqldis);

                if($resultdis->num_rows > 0){
                    //Kiểm tra xe discount có hoạt động không
                    $rowdis = $resultdis->fetch_assoc();
                    if($rowdis['active'] == 1 && $rowdis['delete_at'] == NULL){
                        //Lấy giá theo màu có khuyến mãi
                        if($row['dcolor1'] == $row['_color']){
                            echo number_format((($row['price_color1']*(100-$rowdis['discount_percent']))/100)*$row['_quantity']);
                        }else if($row['dcolor2'] == $row['_color']){
                            echo number_format((($row['price_color2']*(100-$rowdis['discount_percent']))/100)*$row['_quantity']);
                        }else if($row['dcolor3'] == $row['_color']){
                            echo number_format((($row['price_color3']*(100-$rowdis['discount_percent']))/100)*$row['_quantity']);
                        }
                    }else if($rowdis['active'] == 0 && $rowdis['delete_at'] == NULL){
                        //Lấy giá theo màu k có khuyến mãi
                        if($row['dcolor1'] == $row['_color']){
                            echo number_format($row['price_color1']*$row['_quantity']);
                        }else if($row['dcolor2'] == $row['_color']){
                            echo number_format($row['price_color2']*$row['_quantity']);
                        }else if($row['dcolor3'] == $row['_color']){
                            echo number_format($row['price_color3']*$row['_quantity']);
                        }
                    }else if($rowdis['delete_at'] != NULL){
                        if($row['dcolor1'] == $row['_color']){
                            echo number_format($row['price_color1']*$row['_quantity']);
                        }else if($row['dcolor2'] == $row['_color']){
                            echo number_format($row['price_color2']*$row['_quantity']);
                        }else if($row['dcolor3'] == $row['_color']){
                            echo number_format($row['price_color3']*$row['_quantity']);
                        }
                    }
                }
            }

        }

    }

?>