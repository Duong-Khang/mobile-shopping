<?php

use Illuminate\Support\Arr;

class ShowDiscountOld{

        public function getDiscountOld($table, $conn, $did){

            $sql = "SELECT * FROM $table WHERE id='$did'";

            $arr = array();

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $arr[] = array(
                    'discount_name' => $row['name'],
                    'discount_desc' => $row['desc'],
                    'discount_percent' => $row['discount_percent'],
                    'active' => $row['active'],
                    'start_date' => $row['start_date'],
                    'end_date' => $row['end_date']
                );
            }

            die(json_encode($arr));

        }

    }

?>