<?php

    class UpdatePriceWithColor{

        public function updatePriceWithColor($table, $conn, $pid, $color, $discount_id){

            $sql = "SELECT * FROM $table WHERE product_id='$pid' AND (dcolor1 LIKE '%$color%' OR dcolor2 LIKE '%$color%' OR dcolor3 LIKE '%$color%')";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){

                $row = $result->fetch_assoc();

                //Xử lý tính giá có áp dụng khuyến mãi

                $sqldis = "SELECT * FROM discount WHERE id='$discount_id'";

                $resultdis = $conn->query($sqldis);

                if($resultdis->num_rows > 0){
                    //Kiểm tra xe discount có hoạt động không
                    $rowdis = $resultdis->fetch_assoc();
                    if($rowdis['active'] == 1 && $rowdis['delete_at'] == NULL){
                        //Lấy giá theo màu có khuyến mãi
                        if($row['dcolor1'] == $color){
                            echo number_format(($row['price_color1']*(100-$rowdis['discount_percent']))/100)." -".$rowdis['discount_percent']."%";
                        }else if($row['dcolor2'] == $color){
                            echo number_format(($row['price_color2']*(100-$rowdis['discount_percent']))/100)." -".$rowdis['discount_percent']."%";
                        }else if($row['dcolor3'] == $color){
                            echo number_format(($row['price_color3']*(100-$rowdis['discount_percent']))/100)." -".$rowdis['discount_percent']."%";
                        }
                    }else if($rowdis['active'] == 0 && $rowdis['delete_at'] == NULL){
                        //Lấy giá theo màu k có khuyến mãi
                        if($row['dcolor1'] == $color){
                            echo number_format($row['price_color1']);
                        }else if($row['dcolor2'] == $color){
                            echo number_format($row['price_color2']);
                        }else if($row['dcolor3'] == $color){
                            echo number_format($row['price_color3']);
                        }
                    }else if($rowdis['delete_at'] != NULL){
                        if($row['dcolor1'] == $color){
                            echo number_format($row['price_color1']);
                        }else if($row['dcolor2'] == $color){
                            echo number_format($row['price_color2']);
                        }else if($row['dcolor3'] == $color){
                            echo number_format($row['price_color3']);
                        }
                    }
                }
            }

        }

    }

?>