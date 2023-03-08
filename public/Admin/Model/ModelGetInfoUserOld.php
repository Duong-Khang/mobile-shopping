<?php

    class GetInfoUserOld{

        public function getInfoCustomer($table, $conn, $uid){

            $sql = "SELECT * FROM $table WHERE id='$uid'";

            $result = $conn->query($sql);

            $arr = array();

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();

                $delete = 0;

                if(!$row['delete_at']){
                    $delete = 1;
                }else{
                    $delete = 0;
                }

                $arr[] = array(
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'check' => $delete
                );
            }
            
            die(json_encode($arr));

        }

    }

?>