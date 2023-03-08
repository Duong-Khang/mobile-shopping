<?php

    class ShowOrderOld{

        public function getOrderOld($table, $conn, $oid){

            $sql = "SELECT * FROM $table WHERE id='$oid'";

            $arr = array();

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
                $customer = '';
                $quantity = 0;
                //Lấy tên khách hàng
                $sqli = "SELECT * FROM user_address WHERE user_id='$user_id' AND order_id='$oid'";
                $resulti = $conn->query($sqli);
                if($resulti->num_rows>0){
                    $rowi = $resulti->fetch_assoc();
                    $customer = $rowi['fullname'];
                }
                //Lấy số lượng sản phẩm
                $sqli = "SELECT * FROM order_items WHERE order_id='$oid'";
                $resulti = $conn->query($sqli);
                if($resulti->num_rows>0){
                    while($rowi = $resulti->fetch_assoc()){
                        $quantity += $rowi['quantity'];
                    }                   
                }
                $arr[] = array(
                    'fullname' => $customer,
                    'quantity' => $quantity,
                    'total' => $row['total'],
                    'total_spend' => $row['spend'],
                    'status' => $row['status'],
                    'order_date' => $row['order_date'],
                    'delivery_date' => $row['delivery_date'],
                    'delete_at' => $row['delete_at']
                );
            }else{
                echo "Error";
            }

            die(json_encode($arr));

        }

    }

?>