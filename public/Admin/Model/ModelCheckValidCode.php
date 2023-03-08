<?php

    class CheckValidCode{

        public function checkValidCode($table, $conn, $day_, $month_, $year_){

            $arr = array();

            $sql = "SELECT * FROM $table";

            $result = $conn->query($sql);

            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $end_date = $row['end_date'];
                    array_push($arr, $end_date);
                }
            }

            die(json_encode($arr));

        }

    }

?>