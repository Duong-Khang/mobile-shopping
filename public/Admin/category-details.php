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
  <title>Danh sách sản phẩm</title><!-- icon -->
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
        <div class="mx-xxl-3 px-4 px-sm-5">
          <div class="py-5">
            <div class="row g-4 align-items-center">
              <div class="col">
                <nav class="mb-2" aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-sa-simple">
                    <li class="breadcrumb-item"><a href="../Admin/">Trang
                        chủ</a></li>
                    <li class=""><a href="../Admin/app-category-list.php"> /
                        Danh sách danh mục</a></li>
                    <li class="" aria-current=""> / Danh sách sản phẩm</li>
                  </ol>
                </nav>
              </div>

            </div>
          </div>
        </div>
        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
          <div class="sa-layout">
            <div class="sa-layout__backdrop" data-sa-layout-sidebar-close="">
            </div>
            <div class="sa-layout__content">
              <div class="card">
                <div class="p-4">
                  <div class="row g-4">
                    <div class="col">
                      <input type="text" placeholder="Tìm sản phẩm"
                        class="form-control form-control--search mx-auto"
                        id="table-search" />
                    </div>
                  </div>
                </div>
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
                      <th class="min-w-20x">Sản phẩm</th>
                      <th>Khuyến mãi</th>
                      <th>Màu</th>
                      <th>Danh mục</th>
                      <th>Kho dự trữ</th>
                      <th>Giá</th>
                      <th>Ngày xóa</th>
                      <th class="w-min" data-orderable="false"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Hiển thị danh sách sản phẩm ở đây -->
                    <?php
                                        //Lấy Category id
                                        if (isset($_GET['cateid'])) {
                                            $cate_id = $_GET['cateid'];
                                        }
                                        $sql = "SELECT product.*, description.color1, 
                                            description.color2, description.color3,
                                            description.dcolor1, description.dcolor2,
                                            description.dcolor3,
                                            description.product_id,
                                            description.rom,
                                            description.ram,
                                            description.chip_gpu,
                                            description.chip_set,
                                            description.sr,
                                            description.small_desc,
                                            description.photo_color1,
                                            description.photo_color2,
                                            description.photo_color3,
                                            description.price_color1,
                                            description.price_color2,
                                            description.price_color3,
                                            description.delete_at_desc
                                            FROM product
                                            INNER JOIN description ON product.id=description.product_id
                                            WHERE product.category_id='$cate_id'
                                            ";

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
                            href="../Admin/app-product-list.php" class="me-4">
                            <div id="show_img_<?php echo $row['id'] ?>"
                              class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                              <img
                                src="/product_images/<?php echo $row['photo_name'] ?>"
                                width="40" height="40" alt="" />
                            </div>
                          </a>
                          <div><a
                              href="/product-details?pid=<?php echo $row['id'] ?>"
                              class="text-reset"><?php echo $row['name'] ?></a>
                            <div class="sa-meta mt-0">
                              <ul class="sa-meta__list">
                                <li class="sa-meta__item">ID: <span
                                    title="Click to copy product ID"
                                    class="st-copy"><?php echo $row['id'] ?></span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php
                                                        //Lấy % khuyến mãi
                                                        $discount_id = $row['discount_id'];
                                                        $sqlDiscount = "SELECT * FROM discount WHERE id='$discount_id' AND active='1' AND delete_at IS NULL";
                                                        $resultDiscount = $conn->query($sqlDiscount);
                                                        if ($resultDiscount->num_rows > 0) {
                                                            $rowDiscount = $resultDiscount->fetch_assoc();
                                                            echo $rowDiscount['discount_percent'] . '%';
                                                        }
                                                        ?>
                      </td>
                      <td>
                        <?php
                                                        //Xử lý hiển thị màu
                                                        $pid = $row['id'];
                                                        $sqlColor = "SELECT * FROM description WHERE product_id='$pid'";
                                                        $resultColor = $conn->query($sqlColor);
                                                        if ($resultColor->num_rows > 0) {
                                                            while ($rowColor = $resultColor->fetch_assoc()) {

                                                                if ($rowColor['dcolor1'] != NULL) {
                                                                    echo '<a style="cursor: pointer;" id="btn_color_1_' . $pid . '" onclick="showAll(1, ' . $pid . ')"><img id="_btn_color_1_' . $pid . '" style="height: 30px; width: 30px; margin-bottom: 3px; border: 1px solid violet;" src="/product_images_desc/' . $rowColor["photo_color1"] . '" alt=""></a>';
                                                                }

                                                                if ($rowColor['dcolor2'] != NULL) {
                                                                    echo '<a style="cursor: pointer;" id="btn_color_2_' . $pid . '" onclick="showAll(2, ' . $pid . ')"><img id="_btn_color_2_' . $pid . '" style="height: 30px; width: 30px; margin-bottom: 3px; border: 1px solid #def2d0;" src="/product_images_desc/' . $rowColor["photo_color2"] . '" alt=""></a>';
                                                                }

                                                                if ($rowColor['dcolor3'] != NULL) {
                                                                    echo '<a style="cursor: pointer;" id="btn_color_3_' . $pid . '" onclick="showAll(3, ' . $pid . ')"><img id="_btn_color_3_' . $pid . '" style="height: 30px; width: 30px; margin-bottom: 3px; border: 1px solid #def2d0;" src="/product_images_desc/' . $rowColor["photo_color3"] . '" alt=""></a>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                      </td>

                      <script>
                      //Xử lý khi nhấn vào màu nào thì sẽ hiển thị ảnh, giá, kho tương ứng
                      function showAll(color, pid) {
                        //Chọn màu 1
                        if (color == 1) {
                          $('#_btn_color_1_' + pid + '').css("border",
                            "1px solid violet");
                          $('#_btn_color_2_' + pid + '').css("border",
                            "1px solid #def2d0");
                          $('#_btn_color_3_' + pid + '').css("border",
                            "1px solid #def2d0");
                          //Gửi ajax
                          $.ajax({
                            url: "Controller/ControllerShowChooseCollorProduct.php",
                            type: "get",
                            dataType: "json",
                            data: {
                              pid: pid,
                              color: color
                            },
                            success: function(result) {
                              $.each(result, function(key, item) {
                                $('#price_' + pid + '').text(item[
                                  'price']);
                                $('#show_img_' + pid + '').html(item[
                                  'img']);
                                $('#show_stock_' + pid + '').html(
                                  item['stock']);
                              });
                            }
                          });
                        }
                        //Chọn màu 1
                        if (color == 2) {
                          $('#_btn_color_2_' + pid + '').css("border",
                            "1px solid violet");
                          $('#_btn_color_1_' + pid + '').css("border",
                            "1px solid #def2d0");
                          $('#_btn_color_3_' + pid + '').css("border",
                            "1px solid #def2d0");
                          //Gửi ajax
                          $.ajax({
                            url: "Controller/ControllerShowChooseCollorProduct.php",
                            type: "get",
                            dataType: "json",
                            data: {
                              pid: pid,
                              color: color
                            },
                            success: function(result) {
                              $.each(result, function(key, item) {
                                $('#price_' + pid + '').text(item[
                                  'price']);
                                $('#show_img_' + pid + '').html(item[
                                  'img']);
                                $('#show_stock_' + pid + '').html(
                                  item['stock']);
                              });
                            }
                          });
                        }
                        //Chọn màu 1
                        if (color == 3) {
                          $('#_btn_color_3_' + pid + '').css("border",
                            "1px solid violet");
                          $('#_btn_color_2_' + pid + '').css("border",
                            "1px solid #def2d0");
                          $('#_btn_color_1_' + pid + '').css("border",
                            "1px solid #def2d0");
                          //Gửi ajax
                          $.ajax({
                            url: "Controller/ControllerShowChooseCollorProduct.php",
                            type: "get",
                            dataType: "json",
                            data: {
                              pid: pid,
                              color: color
                            },
                            success: function(result) {
                              $.each(result, function(key, item) {
                                $('#price_' + pid + '').text(item[
                                  'price']);
                                $('#show_img_' + pid + '').html(item[
                                  'img']);
                                $('#show_stock_' + pid + '').html(
                                  item['stock']);
                              });
                            }
                          });
                        }
                      }
                      </script>
                      <td><a
                          href="/product-details?pid=<?php echo $row['id'] ?>"
                          class="text-reset"><?php echo $row['manufacturer'] ?></a>
                      </td>
                      <td id="show_stock_<?php echo $row['id'] ?>">
                        <?php
                                                        $inventory_id = $row['inventory_id'];
                                                        $sqlInventory = "SELECT * FROM product_inventory WHERE id='$inventory_id'";
                                                        $resultInventory = $conn->query($sqlInventory);
                                                        if ($resultInventory->num_rows > 0) {
                                                            $rowInventory = $resultInventory->fetch_assoc();
                                                            if ($rowInventory['quantity_color1'] > 0) {
                                                                echo '<div class="badge badge-sa-success">' . $rowInventory['quantity_color1'] . ' sản phẩm</div>';
                                                            } else {
                                                                echo '<div class="badge badge-sa-danger">Hết hàng</div>';
                                                            }
                                                        }
                                                        ?>
                      </td>
                      <td>
                        <div class="sa-price">
                          <span id="price_<?php echo $row['id'] ?>"
                            class="sa-price__integer">
                            <?php
                                                                $discount_id = $row['discount_id'];
                                                                $sqlDiscount = "SELECT * FROM discount WHERE id='$discount_id' AND active='1' AND delete_at IS NULL";
                                                                $resultDiscount = $conn->query($sqlDiscount);
                                                                if ($resultDiscount->num_rows > 0) {
                                                                    $rowDiscount = $resultDiscount->fetch_assoc();
                                                                    echo number_format(($row['price_color1'] * (100 - $rowDiscount['discount_percent'])) / 100);
                                                                } else {
                                                                    echo number_format($row['price_color1']);
                                                                }

                                                                ?>
                          </span>
                        </div>
                      </td>

                      <td>
                        <div id="show_delete_<?php echo $row['id'] ?>"
                          class="badge badge-sa-danger">
                          <?php
                                                            if ($row['delete_at'] == NULL) {
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
                            id="product-context-menu-0"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            aria-label="More"><svg
                              xmlns="http://www.w3.org/2000/svg" width="3"
                              height="13" fill="currentColor">
                              <path
                                d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z">
                              </path>
                            </svg></button>
                          <ul class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="product-context-menu-0">
                            <li><a class="dropdown-item"
                                href="../Admin/edit-product.php?pid=<?php echo $row['id'] ?>">Sửa</a>
                            </li>

                            <li id="drop_<?php echo $row['id'] ?>">
                              <hr class="dropdown-divider" />
                            </li>
                            <li id="delete_<?php echo $row['id'] ?>"><button
                                class="dropdown-item text-danger"
                                onclick="show(<?php echo $row['id'] ?>)">Xóa</button>
                            </li>
                            <input type="hidden"
                              id="pid_<?php echo $row['id'] ?>"
                              value="<?php echo $row['id'] ?>">
                            <script>
                            $(document).ready(function() {
                              //Kiểm tra xem đã xóa sp chưa khi load page
                              var pid = $("#pid_<?php echo $row['id'] ?>")
                                .val();
                              //Gửi ajax
                              $.ajax({
                                url: "Controller/ControllerCheckDeleteProductList.php",
                                type: "get",
                                dataType: "text",
                                data: {
                                  pid: pid
                                },
                                success: function(result) {
                                  if (result == '0') {
                                    $('#drop_<?php echo $row['id'] ?>')
                                      .hide();
                                    $('#delete_<?php echo $row['id'] ?>')
                                      .hide();
                                  }

                                }
                              });
                            });
                            </script>
                            <script>
                            function show(pid) {
                              //Gửi ajax
                              var answer = window.confirm("Xóa sản phẩm này?");
                              if (answer) {

                                $.ajax({
                                  url: "Controller/ControllerDeleteProductList.php",
                                  type: "get",
                                  dataType: "text",
                                  data: {
                                    pid: pid
                                  },
                                  success: function(result) {
                                    $('#show_delete_' + pid + '').html(
                                      result);
                                    $('#drop_' + pid + '').hide();
                                    $('#delete_' + pid + '').hide();
                                  }
                                });
                              } else {

                              }

                            }
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