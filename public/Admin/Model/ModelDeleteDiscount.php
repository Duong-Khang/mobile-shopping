<?php

    class DeleteDiscount{

        public function removeDiscount($table, $conn, $did){

            $arr = array();

            $sql = "SELECT * FROM $table WHERE id='$did'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){

                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $delete_at = date("m/d/Y h:ia");

                $sqlu = "UPDATE $table SET active='2',delete_at='$delete_at' WHERE id='$did'";

                if($conn->query($sqlu) === TRUE){
                    $arr[] = array(
                        'active' => '2',
                        'delete_at' => $delete_at
                    );
                    die(json_encode($arr));
                }else{
                    echo "Error";
                }           
            }else{
                echo "Error";
            }

        }

    }

?>