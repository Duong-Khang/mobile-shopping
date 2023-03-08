<?php
ob_start();
session_start();
include "connect.php";
//Lấy order_id
$order_id = 0;
if (isset($_GET['order_id']) && $_GET['order_id'] !== '') {
    $order_id = $_GET['order_id'];
} else {
    header("location: ../Admin/app-order-list.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
  <meta charSet="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <title>Chi tiết đơn hàng</title><!-- icon -->
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
      <?php
            $sql = "SELECT * FROM order_details WHERE id='$order_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            ?>
      <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
          <div class="container container--max--xl">
            <div class="py-5">
              <div class="row g-4 align-items-center">
                <div class="col">
                  <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                      <li class=""><a href="../Admin/">Trang chủ</a></li>
                      <li class=""><a href="../Admin/app-order-list.php"> / Danh
                          sách đơn đặt hàng</a></li>
                      <li class="" aria-current="page"> /
                        #<?php echo $order_id ?></li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
            <div class="sa-page-meta mb-5">
              <div class="sa-page-meta__body">
                <div class="sa-page-meta__list">
                  <div class="sa-page-meta__item">Ngày đặt hàng
                    <?php echo $row['order_date'] ?></div>
                  <div class="sa-page-meta__item">
                    <?php
                                            $sumQuantity = 0;
                                            $sqli = "SELECT * FROM order_items WHERE order_id='$order_id'";
                                            $resulti = $conn->query($sqli);
                                            if ($resulti->num_rows > 0) {
                                                while ($rowi = $resulti->fetch_assoc()) {
                                                    $sumQuantity += $rowi['quantity'];
                                                }
                                            }
                                            echo $sumQuantity . ' sản phẩm';
                                            ?>
                  </div>
                  <div class="sa-page-meta__item">Tổng
                    <?php echo $row['total'] ?></div>
                  <div
                    class="sa-page-meta__item d-flex align-items-center fs-6">
                    <span class="badge badge-sa-success me-2">
                      <?php
                                                if ($row['delete_at'] != NULL) {
                                                    echo "Đã hủy";
                                                } else {
                                                    if ($row['status'] == 1) {
                                                        echo "Đang chờ xử lý";
                                                    } else if ($row['status'] == 0) {
                                                        echo "Đã xử lý";
                                                    }
                                                }

                                                ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="sa-entity-layout"
              data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;}">
              <div class="sa-entity-layout__body">
                <div class="sa-entity-layout__main">
                  <div class="card sa-card-area">
                    <div
                      class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                      <h2 class="mb-0 fs-exact-18 me-4">Sản phẩm</h2>
                    </div>
                    <div class="table-responsive">
                      <table class="sa-table">
                        <tbody>
                          <!-- Hiển thị danh sách item  -->
                          <tr>
                            <td>Tên sản phẩm</td>
                            <td>Màu</td>
                            <td>Giá</td>
                            <td>Số lượng</td>
                            <td>Tổng</td>
                          </tr>
                          <?php
                                                        $sql1 = "SELECT * FROM order_items WHERE order_id='$order_id'";
                                                        $result1 = $conn->query($sql1);
                                                        if ($result1->num_rows > 0) {
                                                            while ($row1 = $result1->fetch_assoc()) {
                                                                //Lấy ảnh và tên sản phẩm
                                                                $color = $row1['color'];
                                                                $pid = $row1['product_id'];
                                                                $sql2 = "SELECT product.name, product.id, product.discount_id, `description`.*
                                                                FROM `description`
                                                                INNER JOIN product ON product.id = `description`.product_id
                                                                WHERE `description`.product_id = '$pid'
                                                                ";
                                                                $result2 = $conn->query($sql2);
                                                                if ($result2->num_rows > 0) {
                                                                    while ($row2 = $result2->fetch_assoc()) {
                                                                        //lấy discount
                                                                        $discount_id = $row2['discount_id'];
                                                                        $sql3 = "SELECT * FROM discount WHERE id='$discount_id'";
                                                                        $result3 = $conn->query($sql3);
                                                                        if ($result3->num_rows > 0) {
                                                                            while ($row3 = $result3->fetch_assoc()) {
                                                        ?>
                          <tr>
                            <td class="min-w-20x">
                              <div class="d-flex align-items-center"><img
                                  src="/product_images_desc/<?php
                                                                                                                                                                if ($row2['dcolor1'] == $row1['color']) {
                                                                                                                                                                    echo $row2['photo_color1'];
                                                                                                                                                                } else if ($row2['dcolor2'] == $row1['color']) {
                                                                                                                                                                    echo $row2['photo_color2'];
                                                                                                                                                                } else if ($row2['dcolor3'] == $row1['color']) {
                                                                                                                                                                    echo $row2['photo_color3'];
                                                                                                                                                                }
                                                                                                                                                                ?>"
                                  class="me-4" width="40" height="40"
                                  alt="" /><a
                                  href="/product-details?pid=<?php echo $row2['id'] ?>"
                                  class="text-reset"><?php echo $row2['name'] ?></a>
                              </div>
                            </td>
                            <td><?php echo $row1['color'] ?></td>
                            <td class="text-end">
                              <div class="sa-price">
                                <span class="sa-price__symbol">
                                  <?php
                                                                                                if (strpos($row1['color'], $row2['dcolor1']) !== false) {
                                                                                                    if ($row3['active'] == 1) {
                                                                                                        echo number_format(($row2['price_color1'] * (100 - $row1['discount_percent_available'])) / 100);
                                                                                                    } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                        echo number_format($row2['price_color1']);
                                                                                                    }
                                                                                                } else if (strpos($row1['color'], $row2['dcolor2']) !== false) {
                                                                                                    if ($row3['active'] == 1) {
                                                                                                        echo number_format(($row2['price_color2'] * (100 - $row1['discount_percent_available'])) / 100);
                                                                                                    } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                        echo number_format($row2['price_color2']);
                                                                                                    }
                                                                                                } else if (strpos($row1['color'], $row2['dcolor3']) !== false) {
                                                                                                    if ($row3['active'] == 1) {
                                                                                                        echo number_format(($row2['price_color3'] * (100 - $row1['discount_percent_available'])) / 100);
                                                                                                    } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                        echo number_format($row2['price_color3']);
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                </span>
                              </div>
                            </td>

                            <td class="text-end"><?php echo $row1['quantity'] ?>
                            </td>
                            <td class="text-end">
                              <div class="sa-price"><span
                                  class="sa-price__symbol">
                                  <?php
                                                                                                if (strpos($row1['color'], $row2['dcolor1']) !== false) {
                                                                                                    if ($row3['active'] == 1) {
                                                                                                        echo number_format(((($row2['price_color1'] * (100 - $row1['discount_percent_available'])) / 100)) * $row1['quantity']);
                                                                                                    } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                        echo number_format($row2['price_color1'] * $row1['quantity']);
                                                                                                    }
                                                                                                } else if (strpos($row1['color'], $row2['dcolor2']) !== false) {
                                                                                                    if ($row3['active'] == 1) {
                                                                                                        echo number_format(((($row2['price_color2'] * (100 - $row1['discount_percent_available'])) / 100) * $row1['quantity']));
                                                                                                    } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                        echo number_format($row2['price_color2'] * $row1['quantity']);
                                                                                                    }
                                                                                                } else if (strpos($row1['color'], $row2['dcolor3']) !== false) {
                                                                                                    if ($row3['active'] == 1) {
                                                                                                        echo number_format(((($row2['price_color3'] * (100 - $row1['discount_percent_available'])) / 100) * $row1['quantity']));
                                                                                                    } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                        echo number_format($row2['price_color3'] * $row1['quantity']);
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                </span>
                              </div>
                            </td>
                          </tr>
                          <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                        </tbody>
                        <tbody class="sa-table__group">
                          <tr>
                            <td colSpan="3">Tạm tính</td>
                            <td class="text-end">
                              <div class="sa-price"><span
                                  class="sa-price__symbol"><?php
                                                                                                                        //Hiển thị tạm tính
                                                                                                                        $sqlGet = "SELECT * FROM my_discount_code WHERE code_order='$order_id'";
                                                                                                                        $resultGet = $conn->query($sqlGet);
                                                                                                                        if ($resultGet->num_rows > 0) {
                                                                                                                            $rowGet = $resultGet->fetch_assoc();
                                                                                                                            $t = $row['spend'] + $rowGet['value_code'];
                                                                                                                            echo number_format($t) . ' đ';
                                                                                                                        } else {
                                                                                                                            echo $row['total'];
                                                                                                                        }
                                                                                                                        ?></span>
                              </div>
                            </td>
                          </tr>
                          <tr>
                          </tr>
                          <tr>
                          </tr>
                        </tbody>
                        <tbody>
                          <tr>
                            <td colSpan="3">Giảm giá</td>
                            <td class="text-end">
                              <div class="sa-price"><span
                                  class="sa-price__symbol">
                                  <?php
                                                                        //Lấy số tiền dc giảm nếu có
                                                                        $sql4 = "SELECT * FROM my_discount_code WHERE code_order='$order_id'";
                                                                        $result4 = $conn->query($sql4);
                                                                        if ($result4->num_rows > 0) {
                                                                            $row4 = $result4->fetch_assoc();
                                                                            echo number_format($row4['value_code']) . ' đ';
                                                                        } else {
                                                                            echo '0 đ';
                                                                        }
                                                                        ?>
                                </span>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colSpan="3">Thành tiền</td>
                            <td class="text-end">
                              <div class="sa-price"><span
                                  class="sa-price__symbol"><?php echo $row['total'] ?></span>
                              </div>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="sa-entity-layout__sidebar">
                  <div class="card">
                    <div
                      class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                      <h2 class="fs-exact-16 mb-0">Khách hàng</h2>
                    </div>
                    <div class="card-body d-flex align-items-center pt-4">
                      <div
                        class="sa-symbol sa-symbol--shape--circle sa-symbol--size--lg">
                        <img src="images/user1.png" width="40" height="40"
                          alt="" /></div>
                      <a style="text-decoration: none;"
                        href="../Admin/customer-details.php?uid=<?php echo $row['user_id'] ?>">
                        <div class="ms-3 ps-2">
                          <div class="fs-exact-14 fw-medium">
                            <?php
                                                            $uid = $row['user_id'];
                                                            $sqli = "SELECT * FROM user WHERE id='$uid'";
                                                            $resulti = $conn->query($sqli);
                                                            if ($resulti->num_rows > 0) {
                                                                $rowi = $resulti->fetch_assoc();
                                                                echo strtoupper($rowi['username']);
                                                            }
                                                            ?>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="card mt-5">
                    <div
                      class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                      <h2 class="fs-exact-16 mb-0">Thông tin liên lạc</h2>
                    </div>
                    <?php
                                            $sqli = "SELECT * FROM user_address WHERE user_id='$uid' AND order_id='$order_id'";
                                            $resulti = $conn->query($sqli);
                                            if ($resulti->num_rows > 0) {
                                                $rowi = $resulti->fetch_assoc();
                                            ?>
                    <div class="card-body pt-4 fs-exact-14">
                      <div><?php echo $rowi['fullname'] ?></div>
                      <div class="mt-1"><?php echo $rowi['email'] ?></div>
                      <div class="text-muted mt-1"><?php echo $rowi['mobile'] ?>
                      </div>
                    </div>
                    <?php
                                            }
                                            ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- sa-app__body / end -->
      <?php
            }
            ?>
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