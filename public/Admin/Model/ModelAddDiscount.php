<?php

    class AddDiscount{

        public function addDiscount($table, $conn, $discount_name, $discount_desc, $discount_value, $status, $start_date, $end_date){

            $sql = "INSERT INTO $table(`name`, `desc`, discount_percent, active, `start_date`, `end_date`)
            VALUES('$discount_name', '$discount_desc', '$discount_value', '$status', '$start_date', '$end_date')
            ";
            
            if($conn->query($sql) === TRUE){
                echo "Success";
            }else{
                echo "Thêm thất bại";
            }
        }

    }

?>