<?php

    class DeleteUser{

        public function removeUser($table, $conn, $user_id){

            $sql = "SELECT * FROM $table WHERE id='$user_id'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                //
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $delete_at = date("m/d/Y h:ia");

                $sqlu = "UPDATE $table SET delete_at='$delete_at' WHERE id='$user_id'";

                if($conn->query($sqlu) === TRUE){
                    echo $delete_at;
                }else{
                    echo "Xóa thất bại";
                }
            }else{
                echo "Khách hàng không tồn tại";
            }

        }

    }

?>