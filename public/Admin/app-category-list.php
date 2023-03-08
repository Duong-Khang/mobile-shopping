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
  <title>Danh mục sản phẩm</title><!-- icon -->
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
                      <li class="" aria-current="page"> / Danh mục sản phẩm</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-auto d-flex"><a href="../Admin/add-category.php"
                    class="btn btn-primary">Thêm danh mục mới</a></div>
              </div>
            </div>
            <div class="card">
              <div class="p-4"><input type="text"
                  placeholder="Tìm kiếm danh mục sản phẩm"
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
                    <th class="min-w-15x">Tên</th>
                    <th>Số lượng sản phẩm</th>
                    <th>Ngày xóa</th>
                    <th class="w-min" data-orderable="false"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- Hiển thị danh mục sản phẩm -->
                  <?php
                                    $sql = "SELECT * FROM product_category";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                  <tr>
                    <td><input type="checkbox"
                        class="form-check-input m-0 fs-exact-16 d-block"
                        aria-label="..." /></td>
                    <td><a
                        href="../Admin/edit-category.php?category_id=<?php echo $row['id'] ?>"
                        class="text-reset"><?php echo $row['name'] ?></a>
                    </td>
                    <td>
                      <?php
                                                    //Lấy số lượng sản phẩm của danh mục
                                                    $totalProduct = 0;
                                                    $category_id = $row['id'];
                                                    $sqlc = "SELECT * FROM product WHERE category_id='$category_id'";
                                                    $resultc = $conn->query($sqlc);
                                                    if ($resultc->num_rows > 0) {
                                                        while ($rowc = $resultc->fetch_assoc()) {
                                                            //Lấy pid
                                                            $pid = $rowc['id'];
                                                            //Truy vấn trong table description
                                                            $sqld = "SELECT * FROM description WHERE product_id='$pid'";
                                                            $resultd = $conn->query($sqld);
                                                            if ($resultd->num_rows > 0) {
                                                                while ($rowd = $resultd->fetch_assoc()) {
                                                                    //Màu 1
                                                                    if ($rowd['dcolor1'] != NULL) {
                                                                        $totalProduct++;
                                                                    }
                                                                    //Màu 2
                                                                    if ($rowd['dcolor2'] != NULL) {
                                                                        $totalProduct++;
                                                                    }
                                                                    //Màu 3
                                                                    if ($rowd['dcolor3'] != NULL) {
                                                                        $totalProduct++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo '<a href="../Admin/category-details.php?cateid=' . $row['id'] . '">' . $totalProduct . '</a>';
                                                    ?>
                    </td>
                    <td>
                      <div id="check_<?php echo $row['id'] ?>"
                        class="badge badge-sa-danger">
                        <?php
                                                        if (!$row['delete_at_category']) {
                                                            echo '';
                                                        } else {
                                                            echo $row['delete_at_category'];
                                                        }
                                                        ?>
                      </div>
                    </td>
                    <td>
                      <div class="dropdown"><button
                          class="btn btn-sa-muted btn-sm" type="button"
                          id="category-context-menu-0" data-bs-toggle="dropdown"
                          aria-expanded="false" aria-label="More"><svg
                            xmlns="http://www.w3.org/2000/svg" width="3"
                            height="13" fill="currentColor">
                            <path
                              d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z">
                            </path>
                          </svg></button>
                        <ul class="dropdown-menu dropdown-menu-end"
                          aria-labelledby="category-context-menu-0">
                          <li><a class="dropdown-item"
                              href="../Admin/edit-category.php?category_id=<?php echo $row['id'] ?>">Sửa</a>
                          </li>
                          <li id="drop_<?php echo $row['id'] ?>">
                            <hr class="dropdown-divider" />
                          </li>
                          <li id="show_check_<?php echo $row['id'] ?>"><a
                              class="dropdown-item text-danger"
                              style="cursor: pointer;"
                              id="btn_deleteCategory_<?php echo $row['id'] ?>">Xóa</a>
                          </li>
                        </ul>
                        <input type="hidden" id="cid_<?php echo $row['id'] ?>"
                          value="<?php echo $row['id'] ?>">
                        <script>
                        $(document).ready(function() {

                          //Kiểm tra xem xóa chưa
                          var cid = $("#cid_<?php echo $row['id'] ?>")
                        .val();
                          //Gửi ajax
                          $.ajax({
                            url: "Controller/ControllerCheckDeleteCategory.php",
                            type: "get",
                            dataType: "text",
                            data: {
                              cid: cid
                            },
                            success: function(result) {
                              if (result === '0') {
                                $("#drop_<?php echo $row['id'] ?>")
                                  .hide();
                                $("#show_check_<?php echo $row['id'] ?>")
                                  .hide();
                              }
                            }
                          });

                          $("#btn_deleteCategory_<?php echo $row['id'] ?>")
                            .click(function() {
                              //Lấy id
                              var answer = window.confirm(
                                "Bạn muốn xóa danh mục này?");
                              if (answer) {
                                var cid = $(
                                  "#cid_<?php echo $row['id'] ?>").val();
                                //Gửi ajax
                                $.ajax({
                                  url: "Controller/ControllerDeleteCategory.php",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    cid: cid
                                  },
                                  success: function(result) {
                                    if (result === "Xóa thất bại") {
                                      alert(result);
                                    } else {
                                      $("#check_<?php echo $row['id'] ?>")
                                        .text(result);
                                      $("#drop_<?php echo $row['id'] ?>")
                                        .hide();
                                      $("#show_check_<?php echo $row['id'] ?>")
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