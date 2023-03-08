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
  <title>Danh sách đơn đặt hàng</title><!-- icon -->
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
  <script src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>
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
          <div class="container">
            <div class="py-5">
              <div class="row g-4 align-items-center">
                <div class="col">
                  <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                      <li class="breadcrumb-item"><a href="../Admin/">Trang
                          chủ</a></li>
                      <li class="" aria-current="page"> / Đơn đặt hàng</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-auto d-flex"><a href="../Admin/add-order.php"
                    class="btn btn-primary">Thêm đơn hàng</a></div>
              </div>
            </div>
            <div class="card">
              <div class="p-4"><input type="text" placeholder="Tìm đơn đặt hàng"
                  class="form-control form-control--search mx-auto"
                  id="table-search" /></div>
              <div class="sa-divider"></div>
              <table class="sa-datatables-init text-nowrap"
                data-order="[[ 1, &quot;desc&quot; ]]"
                data-sa-search-input="#table-search">
                <thead>
                  <tr>
                    <th class="w-min" data-orderable="false"><input
                        type="checkbox"
                        class="form-check-input m-0 fs-exact-16 d-block"
                        aria-label="..." />
                    </th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Ngày giao hàng</th>
                    <th>Khách hàng</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày xóa</th>
                    <th class="w-min" data-orderable="false"></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Hiển thị danh sách đơn đặt hàng ở đây -->
                  <?php
                                    $sql = "SELECT order_details.*, user.id AS uid, user.username
                                        FROM order_details
                                        INNER JOIN user ON order_details.user_id=user.id";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                  <tr>
                    <td><input type="checkbox"
                        class="form-check-input m-0 fs-exact-16 d-block"
                        aria-label="..." /></td>
                    <td><a
                        href="../Admin/order-details.php?order_id=<?php echo $row['id'] ?>"
                        class="text-reset">#<?php echo $row['id'] ?></a></td>
                    <td><?php echo $row['order_date'] ?></td>
                    <td><?php echo $row['delivery_date'] ?></td>
                    <td><a
                        href="../Admin/customer-details.php?uid=<?php echo $row['user_id'] ?>"
                        class="text-reset"><?php echo $row['username'] ?></a>
                    </td>
                    <td>
                      <div class="d-flex fs-6">
                        <div class="badge badge-sa-success">
                          <?php
                                                            if ($row['status'] == 1) {
                                                                echo "Chưa thanh toán";
                                                            } else if ($row['status'] == 0) {
                                                                echo "Đã thanh toán";
                                                            }
                                                            ?>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex fs-6">
                        <div id="delete_<?php echo $row['id'] ?>"
                          class="badge badge-sa-danger">
                          <?php
                                                            if ($row['delete_at'] == NULL) {
                                                                if ($row['status'] == 1) {
                                                                    echo "Chưa giao hàng";
                                                                } else if ($row['status'] == 0) {
                                                                    echo "Đã giao hàng";
                                                                }
                                                            } else if ($row['delete_at'] != NULL) {
                                                                echo "Đã hủy";
                                                            }
                                                            ?>
                        </div>
                      </div>
                    </td>
                    <td>
                      <?php
                                                    $oid = $row['id'];
                                                    $totalItem = 0;
                                                    $sqli = "SELECT * FROM order_items WHERE order_id='$oid'";
                                                    $resulti = $conn->query($sqli);
                                                    if ($resulti->num_rows > 0) {
                                                        while ($rowi = $resulti->fetch_assoc()) {
                                                            $totalItem += $rowi['quantity'];
                                                        }
                                                    }
                                                    echo $totalItem . ' sản phẩm';
                                                    ?>
                    </td>
                    <td>
                      <div class="sa-price"></div>
                      <span
                        class="sa-price__integer"><?php echo $row['total'] ?></span>
            </div>
            </td>
            <td>
              <div id="show_delete_<?php echo $row['id'] ?>"
                class="badge badge-sa-danger">
                <?php
                                            if (!$row['delete_at']) {
                                                echo '';
                                            } else {
                                                echo $row['delete_at'];
                                            }
                                ?>
              </div>
            </td>
            <td>

              <div class="dropdown">
                <button class="btn btn-sa-muted btn-sm" type="button"
                  id="order-context-menu-0" data-bs-toggle="dropdown"
                  aria-expanded="false" aria-label="More"><svg
                    xmlns="http://www.w3.org/2000/svg" width="3" height="13"
                    fill="currentColor">
                    <path
                      d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z">
                    </path>
                  </svg></button>
                <ul class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="order-context-menu-0">
                  <li><a class="dropdown-item"
                      href="../Admin/edit-order.php?oid=<?php echo $row['id'] ?>">Sửa</a>
                  </li>
                  <li id="drop_<?php echo $row['id'] ?>">
                    <hr class="dropdown-divider" />
                  </li>
                  <li id="check_<?php echo $row['id'] ?>"><a
                      id="btn_delete_order_<?php echo $row['id'] ?>"
                      class="dropdown-item text-danger"
                      style="cursor: pointer;">Xóa</a></li>
                  <input type="hidden" id="order_id_<?php echo $row['id'] ?>"
                    value="<?php echo $row['id'] ?>">
                  <script>
                  $(document).ready(function() {
                    //Kiểm tra xem đã xóa đơn hàng chưa
                    var order_id = $("#order_id_<?php echo $row['id'] ?>")
                      .val();
                    //Gửi ajax
                    $.ajax({
                      url: "Controller/ControllerCheckDeleteOrder.php",
                      type: "get",
                      dataType: "text",
                      data: {
                        order_id: order_id
                      },
                      success: function(result) {
                        if (result == '0') {
                          $("#drop_<?php echo $row['id'] ?>").hide();
                          $("#check_<?php echo $row['id'] ?>").hide();
                        }

                      }
                    });
                    //Xử lý xóa order

                    $("#btn_delete_order_<?php echo $row['id'] ?>").click(
                      function() {
                        var answer = window.confirm("Xóa đơn hàng này?");
                        if (answer) {
                          //some code
                          //Lấy id order
                          var order_id = $(
                            "#order_id_<?php echo $row['id'] ?>").val();
                          //Gửi ajax
                          $.ajax({
                            url: "Controller/ControllerDeleteOrder.php",
                            type: "get",
                            dataType: "text",
                            data: {
                              order_id: order_id
                            },
                            success: function(result) {
                              if (result == "Xóa thất bại") {
                                alert(result);
                              } else if (result ==
                                "Đơn hàng không tồn tại") {
                                alert(result);
                              } else {
                                $("#drop_<?php echo $row['id'] ?>")
                                  .hide();
                                $("#check_<?php echo $row['id'] ?>")
                                  .hide();
                                $("#delete_<?php echo $row['id'] ?>")
                                  .text("Đã hủy");
                                $("#show_delete_<?php echo $row['id'] ?>")
                                  .html(result);
                              }
                            }
                          });
                        } else {
                          //some code
                        }

                      });
                  });
                  </script>
                </ul>
              </div>
            </td>
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