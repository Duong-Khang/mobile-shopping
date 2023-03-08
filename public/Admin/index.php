<?php
ob_start();
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
  <meta charSet="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <title>Trang chủ</title><!-- icon -->
  <link rel="icon" type="image/png" href="images/favicon.png" /><!-- fonts -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" />
  <!-- css -->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.ltr.css" />
  <link rel="stylesheet" href="vendor/highlight.js/styles/github.css" />
  <link rel="stylesheet" href="vendor/simplebar/simplebar.min.css" />
  <link rel="stylesheet" href="vendor/quill/quill.snow.css" />
  <link rel="stylesheet" href="vendor/air-datepicker/css/datepicker.min.css" />
  <link rel="stylesheet" href="vendor/select2/css/select2.min.css" />
  <link rel="stylesheet"
    href="vendor/datatables/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css" />
  <link rel="stylesheet" href="vendor/fullcalendar/main.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script async=""
    src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-97489509-8');
  </script>
</head>

<body>
  <!-- sa-app -->
  <div
    class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
    <!-- sa-app__sidebar -->
    <?php include "layout/sidebar-left.php" ?>
    <!-- sa-app__content -->
    <div class="sa-app__content">
      <!-- sa-app__toolbar -->
      <?php include "layout/app-tool-bar.php" ?>
      <!-- sa-app__body -->
      <div id="top" class="sa-app__body px-2 px-lg-4">
        <div class="container pb-6">
          <div class="py-5">
            <div class="row g-4 align-items-center">
              <div class="col">
                <h1 class="h3 m-0"></h1>
              </div>
              <h6 class="col-auto d-flex">Thống kê theo tháng:</h6>
              <div class="col-auto d-flex">
                <select id="ThongKeTheoThang" class="form-select me-3">
                  <!-- Lấy năm trong bảng order details -->
                  <?php
                  $arr = array();
                  $sqlGetYear = "SELECT * FROM order_details";
                  $resultGetYear = $conn->query($sqlGetYear);
                  if ($resultGetYear->num_rows > 0) {
                    while ($rowGetYear = $resultGetYear->fetch_assoc()) {
                      $y = $rowGetYear['created_date'];
                      $d = strtotime("$y");
                      $i = date("Y", $d);
                      $m = date("m", $d);
                      array_push($arr, $m . '/' . $i);
                    }
                  }

                  $arr = array_unique($arr);
                  $arr = array_values($arr);
                  $len = count($arr);

                  //lặp qua mảng
                  for ($j = 0; $j < $len; $j++) {
                    echo '<option value="' . $arr[$j] . '">' . $arr[$j] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <script>
          $(document).ready(function() {
            var monthAndYear = $("#ThongKeTheoThang").val();
            //Khi load trang lên sẽ hiển thị thống kê đầu tiên
            $.ajax({
              url: "Controller/ControllerFilterMonth.php",
              type: "get",
              dataType: "text",
              data: {
                monthAndYear: monthAndYear
              },
              success: function(result) {
                $("#show_total_order").html(result);
              }
            });

            $("#ThongKeTheoThang").click(function() {
              var monthAndYear = $("#ThongKeTheoThang").val();
              $.ajax({
                url: "Controller/ControllerFilterMonth.php",
                type: "get",
                dataType: "text",
                data: {
                  monthAndYear: monthAndYear
                },
                success: function(result) {
                  $("#show_total_order").html(result);
                }
              });
            });
          });
          </script>
          <div class="row g-4 g-xl-5">
            <div class="col-12 col-md-4 d-flex">
              <div class="card saw-indicator flex-grow-1"
                data-sa-container-query="{&quot;340&quot;:&quot;saw-indicator--size--lg&quot;}">
                <div class="sa-widget-header saw-indicator__header">
                  <h2 class="sa-widget-header__title">Tổng doanh thu</h2>
                </div>
                <div id="show_total_order" class="saw-indicator__body">
                  <!-- <div class="saw-indicator__value">$3799.00</div>
                                    <div class="saw-indicator__delta saw-indicator__delta--rise">
                                        <div class="saw-indicator__delta-direction"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="currentColor">
                                                <path d="M9,0L8,6.1L2.8,1L9,0z"></path>
                                                <circle cx="1" cy="8" r="1"></circle>
                                                <rect x="0" y="4.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.864 4.0858)" width="7.1" height="2"></rect>
                                            </svg></div>
                                        <div class="saw-indicator__delta-value">34.7%</div>
                                    </div>
                                    <div class="saw-indicator__caption">Compared to April 2021</div> -->
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4 d-flex">
              <div class="card saw-indicator flex-grow-1"
                data-sa-container-query="{&quot;340&quot;:&quot;saw-indicator--size--lg&quot;}">
                <div class="sa-widget-header saw-indicator__header">
                  <h2 class="sa-widget-header__title">Trị giá đặt hàng trung
                    bình</h2>
                </div>
                <div id="show_avg_order" class="saw-indicator__body">
                  <!-- <div class="saw-indicator__value">$272.98</div>
                                    <div class="saw-indicator__delta saw-indicator__delta--fall">
                                        <div class="saw-indicator__delta-direction"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="currentColor">
                                                <path d="M2.8,8L8,2.9L9,9L2.8,8z"></path>
                                                <circle cx="1" cy="1" r="1"></circle>
                                                <rect x="0" y="2.5" transform="matrix(0.7071 0.7071 -0.7071 0.7071 3.5 -1.4497)" width="7.1" height="2"></rect>
                                            </svg></div>
                                        <div class="saw-indicator__delta-value">12.0%</div>
                                    </div>
                                    <div class="saw-indicator__caption">Compared to April 2021</div> -->
                </div>
              </div>
            </div>
            <script>
            $(document).ready(function() {
              var monthAndYear = $("#ThongKeTheoThang").val();
              //Khi load trang lên sẽ hiển thị thống kê đầu tiên
              $.ajax({
                url: "Controller/ControllerFilterAvgMonth.php",
                type: "get",
                dataType: "text",
                data: {
                  monthAndYear: monthAndYear
                },
                success: function(result) {
                  $("#show_avg_order").html(result);
                }
              });

              $("#ThongKeTheoThang").click(function() {
                var monthAndYear = $("#ThongKeTheoThang").val();
                //Khi load trang lên sẽ hiển thị thống kê đầu tiên
                $.ajax({
                  url: "Controller/ControllerFilterAvgMonth.php",
                  type: "get",
                  dataType: "text",
                  data: {
                    monthAndYear: monthAndYear
                  },
                  success: function(result) {
                    $("#show_avg_order").html(result);
                  }
                });
              });
            });
            </script>
            <div class="col-12 col-md-4 d-flex">
              <div class="card saw-indicator flex-grow-1"
                data-sa-container-query="{&quot;340&quot;:&quot;saw-indicator--size--lg&quot;}">
                <div class="sa-widget-header saw-indicator__header">
                  <h2 class="sa-widget-header__title">Tổng đơn hàng</h2>
                </div>
                <div id="show_count_order" class="saw-indicator__body">
                  <!-- <div class="saw-indicator__value">578</div>
                                    <div class="saw-indicator__delta saw-indicator__delta--rise">
                                        <div class="saw-indicator__delta-direction"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="currentColor">
                                                <path d="M9,0L8,6.1L2.8,1L9,0z"></path>
                                                <circle cx="1" cy="8" r="1"></circle>
                                                <rect x="0" y="4.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.864 4.0858)" width="7.1" height="2"></rect>
                                            </svg></div>
                                        <div class="saw-indicator__delta-value">27.9%</div>
                                    </div>
                                    <div class="saw-indicator__caption">Compared to April 2021</div> -->
                </div>
              </div>
            </div>
            <script>
            $(document).ready(function() {
              var monthAndYear = $("#ThongKeTheoThang").val();
              //Khi load trang lên sẽ hiển thị thống kê đầu tiên
              $.ajax({
                url: "Controller/ControllerFilterCountOrderMonth.php",
                type: "get",
                dataType: "text",
                data: {
                  monthAndYear: monthAndYear
                },
                success: function(result) {
                  $("#show_count_order").html(result);
                }
              });
              $("#ThongKeTheoThang").click(function() {
                var monthAndYear = $("#ThongKeTheoThang").val();
                //Khi load trang lên sẽ hiển thị thống kê đầu tiên
                $.ajax({
                  url: "Controller/ControllerFilterCountOrderMonth.php",
                  type: "get",
                  dataType: "text",
                  data: {
                    monthAndYear: monthAndYear
                  },
                  success: function(result) {
                    $("#show_count_order").html(result);
                  }
                });
              });
            });
            </script>
            <div class="col-12 col-lg-4 col-xxl-3 d-flex">
              <div class="card flex-grow-1 saw-pulse"
                data-sa-container-query="{&quot;560&quot;:&quot;saw-pulse--size--lg&quot;}">
                <div class="sa-widget-header saw-pulse__header">
                  <h2 class="sa-widget-header__title">Đang online</h2>
                </div>
                <div class="saw-pulse__counter">
                  <!-- Hiển thị khách hàng đang online -->
                  <?php

                  $sqlGetOnline = "SELECT COUNT(*) AS gusetID FROM guest_online";
                  $resultGetOnline = $conn->query($sqlGetOnline);

                  if ($resultGetOnline->num_rows > 0) {
                    $rowGetOnline = $resultGetOnline->fetch_assoc();
                    echo $rowGetOnline['gusetID'];
                  }

                  //Kiểm tra xem khách hàng đó còn hoạt động trong 5' hay không
                  $sqlGetOff = "SELECT * FROM guest_online";
                  $resultGetOff = $conn->query($sqlGetOff);
                  if ($resultGetOff->num_rows > 0) {
                    while ($rowGetOff = $resultGetOff->fetch_assoc()) {
                      $timeOld = $rowGetOff['time_live'];
                      $timec = $rowGetOff['time_live'];
                      $timeNow = time();
                      $timeOld += 300;
                      if ($timeOld <= $timeNow) {
                        //Xóa nó đi
                        $sqlDeleteGuestOff = "DELETE FROM guest_online WHERE time_live='$timec'";
                        $conn->query($sqlDeleteGuestOff);
                      }
                    }
                  }

                  ?>
                </div>
                <div class="sa-widget-table saw-pulse__table">
                  <table>
                    <thead>
                      <tr>
                        <th>Các trang của website</th>
                        <th class="text-end"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="#" class="text-reset">/trang chủ</a></td>
                        <td class="text-end"></td>
                      </tr>
                      <tr>
                        <td><a href="#" class="text-reset">/cart</a></td>
                        <td class="text-end"></td>
                      </tr>
                      <tr>
                        <td><a href="#" class="text-reset">/checkout</a></td>
                        <td class="text-end"></td>
                      </tr>
                      <tr>
                        <td><a href="#" class="text-reset">/order-list</a></td>
                        <td class="text-end"></td>
                      </tr>
                      <tr>
                        <td><a href="#" class="text-reset">/order-details</a>
                        </td>
                        <td class="text-end"></td>
                      </tr>
                      <tr>
                        <td><a href="#" class="text-reset">/product-details</a>
                        </td>
                        <td class="text-end"></td>
                      </tr>
                      <tr>
                        <td><a href="#" class="text-reset">/search-product</a>
                        </td>
                        <td class="text-end"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
              <div class="card flex-grow-1 saw-chart">
                <div class="sa-widget-header saw-chart__header">
                  <h2 id="show_year_all" class="sa-widget-header__title">Thống
                    kê doanh thu từng tháng của năm <span
                      id="hien_thi_theo_nam"><?php echo date("Y") ?></span></h2>
                  <div class="sa-widget-header__actions">
                  </div>
                </div>
                <div id="new_chart" class="saw-chart__body">
                  <div id="save_chart" class="saw-chart__container"><canvas
                      id="myChart" width="654" height="342"
                      style="display: block; box-sizing: border-box; height: 342px; width: 654px;"></canvas>
                  </div>
                </div>
              </div>
              <input type="hidden" id="yearNow" value="<?php echo date("Y") ?>">
            </div>
            <input type="hidden" id="month1" value="0">
            <input type="hidden" id="month2" value="0">
            <input type="hidden" id="month3" value="0">
            <input type="hidden" id="month4" value="0">
            <input type="hidden" id="month5" value="0">
            <input type="hidden" id="month6" value="0">
            <input type="hidden" id="month7" value="0">
            <input type="hidden" id="month8" value="0">
            <input type="hidden" id="month9" value="0">
            <input type="hidden" id="month10" value="0">
            <input type="hidden" id="month11" value="0">
            <input type="hidden" id="month12" value="0">
            <script>
            $(document).ready(function() {
              var year = $("#yearNow").val();
              $.ajax({
                url: "Controller/ControllerGetValueOrder.php",
                type: "get",
                dataType: "json",
                data: {
                  year: year
                },
                success: function(result) {
                  $.each(result, function(key, item) {
                    $("#month1").val(item['1']);
                    $("#month2").val(item['2']);
                    $("#month3").val(item['3']);
                    $("#month4").val(item['4']);
                    $("#month5").val(item['5']);
                    $("#month6").val(item['6']);
                    $("#month7").val(item['7']);
                    $("#month8").val(item['8']);
                    $("#month9").val(item['9']);
                    $("#month10").val(item['10']);
                    $("#month11").val(item['11']);
                    $("#month12").val(item['12']);
                    var month1 = $("#month1").val();
                    var month2 = $("#month2").val();
                    var month3 = $("#month3").val();
                    var month4 = $("#month4").val();
                    var month5 = $("#month5").val();
                    var month6 = $("#month6").val();
                    var month7 = $("#month7").val();
                    var month8 = $("#month8").val();
                    var month9 = $("#month9").val();
                    var month10 = $("#month10").val();
                    var month11 = $("#month11").val();
                    var month12 = $("#month12").val();
                    var xValues = ["1", "2", "3", "4", "5", "6",
                      "7", "8", "9", "10", "11", "12"
                    ];
                    var yValues = [month1, month2, month3, month4,
                      month5, month6, month7, month8, month9,
                      month10, month11, month12
                    ];
                    var barColors = ["#ffd333", "#ffd333",
                      "#ffd333", "#ffd333", "#ffd333",
                      "#ffd333", "#ffd333", "#ffd333",
                      "#ffd333", "#ffd333", "#ffd333", "#ffd333"
                    ];
                    const data = {
                      labels: xValues,
                      datasets: [{
                        label: 'Doanh thu theo tháng',
                        data: yValues,
                        backgroundColor: barColors
                      }]
                    };
                    var chart = new Chart("myChart", {
                      type: "bar",
                      data: data,
                      options: {
                        legend: {
                          display: false
                        },
                        title: {
                          display: true,
                          text: "fsfg"
                        }
                      }
                    });

                  });

                }
              });
            });
            </script>
            <div class="col-12 col-xxl-9 d-flex">
              <div class="card flex-grow-1 saw-table">
                <div class="sa-widget-header saw-table__header">
                  <h2 id="show_title_order" class="sa-widget-header__title">Các
                    đơn hàng gần đây</h2>
                </div>
                <div class="saw-table__body sa-widget-table text-nowrap">
                  <table>
                    <thead>
                      <tr>
                        <th>Mã đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiền</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //Hiển thị danh sách đơn hàng ở đây
                      $sqlOrder = "SELECT * FROM order_details";
                      $resultOrder = $conn->query($sqlOrder);
                      if ($resultOrder->num_rows > 0) {
                        while ($rowOrder = $resultOrder->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><a
                            href="../Admin/order-details.php?order_id=<?php echo $rowOrder['id'] ?>"
                            class="text-reset">#<?php echo $rowOrder['id'] ?></a>
                        </td>
                        <td>
                          <?php
                              if ($rowOrder['delete_at'] != NULL) {
                                echo '<div class="d-flex fs-6">
                                                                    <div class="badge badge-sa-danger">Đã hủy</div>
                                                                </div>';
                              } else if ($rowOrder['status'] == '1' && $rowOrder['delete_at'] == NULL) {
                                echo '<div class="d-flex fs-6">
                                                                    <div class="badge badge-sa-primary">Đang chờ xử lý</div>
                                                                </div>';
                              } else if ($rowOrder['status'] == '0' && $rowOrder['delete_at'] == NULL) {
                                echo '<div class="d-flex fs-6">
                                                                    <div class="badge badge-sa-success">Đã xử lý</div>
                                                                </div>';
                              }
                              ?>
                        </td>

                        <td>
                          <div class="d-flex align-items-center"><a
                              href="../Admin/customer-details.php?uid=<?php echo $rowOrder['user_id'] ?>"
                              class="sa-symbol sa-symbol--shape--circle sa-symbol--size--md me-3">
                              <div class="sa-symbol__text"><i
                                  class="far fa-user"></i></div>
                            </a>
                            <div><a
                                href="../Admin/customer-details.php?uid=<?php echo $rowOrder['user_id'] ?>"
                                class="text-reset">
                                <?php
                                    //Lấy tên customer
                                    $user_id = $rowOrder['user_id'];
                                    $oid = $rowOrder['id'];
                                    $sqlCustomer = "SELECT * FROM user_address WHERE user_id='$user_id' AND order_id='$oid'";
                                    $resultCustomer = $conn->query($sqlCustomer);
                                    if ($resultCustomer->num_rows > 0) {
                                      $rowCustomer = $resultCustomer->fetch_assoc();
                                      echo $rowCustomer['fullname'];
                                    }
                                    ?>
                              </a></div>
                          </div>
                        </td>
                        <td><?php echo $rowOrder['order_date'] ?></td>
                        <td><?php echo $rowOrder['total'] ?></td>
                      </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- col-12 col-xxl-3 d-flex -->
            <div class="col-12">
              <div class="card flex-grow-1">
                <div class="card-body">
                  <div class="sa-widget-header">
                    <h2 class="sa-widget-header__title">Những đánh giá gần đây
                    </h2>
                  </div>
                </div>
                <ul class="list-group list-group-flush">
                  <?php
                  //Hiển thị những sản phẩm có đánh giá
                  $sqlRating = "SELECT COUNT(product_id) AS creviews, rating.*, product.id, product.name, product.photo_name
                                        FROM rating
                                        INNER JOIN product ON product.id=rating.product_id
                                        GROUP BY product_id
                                        ";
                  $resultRating = $conn->query($sqlRating);
                  if ($resultRating->num_rows > 0) {
                    while ($rowRating = $resultRating->fetch_assoc()) {
                  ?>
                  <li class="list-group-item py-2">
                    <div class="d-flex align-items-center py-3"><a
                        href="/product-details?pid=<?php echo $rowRating['product_id'] ?>"
                        class="me-4">
                        <div
                          class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                          <img
                            src="/product_images/<?php echo $rowRating['photo_name'] ?>"
                            width="40" height="40" alt="" />
                        </div>
                      </a>
                      <div
                        class="d-flex align-items-center flex-grow-1 flex-wrap">
                        <div class="col"><a
                            href="/product-details?pid=<?php echo $rowRating['product_id'] ?>"
                            class="text-reset fs-exact-14"><?php echo $rowRating['name'] ?></a>
                          <div class="text-muted fs-exact-13"><a href="#"
                              class="text-reset">Có
                              <?php echo $rowRating['creviews'] ?> nhận xét</a>
                          </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <?php
                              //total vs count
                              $total = 0;
                              $count = 0;
                              //Xử lý hiển thị số sao rating
                              $pid = $rowRating['product_id'];
                              $sqlAvg = "SELECT * FROM rating WHERE product_id='$pid'";
                              $resultAvg = $conn->query($sqlAvg);
                              if ($resultAvg->num_rows > 0) {
                                while ($rowAvg = $resultAvg->fetch_assoc()) {
                                  $count++;
                                  $total += $rowAvg['star'];
                                }
                              }
                              //Kiểm tra xem mấy sao
                              $avg = $total / $count;
                              if ($avg == 1) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:0.2">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              } else if ($avg == 2) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:0.4">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              } else if ($avg == 3) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:0.6">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              } else if ($avg == 4) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:0.8">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              } else if ($avg == 5) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:1">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              } else if ($avg > 1 && $avg < 2) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:0.3">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              } else if ($avg > 2 && $avg < 3) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:0.5">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              } else if ($avg > 3 && $avg < 4) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:0.7">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              } else if ($avg > 4 && $avg < 5) {
                                echo '<div class="sa-rating ms-sm-3 my-2 my-sm-0"
                                                                    style="--sa-rating--value:0.9">
                                                                    <div class="sa-rating__body"></div>
                                                                </div>';
                              }
                              ?>

                        </div>
                      </div>
                    </div>
                  </li>
                  <?php
                    }
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div><!-- sa-app__body / end -->
      <!-- sa-app__footer -->
      <?php include "layout/footer.php" ?>
    </div><!-- sa-app__content / end -->
    <!-- sa-app__toasts -->
    <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
    <!-- sa-app__toasts / end -->
  </div><!-- sa-app / end -->
  <!-- scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/feather-icons/feather.min.js"></script>
  <script src="vendor/simplebar/simplebar.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/highlight.js/highlight.pack.js"></script>
  <script src="vendor/quill/quill.min.js"></script>
  <script src="vendor/air-datepicker/js/datepicker.min.js"></script>
  <script src="vendor/air-datepicker/js/i18n/datepicker.en.js"></script>
  <script src="vendor/select2/js/select2.min.js"></script>
  <script src="vendor/fontawesome/js/all.min.js" data-auto-replace-svg=""
    async=""></script>
  <script src="vendor/chart.js/chart.min.js"></script>
  <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/js/dataTables.bootstrap5.min.js"></script>
  <script src="vendor/nouislider/nouislider.min.js"></script>
  <script src="vendor/fullcalendar/main.min.js"></script>
  <script src="js/stroyka.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/calendar.js"></script>
  <script src="js/demo.js"></script>
  <script src="js/demo-chart-js.js"></script>
</body>

</html>
<?php
ob_flush();
?>