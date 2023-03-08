<?php

    class CodeTimeExpired{

        public function updateStatus($table, $conn, $end_date){

            $sql = "UPDATE $table SET status_code='2' WHERE end_date LIKE '%$end_date%' AND delete_at IS NULL";

            if($conn->query($sql) === TRUE){
                echo "1";
            }else{
                echo "0";
            }

        }

    }

?>