<?php

    class CheckDeleteDiscount{

        public function checkDiscount($table, $conn, $did){

            $sql = "SELECT * FROM $table WHERE id='$did'";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){

                $row = $result->fetch_assoc();

                if(!$row['delete_at']){
                    echo "1";
                }else{
                    //Update active
                    $sqlu = "UPDATE $table SET active='2' WHERE id='$did'";
                    if($conn->query($sqlu) === TRUE){
                        echo "2";
                    }else{
                        echo "Error";
                    }
                }
            }else{
                echo "Khuyến mãi không tồn tại";
            }

        }

    }

?>