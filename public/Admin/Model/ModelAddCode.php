<?php

    class AddCode{

        public function addCode($table, $conn, $code, $value, $status, $start_date, $end_date){

            $sql = "SELECT * FROM $table WHERE dis_code='$code'";

            $result = $conn->query($sql);

            if($result -> num_rows > 0){
                echo "Mã khuyến mãi đã tồn tại";
            }else{
                //Insert
                $sqli = "INSERT INTO $table(dis_code, status_code, value_code, `start_date`, `end_date`)
                VALUES('$code', '$status', '$value', '$start_date', '$end_date')
                ";
                if($conn->query($sqli) === TRUE){
                    echo "Success";
                }else{
                    echo "Thêm thất bại";
                }
            }

        }

    }
