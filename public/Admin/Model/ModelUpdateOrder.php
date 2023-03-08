<?php

    class UpdateOrder{

        public function updateOrder($table, $conn, $oid, $statusXuLy, $statusHuy, $delivery_date){

            $sqlc = "SELECT * FROM $table WHERE id='$oid'";

            $resultc = $conn->query($sqlc);

            if($resultc -> num_rows > 0){
                $rowc = $resultc->fetch_assoc();
                $delete_at = $rowc['delete_at'];

                //Kiểm tra xem có xóa chưa
                if($delete_at != NULL){
                    //Xóa rồi
                    if($statusHuy == '0'){
                        //Đã hủy
                        $sql = "UPDATE $table SET delivery_date='$delivery_date',`status`='$statusXuLy' WHERE id='$oid'";

                        if($conn->query($sql) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }else if($statusHuy == '1'){
                        //Chưa hủy
                        $sql = "UPDATE $table SET delivery_date='$delivery_date',`status`='$statusXuLy', delete_at=NULL WHERE id='$oid'";

                        if($conn->query($sql) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }
                }else{
                    //Chưa xóa
                    if($statusHuy == '0'){
                        //Đã hủy
                        date_default_timezone_set('Asia/Ho_Chi_Minh');

                        $delete_at = date("m/d/Y h:ia");
                        $sql = "UPDATE $table SET delivery_date='$delivery_date',`status`='$statusXuLy', delete_at='$delete_at' WHERE id='$oid'";

                        if($conn->query($sql) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }

                    }else if($statusHuy == '1'){
                        //Chưa hủy
                        $sql = "UPDATE $table SET delivery_date='$delivery_date',`status`='$statusXuLy' WHERE id='$oid'";

                        if($conn->query($sql) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }
                }
            }

        }

    }

?>