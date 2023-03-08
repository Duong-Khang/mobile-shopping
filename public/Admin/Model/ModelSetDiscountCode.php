<?php

    class SetDiscountCode{

        public function setDiscountCode($table, $conn, $customer, $discount_code){

            //Kiểm tra xem discount code có dùng dc không
            $sqlCheckDiscountCode = "SELECT * FROM discount_code WHERE dis_code='$discount_code'
            AND status_code='1' AND delete_at IS NULL
            ";

            $resultCheckDiscountCode = $conn->query($sqlCheckDiscountCode);

            if($resultCheckDiscountCode->num_rows > 0){
                //Chỉ cho mỗi đơn hàng dùng 1 mã giảm giá
                $sqlc = "SELECT * FROM $table WHERE customer='$customer' AND active_code='1'";
                $resultc = $conn->query($sqlc);
                if($resultc->num_rows > 0){
                    echo "Mỗi đơn hàng chỉ dùng được một mã giảm giá";
                    return false;
                }
                //Mã hoạt động
                $rowCheckDiscountCode = $resultCheckDiscountCode->fetch_assoc();
                //Lấy code và mệnh giá
                $code = $rowCheckDiscountCode['dis_code'];
                $value_code = $rowCheckDiscountCode['value_code'];

                //Chèn vào my_discount_code
                $sql = "INSERT INTO $table(customer, dis_code, value_code, active_code)
                VALUE('$customer', '$code', '$value_code', '1')
                ";

                if($conn->query($sql) === TRUE){
                    //Update status code về 0
                    $sqlu = "UPDATE discount_code SET status_code='0' WHERE dis_code='$code'";
                    if($conn->query($sqlu) === TRUE){
                        echo "Success";
                    }else{
                        echo "Thêm mã giảm giá thất bại";
                    }
                }else{
                    echo "Thêm mã giảm giá thất bại";
                }

            }else{
                echo "Mã giảm giá này đã được sử dụng hoặc đã bị xóa";
            }

        }

    }

?>