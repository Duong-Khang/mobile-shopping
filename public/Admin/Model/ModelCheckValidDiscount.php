<?php

    class CheckValidDiscount{

        public function checkValidDiscount($table, $conn, $day_, $month_, $year_){

            $arr = array();

            $sql = "SELECT * FROM $table";

            $result = $conn->query($sql);

            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $end_date = $row['end_date'];
                    // //Lấy start_date xử lý
                    // $time  = strtotime($row['end_date']);
                    // $month   = date('d',$time);
                    // $day = date('m',$time);
                    // $year  = date('Y',$time);
                    
                    // //Kiểm tra xem hết hạn chưa
                    // $check = $month_.'/'.$day_.'/'.$year_;
                    // //array_push($arr, $end_date);

                    // if(strcmp($end_date, $check) == 0){
                    //     //Tiến hành update
                    //     $sqlu = "UPDATE $table SET active='0' WHERE end_date LIKE '%$end_date%'";
                    //     if($conn->query($sqlu) === TRUE){
                    //         echo "1";
                    //     }else{
                    //         echo "0";
                    //     }
                    // }
                    // else{
                    //     //Tiến hành update
                    //     $sqlu = "UPDATE $table SET active='1' WHERE end_date LIKE '%$end_date%'";
                    //     if($conn->query($sqlu) === TRUE){
                    //         echo "1";
                    //     }else{
                    //         echo "0";
                    //     }
                    // }   
                    array_push($arr, $end_date);
                }
            }

            die(json_encode($arr));

        }

    }

?>