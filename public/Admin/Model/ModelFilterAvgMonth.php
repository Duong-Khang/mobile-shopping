<?php

    class FilterAvgMonth{

        public function getAvg($table, $conn, $monthAndYear){

            $my = explode("/", $monthAndYear);

            $m = $my[0];

            $y = $my[1];

            $totalAvg = 0;
            $countAvg = 0;

            $sql = "SELECT * FROM $table WHERE delete_at IS NULL";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //Lấy create_date xử lý
                    $time  = strtotime($row['created_date']);
                    $day   = date('d', $time);
                    $month = date('m', $time);
                    $year  = date('Y', $time);
                    //Tính tổng tiền theo từng tháng của năm hiện tại
                    if ($y == $year && $m == $month) {
                        $totalAvg += $row['spend'];
                        $countAvg++;
                    }
                }
            } else {
                $totalAvg = 0;
                $countAvg = 1;
            }
            $sumAvg = $totalAvg/$countAvg;

            $totalAfter = 0;
            $countAfter = 0;
            $sql = "SELECT * FROM $table WHERE delete_at IS NULL";

            $result = $conn->query($sql);
            $ma = $m - 1;
            $ya = $y - 1;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //Lấy create_date xử lý
                    $time  = strtotime($row['created_date']);
                    $day   = date('d', $time);
                    $month = date('m', $time);
                    $year  = date('Y', $time);
                    //Lấy doanh thu tháng trước nó
                    if ($ma == 0) {
                        $ma = 12;
                        if ($ma == $month && $ya == $year) {
                            $totalAfter += $row['spend'];
                            $countAfter++;
                        }
                    } else {
                        if ($ma == $month && $y == $year) {
                            $totalAfter += $row['spend'];
                            $countAfter++;
                        }
                    }
                }
            }else{
                $totalAfter = 0;
                $countAfter = 1;
            }
            if($countAfter == 0){
                $countAfter = 1;
            }
            $sumAvgAfter = $totalAfter/$countAfter;
            if ($sumAvgAfter == 0) {
                echo '<div class="saw-indicator__value">' . number_format($sumAvg) . ' đ</div>';
            } else {
                $per = (($sumAvg - $sumAvgAfter) / $sumAvgAfter) * 100;
                $per = round($per, 2);
                if ($per <= 0) {
                    echo '
                        <div class="saw-indicator__value">' . number_format($sumAvg) . ' đ</div>
                        <div class="saw-indicator__delta saw-indicator__delta--fall">
                            <div class="saw-indicator__delta-direction"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="currentColor">
                                    <path d="M2.8,8L8,2.9L9,9L2.8,8z"></path>
                                    <circle cx="1" cy="1" r="1"></circle>
                                    <rect x="0" y="2.5" transform="matrix(0.7071 0.7071 -0.7071 0.7071 3.5 -1.4497)" width="7.1" height="2"></rect>
                                </svg></div>
                            <div class="saw-indicator__delta-value">' . -$per . '%</div>
                        </div>
                        <div class="saw-indicator__caption">So sánh với tháng ' . $ma . ' năm ' . $y . '</div>
                        ';
                } else {
                    echo '
                        <div class="saw-indicator__value">' . number_format($sumAvg) . ' đ</div>
                        <div class="saw-indicator__delta saw-indicator__delta--rise">
                            <div class="saw-indicator__delta-direction"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="currentColor">
                                    <path d="M9,0L8,6.1L2.8,1L9,0z"></path>
                                    <circle cx="1" cy="8" r="1"></circle>
                                    <rect x="0" y="4.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.864 4.0858)" width="7.1" height="2"></rect>
                                </svg></div>
                            <div class="saw-indicator__delta-value">' . $per . '%</div>
                        </div>
                        <div class="saw-indicator__caption">So sánh với tháng ' . $ma . ' năm ' . $y . '</div>
                    ';
                }
            }

        }

    }
?>