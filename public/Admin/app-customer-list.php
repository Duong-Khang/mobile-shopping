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
  <title>Danh sách khách hàng</title><!-- icon -->
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
                      <li class="" aria-current="page"> / Khách hàng</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-auto d-flex"><a href="/add-customer"
                    class="btn btn-primary">Thêm khách hàng</a></div>
              </div>
            </div>
            <div class="card">
              <div class="p-4"><input type="text" placeholder="Tìm khách hàng"
                  class="form-control form-control--search mx-auto"
                  id="table-search" /></div>
              <div class="sa-divider"></div>
              <table class="sa-datatables-init"
                data-order="[[ 1, &quot;asc&quot; ]]"
                data-sa-search-input="#table-search">
                <thead>
                  <tr>
                    <th class="w-min" data-orderable="false"><input
                        type="checkbox"
                        class="form-check-input m-0 fs-exact-16 d-block"
                        aria-label="..." />
                    </th>
                    <th class="min-w-20x">Tên</th>
                    <th>Ngày đăng ký</th>
                    <th>Chi tiêu</th>
                    <th>Ngày xóa</th>
                    <th class="w-min" data-orderable="false"></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Hiển thị danh sách khách hàng -->
                  <?php
                                    $sql = "SELECT * FROM user";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                  <tr>
                    <td><input type="checkbox"
                        class="form-check-input m-0 fs-exact-16 d-block"
                        aria-label="..." /></td>
                    <td>
                      <div class="d-flex align-items-center"><a
                          href="../Admin/customer-details.php?uid=<?php echo $row['id'] ?>"
                          class="me-4">
                          <div
                            class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                            <img src="images/user1.png" width="40" height="40"
                              alt="" />
                          </div>
                        </a>
                        <div><a
                            href="../Admin/customer-details.php?uid=<?php echo $row['id'] ?>"
                            class="text-reset"><?php echo strtoupper($row['username']) ?></a>
                        </div>
                      </div>
                    </td>
                    <td class="text-nowrap">
                      <?php
                                                    $time  = strtotime($row['created_at']);
                                                    $day   = date('d', $time);
                                                    $month = date('m', $time);
                                                    $year  = date('Y', $time);
                                                    echo $month . '/' . $day . '/' . $year;
                                                    ?>
                    </td>
                    <td>
                      <div class="sa-price">
                        <span class="sa-price__symbol"></span>
                        <span class="sa-price__integer">
                          <?php
                                                            $uid = $row['id'];
                                                            $total = 0;
                                                            $sqls = "SELECT * FROM order_details WHERE user_id='$uid'";
                                                            $results = $conn->query($sqls);
                                                            if ($results->num_rows > 0) {

                                                                while ($rows = $results->fetch_assoc()) {
                                                                    $total += $rows['spend'];
                                                                }
                                                            }
                                                            echo number_format($total) . ' đ';
                                                            ?>
                        </span>
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
                      <div class="dropdown"><button
                          class="btn btn-sa-muted btn-sm" type="button"
                          id="customer-context-menu-0" data-bs-toggle="dropdown"
                          aria-expanded="false" aria-label="More"><svg
                            xmlns="http://www.w3.org/2000/svg" width="3"
                            height="13" fill="currentColor">
                            <path
                              d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z">
                            </path>
                          </svg></button>
                        <ul class="dropdown-menu dropdown-menu-end"
                          aria-labelledby="customer-context-menu-0">
                          <li><a class="dropdown-item"
                              href="/edit-customer?uid=<?php echo $row['id'] ?>">Sửa</a>
                          </li>
                          <li id="drop_<?php echo $row['id'] ?>">
                            <hr class="dropdown-divider" />
                          </li>
                          <li id="check_delete_<?php echo $row['id'] ?>"><a
                              style="cursor: pointer;"
                              id="btn_deleteUser_<?php echo $row['id'] ?>"
                              class="dropdown-item text-danger">Xóa</a></li>
                        </ul>
                        <input type="hidden"
                          id="user_id_<?php echo $row['id'] ?>"
                          value="<?php echo $row['id'] ?>">
                        <script>
                        $(document).ready(function() {

                          //Kiểm tra xem user này đã bị xóa chưa
                          var user_id = $(
                            "#user_id_<?php echo $row['id'] ?>").val();
                          //Gửi ajax
                          $.ajax({
                            url: "Controller/ControllerCheckDeleteUser.php",
                            type: "get",
                            dataType: "text",
                            data: {
                              user_id: user_id
                            },
                            success: function(result) {
                              if (result === "yesdelete") {
                                $("#check_delete_<?php echo $row['id'] ?>")
                                  .hide();
                                $("#drop_<?php echo $row['id'] ?>")
                                  .hide();
                              }
                            }
                          });

                          $("#btn_deleteUser_<?php echo $row['id'] ?>")
                            .click(function() {

                              var answer = window.confirm(
                                "Bạn muốn xóa khách hàng này?");
                              if (answer) {
                                //Lấy user id
                                var user_id = $(
                                    "#user_id_<?php echo $row['id'] ?>")
                                  .val();
                                //Gửi ajax
                                $.ajax({
                                  url: "Controller/ControllerDeleteUser.php",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    user_id: user_id
                                  },
                                  success: function(result) {
                                    if (result == "Xóa thất bại") {
                                      alert(result);
                                    } else if (result ==
                                      "Khách hàng không tồn tại") {
                                      alert(result);
                                    } else {
                                      $("#show_delete_<?php echo $row['id'] ?>")
                                        .text(result);
                                      $("#check_delete_<?php echo $row['id'] ?>")
                                        .hide();
                                      $("#drop_<?php echo $row['id'] ?>")
                                        .hide();
                                    }
                                  }
                                });
                              } else {

                              }
                            });
                        });
                        </script>
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