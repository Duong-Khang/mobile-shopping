<?php

    class DiscountTimeExpired{

        public function updateStatus($table, $conn, $end_date){

            $sql = "UPDATE $table SET active='0' WHERE end_date LIKE '%$end_date%' AND delete_at IS NULL";

            if($conn->query($sql) === TRUE){
                echo "1";
            }else{
                echo "0";
            }

        }

    }

?>