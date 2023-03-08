<?php

    class AddOrderFinish{

        public function addOrder($table, $conn, $customer, $fullname, $email, $phone, $address, $total, $spend){

            //Xử lý insert data vào database
            //Lấy userid
            
            $user_id = 0;
            $last_id = 0;
            $sql = "SELECT * FROM user WHERE username='$customer'";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                $row = $result->fetch_assoc();
                $user_id = $row['id'];
                //insert data vào table user_address
                $sqli = "INSERT INTO user_address(user_id, fullname, mobile, email, address, order_id)
                VALUES('$user_id', '$fullname', '$phone', '$email', '$address', '1')
                ";
                if($conn->query($sqli) === TRUE){
                    echo "success";
                    $last_order_id = $conn->insert_id;
                }else{
                    echo "error";
                }
            }
            //Xử lý insert vào table order_details
            //set thoi gian
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $d = strtotime("+7 Days");
            $delivery_date = date("m/d/Y", $d);
            $order_date = date("m/d/Y");
            $sqlod = "INSERT INTO order_details(user_id, total, spend, delivery_date, order_date, status)
            VALUES('$user_id', '$total', '$spend', '$delivery_date', '$order_date', '1')
            ";
            if($conn->query($sqlod) === TRUE){
                echo "success";
                $last_id = $conn->insert_id;
            }else{
                echo "error";
            }

            //Update
            $sql = "UPDATE user_address SET order_id='$last_id' WHERE id='$last_order_id'";
            $conn->query($sql);
            
            //Xử lý insert vào order_items
            //Lấy hết data từ table cart_item đổ vào order_items
            $sql = "SELECT * FROM cart_item_admin WHERE _customer='$customer'";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $pid = $row['_product_id'];
                    $quantity = $row['_quantity'];
                    $color = $row['_color'];
                    //Tiến hành insert vào table order_items

                    //Lấy discount id
                    $sqlGetDiscountID = "SELECT * FROM product WHERE id='$pid'";
                    $resultGetDiscountID = $conn->query($sqlGetDiscountID);
                    if($resultGetDiscountID->num_rows > 0){
                        $rowGetDiscountID = $resultGetDiscountID->fetch_assoc();
                        $discount_id = $rowGetDiscountID['discount_id'];

                        //Lấy discount %
                        $sqlDis = "SELECT * FROM discount WHERE id='$discount_id'";
                        $resultDis = $conn->query($sqlDis);
                        if($resultDis->num_rows>0){
                            $rowDis = $resultDis->fetch_assoc();
                            if($rowDis['delete_at'] != NULL){
                                $discount_available = NULL;
                            }else{
                                if($rowDis['active'] == '1'){
                                    $discount_available = $rowDis['discount_percent'];
                                }else if($rowDis['active'] == '0'){
                                    $discount_available = NULL;
                                }
                            }
                            //Insert
                            if($discount_available != NULL){
                                $sqli = "INSERT INTO order_items(product_id, color, quantity, discount_percent_available, order_id)
                                VALUES('$pid', '$color', '$quantity', '$discount_available', '$last_id')
                                ";
                                $conn->query($sqli);
                            }else{
                                $sqli = "INSERT INTO order_items(product_id, color, quantity, discount_percent_available, order_id)
                                VALUES('$pid', '$color', '$quantity', NULL, '$last_id')
                                ";
                                $conn->query($sqli);
                            }       
                        }
                    }
                                       
                }
            }
            //Xóa hết item trong cart_item
            $sql = "DELETE FROM cart_item_admin WHERE _customer='$customer'";
            if($conn->query($sql) === TRUE){
                //Cập nhật active_code về 0 và code_order
                $sqlc = "UPDATE my_discount_code SET active_code='0', code_order='$last_id' WHERE customer='$customer' AND active_code='1'";
                $conn->query($sqlc);
                echo "success";
            }else{
                echo "error";
            }

        }

    }

?>