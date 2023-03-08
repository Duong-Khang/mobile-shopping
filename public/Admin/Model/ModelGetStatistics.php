<?php

    class GetStatistics{

        public function getStatistics($table, $conn, $year_){

            $arr = array();

            $totalSell = 0;
            $totalAvg = 0;
            $quantityOrder = 0;

            if($year_ == "all"){
                //Tính tổng doanh thu
                $countAvg = 0;

                $sql = "SELECT * FROM $table";

                $result = $conn->query($sql);

                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        $totalSell += $row['spend'];
                        $countAvg++;
                        $quantityOrder++;
                    }
                }else{
                    $countAvg = 1;
                }
                //Tính trị giá đặt hàng trung bình
                $totalAvg = $totalSell/$countAvg;
                //Trả về json
                $arr[] = array(
                    'totalsell' => $totalSell,
                    'totalavg' => $totalAvg,
                    'ordernum' => $quantityOrder
                );
                die(json_encode($arr));
            }else{
                $countAvg = 0;

                $sql = "SELECT * FROM $table";

                $result = $conn->query($sql);

                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        //Lấy create_date xử lý
                        $time  = strtotime($row['created_date']);
                        $day   = date('d',$time);
                        $month = date('m',$time);
                        $year  = date('Y',$time);
                        //Tính tổng tiền theo từng tháng của năm hiện tại
                        if($year == $year_){
                            //Trả về json
                            $countAvg++;
                            $totalSell += $row['spend'];
                            $quantityOrder++;
                        }
                    }
                }else{
                    $countAvg = 1;
                }
                $totalAvg = $totalSell/$countAvg;
                $arr[] = array(
                    'totalsell' => $totalSell,
                    'totalavg' => $totalAvg,
                    'ordernum' => $quantityOrder
                );         
                die(json_encode($arr));   
            }

            
        }
    }

?>