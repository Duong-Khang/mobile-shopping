<?php

    class EditDiscount{

        public function editDiscount($table, $conn, $discount_name, $discount_desc, $discount_value, $status, $start_date, $end_date, $did){

            $sqlc = "SELECT * FROM $table WHERE id='$did'";

            $resultc = $conn->query($sqlc);

            if($resultc->num_rows > 0){
                if($status == 1){
                    //Đang hoạt động
                    $sql = "UPDATE $table SET `name`='$discount_name', `desc`='$discount_desc', 
                    discount_percent='$discount_value', active='$status', `start_date`='$start_date',
                    `end_date`='$end_date', delete_at=NULL WHERE id='$did'
                    ";
            
                    if($conn->query($sql) === TRUE){
                        echo "Success";
                    }else{
                        echo "Cập nhật thất bại";
                    }

                }else if($status == 0){
                    //Hết hạn
                    $sql = "UPDATE $table SET `name`='$discount_name', `desc`='$discount_desc', 
                    discount_percent='$discount_value', active='$status', `start_date`='$start_date',
                    `end_date`='$end_date' WHERE id='$did' AND delete_at IS NULL
                    ";
            
                    if($conn->query($sql) === TRUE){
                        echo "Success";
                    }else{
                        echo "Cập nhật thất bại";
                    }

                }else if($status == 2){
                    //Xóa
                    date_default_timezone_set('Asia/Ho_Chi_Minh');

                    $delete_at = date("m/d/Y h:ia");
                    
                    $sql = "UPDATE $table SET `name`='$discount_name', `desc`='$discount_desc', 
                    discount_percent='$discount_value', active='$status', `start_date`='$start_date',
                    `end_date`='$end_date', delete_at='$delete_at' WHERE id='$did'
                    ";
            
                    if($conn->query($sql) === TRUE){
                        echo "Success";
                    }else{
                        echo "Cập nhật thất bại";
                    }
                }

            }else{
                echo "Cập nhật thất bại";
            }
        }

    }

?>