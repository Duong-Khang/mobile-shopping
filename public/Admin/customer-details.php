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
  <title>Chi tiết khách hàng</title><!-- icon -->
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
      <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
          <div class="container container--max--xl">
            <?php
                        //Lấy uid
                        $uid = 0;
                        if (isset($_GET['uid']) && $_GET['uid'] !== '') {
                            $uid = $_GET['uid'];
                        } else {
                            header("location: app-customer-list");
                        }

                        $sql = "SELECT user.*, user_address.*, order_details.*
                            FROM ((user
                            LEFT JOIN user_address ON user.id = user_address.user_id)
                            LEFT JOIN order_details ON user.id = order_details.user_id)
                            WHERE user.id='$uid';
                            ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        ?>
            <div class="py-5">
              <div class="row g-4 align-items-center">
                <div class="col">
                  <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                      <li class="breadcrumb-item"><a href="../Admin/">Trang
                          chủ</a></li>
                      <li class=""><a href="../Admin/app-customer-list.php"> /
                          Danh sách khách hàng</a>
                      </li>
                      <li class="" aria-current="page"> / <span
                          id="choose_user"><?php echo $row['fullname'] ?></span>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
            <!-- Hiển thị thông tin chi tiết của khách hàng ở đây -->

            <div class="sa-entity-layout"
              data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;}">
              <div class="sa-entity-layout__body">
                <div class="sa-entity-layout__sidebar">
                  <div class="card">
                    <div
                      class="card-body d-flex flex-column align-items-center">
                      <div class="pt-3">
                        <div class="sa-symbol sa-symbol--shape--circle"
                          style="--sa-symbol--size:6rem"><img
                            src="images/user1.png" width="96" height="96"
                            alt="" /></div>
                      </div>
                      <div class="text-center mt-4">
                        <div class="fs-exact-16 fw-medium">
                          <?php echo $row['fullname'] ?></div>
                        <div class="fs-exact-13 text-muted">
                          <div class="mt-1"><?php echo $row['email'] ?></div>
                          <div class="mt-1"><?php echo $row['mobile'] ?></div>
                        </div>
                      </div>
                      <div class="sa-divider my-5"></div>
                      <div class="w-100">
                        <dl class="list-unstyled m-0">
                          <dt class="fs-exact-14 fw-medium">Đơn hàng cuối</dt>
                          <?php
                                                        $sqlc = "SELECT * FROM order_details WHERE user_id='$uid' ORDER BY id DESC";
                                                        $resultc = $conn->query($sqlc);
                                                        if ($resultc->num_rows > 0) {
                                                            $rowc = $resultc->fetch_assoc();
                                                            echo '<dd class="fs-exact-13 text-muted mb-0 mt-1">' . $rowc['order_date'] . ' – <a
                                                            href="../Admin/order-details.php?order_id=' . $rowc['id'] . '">#' . $rowc['id'] . '</a></dd>';
                                                        }
                                                        ?>

                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="sa-entity-layout__main">
                  <div class="card sa-card-area">
                    <div
                      class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                      <h2 class="mb-0 fs-exact-18 me-4">Đơn hàng</h2>
                      <div class="text-muted fs-exact-14 text-end">
                        <?php
                                                    $total = 0;
                                                    $orderCount = 0;
                                                    $sqlt = "SELECT * FROM order_details WHERE user_id='$uid'";
                                                    $resultt = $conn->query($sqlt);
                                                    if ($resultt->num_rows > 0) {
                                                        while ($rowt = $resultt->fetch_assoc()) {
                                                            $total += $rowt['spend'];
                                                        }
                                                    }
                                                    //
                                                    $sqlt = "SELECT COUNT(id) AS quantityOrder FROM order_details WHERE user_id='$uid'";
                                                    $resultt = $conn->query($sqlt);
                                                    if ($resultt->num_rows > 0) {
                                                        $rowt = $resultt->fetch_assoc();
                                                        $orderCount = $rowt['quantityOrder'];
                                                    }
                                                    echo "Đã dành " . number_format($total) . " vnđ cho " . $orderCount . " đơn hàng";
                                                    ?>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="sa-table text-nowrap">
                        <tbody>
                          <!-- Hiển thị danh sách đơn hàng -->
                          <?php
                                                        $sqlo = "SELECT * FROM order_details WHERE user_id='$uid'";
                                                        $resulto = $conn->query($sqlo);
                                                        if ($resulto->num_rows > 0) {
                                                            while ($rowo = $resulto->fetch_assoc()) {
                                                        ?>
                          <tr>
                            <td><a
                                href="../Admin/order-details.php?order_id=<?php echo $rowo['id'] ?>">#<?php echo $rowo['id'] ?></a>
                            </td>
                            <td><?php echo $rowo['order_date'] ?></td>
                            <td>
                              <?php
                                                                        if ($rowo['delete_at'] != NULL) {
                                                                            echo "Đã hủy";
                                                                        } else {
                                                                            if ($rowo['status'] == 1) {
                                                                                echo "Đang chờ xử lý";
                                                                            } else if ($rowo['status'] == 0) {
                                                                                echo "Đã xử lý";
                                                                            }
                                                                        }
                                                                        ?>
                            </td>
                            <td>
                              <?php
                                                                        $order_id = $rowo['id'];
                                                                        $sqli = "SELECT * FROM order_items WHERE order_id='$order_id'";
                                                                        $resulti = $conn->query($sqli);
                                                                        if ($resulti->num_rows > 0) {
                                                                            $rowi = $resulti->fetch_assoc();
                                                                            echo $rowi['quantity'] . ' sản phẩm';
                                                                        }
                                                                        ?>
                            </td>
                            <td><?php echo $rowo['total'] ?></td>
                          </tr>
                          <?php
                                                            }
                                                        }
                                                        ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="sa-divider"></div>
                  </div>
                  <div class="card mt-5">
                    <div
                      class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                      <h2 class="mb-0 fs-exact-18 me-4">Địa chỉ</h2>
                    </div>
                    <div class="sa-divider"></div>
                    <div
                      class="px-5 py-3 my-2 d-flex align-items-center justify-content-between">
                      <div>
                        <div><?php echo $row['fullname'] ?></div>
                        <div class="text-muted fs-exact-14 mt-1">
                          <?php echo $row['address'] ?></div>
                      </div>
                    </div>
                    <div class="sa-divider"></div>
                  </div>
                </div>
              </div>
            </div>
            <?php

                        }
                        ?>
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