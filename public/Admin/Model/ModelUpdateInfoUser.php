<?php

    class UpdateInfoUser{

        public function updateInfoUser($table, $conn, $uid, $username, $password, $status){

            $sql = "SELECT * FROM $table WHERE id='$uid'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                //

                if($status == 1){

                    $sqlu = "UPDATE $table SET username='$username', password='$password', delete_at=NULL WHERE id='$uid'";
                    
                    if($conn->query($sqlu) === TRUE){
                        echo "Success";
                    }else{
                        echo "Cập nhật thất bại";
                    }

                }else if($status == 0){

                    $row = $result->fetch_assoc();

                    if($row['delete_at'] != NULL){
                        $sqlu = "UPDATE $table SET username='$username', password='$password' WHERE id='$uid'";
                    
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }
                    }else{
                        date_default_timezone_set('Asia/Ho_Chi_Minh');

                        $delete_at = date("m/d/Y h:ia");

                        $sqlu = "UPDATE $table SET username='$username', password='$password', delete_at='$delete_at' WHERE id='$uid'";
                    
                        if($conn->query($sqlu) === TRUE){
                            echo "Success";
                        }else{
                            echo "Cập nhật thất bại";
                        }

                    }                   
                }
            }else{
                echo "Khách hàng không tồn tại";
            }

        }

    }

?>