<?php

    class CheckDiscountAdd{

        public function checkDiscountAdd($table, $conn, $discount_name, $discount_value){

            $sql = "SELECT * FROM $table WHERE `name`='$discount_name' OR discount_percent='$discount_value'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                echo "0";
            }else{
                echo "1";
            }

        }

    }

?>