<?php

    class CheckDeleteCode{

        public function checkDeleteCode($table, $conn, $cid){

            $sql = "SELECT * FROM $table WHERE id='$cid'";

            $result = $conn->query($sql);


            if($result->num_rows > 0){
                $row = $result->fetch_assoc();

                if(!$row['delete_at']){
                    echo "1";
                }else{
                    //Update status_code
                    $sqlu = "UPDATE $table SET status_code='3' WHERE id='$cid'";

                    if($conn->query($sqlu) === TRUE){
                        echo "3";
                    }else{
                        echo "1";
                    }
                }
            }else{
                echo "Mã giảm giá không tồn tại";
            }

        }

    }

?>