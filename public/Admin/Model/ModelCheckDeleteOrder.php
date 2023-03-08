<?php

    class CheckDeleteOrder{

        public function checkDeleteOrder($table, $conn, $order_id){

            $sql = "SELECT * FROM $table WHERE id='$order_id'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if(!$row['delete_at']){
                    echo "1";
                }else{
                    echo "0";
                }
            }

        }

    }

?>