<?php

class GetValue{

        public function getValueOrder($table, $conn, $year_){

            $arr = array();

            $t1 = 0;
            $t2 = 0;
            $t3 = 0;
            $t4 = 0;
            $t5 = 0;
            $t6 = 0;
            $t7 = 0;
            $t8 = 0;
            $t9 = 0;
            $t10 = 0;
            $t11 = 0;
            $t12 = 0;
           
            //Lấy năm hiện tại
            $yearNow = $year_;
            if($year_ == "all"){
                //$yearNow = date("Y");
                $sql = "SELECT * FROM order_details";

                $result = $conn->query($sql);

                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        //Lấy create_date xử lý
                        $time  = strtotime($row['created_date']);
                        $day   = date('d',$time);
                        $month = date('m',$time);
                        $year  = date('Y',$time);
                        //Tính tổng tiền theo từng tháng của năm hiện tại
                        if($month == 1){
                            $t1 += $row['spend'];
                        }
                        if($month == 2){
                            $t2 += $row['spend'];
                        }
                        if($month == 3){
                            $t3 += $row['spend'];
                        }
                        if($month == 4){
                            $t4 += $row['spend'];
                        }

                        if($month == 5){
                            $t5 += $row['spend'];
                        }
                        if($month == 6){
                            $t6 += $row['spend'];
                        }
                        if($month == 7){
                            $t7 += $row['spend'];
                        }
                        if($month == 8){
                            $t8 += $row['spend'];
                        }

                        if($month == 9){
                            $t9 += $row['spend'];
                        }
                        if($month == 10){
                            $t10 += $row['spend'];
                        }
                        if($month == 11){
                            $t11 += $row['spend'];
                        }
                        if($month == 12){
                            $t12 += $row['spend'];
                        }   
                    }
                }

                $arr[] = array(
                    '1' => $t1,
                    '2' => $t2,
                    '3' => $t3,
                    '4' => $t4,
                    '5' => $t5,
                    '6' => $t6,
                    '7' => $t8,
                    '9' => $t9,
                    '10' => $t10,
                    '11' => $t11,
                    '12' => $t12,
                    'year' => $year_
                );
    
                die(json_encode($arr));
            }
            

            $sql = "SELECT * FROM order_details";

            $result = $conn->query($sql);

            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    //Lấy create_date xử lý
                    $time  = strtotime($row['created_date']);
                    $day   = date('d',$time);
                    $month = date('m',$time);
                    $year  = date('Y',$time);
                    //Tính tổng tiền theo từng tháng của năm hiện tại
                    if($year == $yearNow){
                        if($month == 1){
                            $t1 += $row['spend'];
                        }
                        if($month == 2){
                            $t2 += $row['spend'];
                        }
                        if($month == 3){
                            $t3 += $row['spend'];
                        }
                        if($month == 4){
                            $t4 += $row['spend'];
                        }

                        if($month == 5){
                            $t5 += $row['spend'];
                        }
                        if($month == 6){
                            $t6 += $row['spend'];
                        }
                        if($month == 7){
                            $t7 += $row['spend'];
                        }
                        if($month == 8){
                            $t8 += $row['spend'];
                        }

                        if($month == 9){
                            $t9 += $row['spend'];
                        }
                        if($month == 10){
                            $t10 += $row['spend'];
                        }
                        if($month == 11){
                            $t11 += $row['spend'];
                        }
                        if($month == 12){
                            $t12 += $row['spend'];
                        }
                    }
                    
                }
            }

            $arr[] = array(
                '1' => $t1,
                '2' => $t2,
                '3' => $t3,
                '4' => $t4,
                '5' => $t5,
                '6' => $t6,
                '7' => $t8,
                '9' => $t9,
                '10' => $t10,
                '11' => $t11,
                '12' => $t12,
                'year' => $year_
            );

            die(json_encode($arr));

        }

    }

?>