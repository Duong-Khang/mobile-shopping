<?php

    class CheckDeleteProductList{

        public function checkDelete($table, $conn, $pid){

            $sql = "SELECT * FROM $table WHERE id='$pid'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if(!$row['delete_at']){
                    echo '1';
                }else{
                    echo '0';
                }
            }

        }

    }

?>