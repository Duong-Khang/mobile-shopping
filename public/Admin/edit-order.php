<?php
ob_start();
session_start();
include "connect.php";
//Lấy oid
if (isset($_GET['oid']) && $_GET['oid'] !== '') {
    $oid = $_GET['oid'];
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
  <title>Cập nhật đơn hàng</title><!-- icon -->
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
  <script src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>
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
  <input type="hidden" id="oid" value="<?php echo $oid ?>">
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
            <div class="py-5">
              <div class="row g-4 align-items-center">
                <div class="col">
                  <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-sa-simple">
                      <li class="breadcrumb-item"><a href="../Admin/">Trang
                          chủ</a></li>
                      <li class=""><a href="../Admin/app-order-list.php"> / Danh
                          sách đơn hàng</a></li>
                      <li class="" aria-current="page"> / Cập nhật đơn hàng</li>
                    </ol>
                  </nav>
                </div>

              </div>
            </div>
            <div class="sa-entity-layout"
              data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
              <div class="sa-entity-layout__body">
                <div class="sa-entity-layout__main">
                  <div class="card">
                    <div class="card-body p-5">
                      <?php
                                            $sql = "SELECT * FROM user_address WHERE order_id='$oid'";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                            ?>
                      <div class="mb-4">
                        <label for="form-coupon/code" class="form-label">Khách
                          hàng</label>
                        <input type="text" class="form-control"
                          id="get_customer" readonly placeholder=""
                          value="<?php echo $row['fullname'] ?>" />
                      </div>
                      <?php
                                            }
                                            ?>
                      <?php
                                            $tqty = 0;
                                            $sql = "SELECT * FROM order_items WHERE order_id='$oid'";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $tqty += $row['quantity'];
                                                }
                                            }
                                            ?>
                      <div class="mb-4">
                        <label for="form-coupon/code" class="form-label">Số
                          lượng sản phẩm</label>
                        <input type="text" class="form-control"
                          id="get_quantity" readonly placeholder=""
                          value="<?php echo $tqty ?>" />
                      </div>
                      <?php
                                            $sql = "SELECT * FROM order_details WHERE id='$oid'";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();

                                            ?>
                      <div class="mb-4">
                        <label for="form-coupon/code" class="form-label">Tổng
                          tiền</label>
                        <input type="text" class="form-control" id="get_total"
                          readonly placeholder=""
                          value="<?php echo $row['total'] ?>" />
                        <input type="hidden" id="get_total_spend" value="0">
                      </div>
                      <?php
                                            }
                                            ?>
                      <div class="card sa-card-area">

                        <div class="table-responsive">
                          <table class="sa-table">
                            <tbody>
                              <!-- Hiển thị danh sách item  -->
                              <?php
                                                            $order_id = $oid;
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
                              <tr id="row_<?php echo $row1['id'] ?>">
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
                                      href="/chi-tiet-san-pham/<?php echo $row2['id'] ?>"
                                      class="text-reset"><?php echo $row2['name'] ?></a>
                                  </div>
                                </td>
                                <td><?php echo $row1['color'] ?></td>
                                <td><?php echo $row1['quantity'] ?></td>
                                <td class="text-end">
                                  <div class="sa-price">
                                    <span class="sa-price__symbol">
                                      <?php
                                                                                                    if (strpos($row1['color'], $row2['dcolor1']) !== false) {
                                                                                                        if ($row3['active'] == 1) {
                                                                                                            echo number_format(($row2['price_color1'] * (100 - $row3['discount_percent'])) / 100);
                                                                                                        } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                            echo number_format($row2['price_color1']);
                                                                                                        }
                                                                                                    } else if (strpos($row1['color'], $row2['dcolor2']) !== false) {
                                                                                                        if ($row3['active'] == 1) {
                                                                                                            echo number_format(($row2['price_color2'] * (100 - $row3['discount_percent'])) / 100);
                                                                                                        } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                            echo number_format($row2['price_color2']);
                                                                                                        }
                                                                                                    } else if (strpos($row1['color'], $row2['dcolor3']) !== false) {
                                                                                                        if ($row3['active'] == 1) {
                                                                                                            echo number_format(($row2['price_color3'] * (100 - $row3['discount_percent'])) / 100);
                                                                                                        } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                            echo number_format($row2['price_color3']);
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                    </span>

                                  </div>
                                </td>


                                <td class="text-end">
                                  <div class="sa-price"><span
                                      class="sa-price__symbol">
                                      <?php
                                                                                                    if (strpos($row1['color'], $row2['dcolor1']) !== false) {
                                                                                                        if ($row3['active'] == 1) {
                                                                                                            echo number_format(((($row2['price_color1'] * (100 - $row3['discount_percent'])) / 100)) * $row1['quantity']);
                                                                                                        } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                            echo number_format($row2['price_color1'] * $row1['quantity']);
                                                                                                        }
                                                                                                    } else if (strpos($row1['color'], $row2['dcolor2']) !== false) {
                                                                                                        if ($row3['active'] == 1) {
                                                                                                            echo number_format(((($row2['price_color2'] * (100 - $row3['discount_percent'])) / 100) * $row1['quantity']));
                                                                                                        } else if ($row3['active'] == 0 || $row3['active'] == 2) {
                                                                                                            echo number_format($row2['price_color2'] * $row1['quantity']);
                                                                                                        }
                                                                                                    } else if (strpos($row1['color'], $row2['dcolor3']) !== false) {
                                                                                                        if ($row3['active'] == 1) {
                                                                                                            echo number_format(((($row2['price_color3'] * (100 - $row3['discount_percent'])) / 100) * $row1['quantity']));
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
                                                                                echo number_format($row4['value_code']);
                                                                            } else {
                                                                                echo '0';
                                                                            }
                                                                            ?>
                                    </span>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                                $sql = "SELECT * FROM order_details WHERE id='$oid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                ?>
                <div class="sa-entity-layout__sidebar">
                  <div class="card w-100">
                    <div class="card-body p-5">
                      <div class="mb-4">
                        <label for="form-coupon/start-date"
                          class="form-label">Ngày đặt hàng</label>
                        <input value="<?php echo $row['order_date'] ?>"
                          id="set_date" type="text"
                          class="form-control datepicker-here"
                          data-auto-close="true" data-language="en" disabled />
                      </div>
                      <div>
                        <label for="form-coupon/end-date"
                          class="form-label">Ngày giao hàng</label>
                        <input value="<?php echo $row['delivery_date'] ?>"
                          id="get_date" type="text"
                          class="form-control datepicker-here"
                          data-auto-close="true" data-language="en" />
                      </div>
                    </div>
                  </div>

                  <div class="card w-100">
                    <div class="card-body p-5">
                      <?php
                                                if ($row['status'] == 1) {
                                                ?>
                      <div class="mb-4">
                        <div class="form-label mb-3">Trạng thái giao dịch</div>
                        <label style="cursor: pointer;" id="click_ChoXuLy"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="type" checked />
                          <span class="form-check-label">Đang chờ xử lý</span>
                        </label>
                        <label style="cursor: pointer;" id="click_DaXuLy"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="type" />
                          <span class="form-check-label">Đã xử lý</span>
                        </label>
                      </div>
                      <input type="hidden" id="TrangThaiGiaoHang" value="1">
                      <?php
                                                } else {
                                                ?>
                      <div class="mb-4">
                        <div class="form-label mb-3">Trạng thái giao dịch</div>
                        <label style="cursor: pointer;" id="click_ChoXuLy"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="type" />
                          <span class="form-check-label">Đang chờ xử lý</span>
                        </label>
                        <label style="cursor: pointer;" id="click_DaXuLy"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="type" checked />
                          <span class="form-check-label">Đã xử lý</span>
                        </label>
                      </div>
                      <input type="hidden" id="TrangThaiGiaoHang" value="0">
                      <?php
                                                }
                                                ?>
                      <?php
                                                if ($row['delete_at'] == NULL) {
                                                ?>
                      <div class="mb-4">
                        <div class="form-label mb-3">Trạng thái hủy</div>
                        <label style="cursor: pointer;" id="checked_Huy"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="type_3" checked />
                          <span class="form-check-label">Chưa hủy</span>
                        </label>
                        <label style="cursor: pointer;" id="checked_DaHuy"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="type_3" />
                          <span class="form-check-label">Đã hủy</span>
                        </label>
                      </div>
                      <input type="hidden" id="TrangThaiHuy" value="1">
                      <?php
                                                } else {
                                                ?>
                      <div class="mb-4">
                        <div class="form-label mb-3">Trạng thái hủy</div>
                        <label style="cursor: pointer;" id="checked_Huy"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="type_3" />
                          <span class="form-check-label">Chưa hủy</span>
                        </label>
                        <label style="cursor: pointer;" id="checked_DaHuy"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="type_3" checked />
                          <span class="form-check-label">Đã hủy</span>
                        </label>
                      </div>
                      <input type="hidden" id="TrangThaiHuy" value="0">
                      <?php
                                                }
                                                ?>
                    </div>
                  </div>
                </div>
                <?php
                                }
                                ?>
              </div>
              <div class="col-auto d-flex">
                <a id="btn_editOrder" class="btn btn-primary">Cập nhật</a>
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

<!-- Xử lý cập nhật đơn hàng -->
<script>
$(document).ready(function() {
  var statusXuLy = $("#TrangThaiGiaoHang").val();
  var statusHuy = $("#TrangThaiHuy").val();
  //Xử lý cập nhật
  $("#click_ChoXuLy").click(function() {
    statusXuLy = 1;
  });
  $("#click_DaXuLy").click(function() {
    statusXuLy = 0;
  });

  $("#checked_Huy").click(function() {
    statusHuy = 1;
  });
  $("#checked_DaHuy").click(function() {
    statusHuy = 0;
  });

  $("#btn_editOrder").click(function() {
    //Lấy oid
    var oid = $("#oid").val();
    //Lấy ngày giao
    var delivery_date = $("#get_date").val();

    //Gửi ajax
    $.ajax({
      url: "Controller/ControllerUpdateOrder.php",
      type: "get",
      dataType: "text",
      data: {
        oid: oid,
        statusXuLy: statusXuLy,
        statusHuy: statusHuy,
        delivery_date: delivery_date
      },
      success: function(result) {
        if (result !== "Success") {
          alert(result);
        } else {
          alert("Cập nhật thành công");
          window.location.href = "../Admin/app-order-list.php";
        }
      }
    });
  });
});
</script>