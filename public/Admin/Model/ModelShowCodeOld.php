<?php

    class ShowCodeOld{

        public function showCode($table, $conn, $cid){

            $arr = array();

            $sql = "SELECT * FROM $table WHERE id='$cid'";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){
                $row = $result->fetch_assoc();
                $arr[] = array(
                    'dis_code' => $row['dis_code'],
                    'status_code' => $row['status_code'],
                    'value_code' => $row['value_code'],
                    'start_date' => $row['start_date'],
                    'end_date' => $row['end_date']
                );
            }else{
                echo "Mã khuyến mãi không tồn tại";
            }

            die(json_encode($arr));

        }

    }

?>