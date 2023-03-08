<?php

    class DeleteCode{

        public function removeCode($table, $conn, $cid){

            $arr = array();

            $sql = "SELECT * FROM $table WHERE id='$cid'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){

                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $delete_at = date("m/d/Y h:ia");

                $sqlu = "UPDATE $table SET status_code='3',delete_at='$delete_at' WHERE id='$cid'";

                if($conn->query($sqlu) === TRUE){
                    $arr[] = array(
                        'status_code' => '3',
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