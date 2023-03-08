<?php

    class UpdateCode{

        public function updateCode($table, $conn, $code, $value, $status, $start_date, $end_date, $cid){

            $sql = "SELECT * FROM $table WHERE id='$cid'";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){

                $row = $result->fetch_assoc();
                if($status == 0){
                    //Đã được sử dụng
                    //Xem bị xóa chưa
                    if($row['delete_at'] == NULL){
                        //Chưa xóa
                        $sqlu = "UPDATE $table SET dis_code='$code', status_code='0', value_code='$value',
                        `start_date`='$start_date', `end_date`='$end_date' WHERE id='$cid'
                        ";
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }else if($row['delete_at'] != NULL){
                        //Đã xóa
                        $sqlu = "UPDATE $table SET dis_code='$code', status_code='3', value_code='$value',
                        `start_date`='$start_date', `end_date`='$end_date' WHERE id='$cid'
                        ";
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }
                }else if($status == 1){
                    //Hoạt động
                    if($row['delete_at'] == NULL){
                        //Chưa xóa
                        $sqlu = "UPDATE $table SET dis_code='$code', status_code='1', value_code='$value',
                        `start_date`='$start_date', `end_date`='$end_date' WHERE id='$cid'
                        ";
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }else if($row['delete_at'] != NULL){
                        //Đã xóa
                        $sqlu = "UPDATE $table SET dis_code='$code', status_code='1', value_code='$value',
                        `start_date`='$start_date', `end_date`='$end_date', delete_at=NULL WHERE id='$cid'
                        ";
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }
                }else if($status == 2){
                    //Hết hạn
                    if($row['delete_at'] == NULL){
                        //Chưa xóa
                        $sqlu = "UPDATE $table SET dis_code='$code', status_code='2', value_code='$value',
                        `start_date`='$start_date', `end_date`='$end_date' WHERE id='$cid'
                        ";
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }else if($row['delete_at'] != NULL){
                        //Đã xóa
                        $sqlu = "UPDATE $table SET dis_code='$code', status_code='3', value_code='$value',
                        `start_date`='$start_date', `end_date`='$end_date' WHERE id='$cid'
                        ";
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }
                }else if($status == 3){
                    //Xóa
                    //Kiểm tra xem đã xóa chưa
                    if($row['delete_at'] == NULL){
                        //Chưa xóa
                        date_default_timezone_set('Asia/Ho_Chi_Minh');

                        $delete_at = date("m/d/Y h:ia");
                        $sqlu = "UPDATE $table SET dis_code='$code', status_code='3', value_code='$value',
                        `start_date`='$start_date', `end_date`='$end_date', delete_at='$delete_at' WHERE id='$cid'
                        ";
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }else if($row['delete_at'] != NULL){
                        //Đã xóa
                        $sqlu = "UPDATE $table SET dis_code='$code', status_code='3', value_code='$value',
                        `start_date`='$start_date', `end_date`='$end_date' WHERE id='$cid'
                        ";
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }
                }
            }else{
                echo "Mã khuyến mãi không tồn tại";
            }

        }

    }

?>