<?php

    class CheckDelete{

        public function checkDeleteUser($table, $conn, $user_id){

            $sql = "SELECT * FROM $table WHERE id='$user_id'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                
                $row = $result->fetch_assoc();

                if(!$row['delete_at']){
                    echo "nodelete";
                }else{
                    echo "yesdelete";
                }

            }else{
                echo "Khách hàng không tồn tại";
            }

        }

    }

?>