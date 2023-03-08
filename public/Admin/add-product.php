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
  <title>Thêm sản phẩm</title><!-- icon -->
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
                      <li class=""><a href="../Admin/app-product-list.php"> /
                          Danh sách sản phẩm</a>
                      </li>
                      <li class="" aria-current="page"> / Thêm sản phẩm</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
            <div class="sa-entity-layout"
              data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
              <div class="sa-entity-layout__body">
                <div class="sa-entity-layout__main">
                  <form id="form_addProduct" action="finish-add-product.php"
                    method="post" enctype="multipart/form-data">
                    <div class="card">
                      <div class="card-body p-5">
                        <div class="mb-5">
                          <h2 class="mb-0 fs-exact-18">Nhập thông tin cơ bản
                          </h2>
                        </div>
                        <div class="mb-4">
                          <label for="form-product/name" class="form-label">Tên
                            sản phẩm</label>
                          <input type="text" class="form-control"
                            id="product_name" name="product_name" />
                        </div>
                        <div class="mb-4"><label for="form-product/description"
                            class="form-label">Mô tả</label><textarea
                            id="product_desc" class="form-control" rows="8"
                            name="product_desc"></textarea>
                        </div>
                        <div class="mb-4">
                          <label for="form-product/name" class="form-label">Chọn
                            danh mục sản phẩm</label>
                          <select style="width: 10%;" name="product_category"
                            class="form-select">
                            <!-- Lấy danh mục sản phẩm hoạt động -->
                            <?php
                                                        $sqlCate = "SELECT * FROM product_category WHERE delete_at_category IS NULL";
                                                        $resultCate = $conn->query($sqlCate);
                                                        if ($resultCate->num_rows > 0) {
                                                            while ($rowCate = $resultCate->fetch_assoc()) {
                                                        ?>
                            <option value="<?php echo $rowCate['id'] ?>">
                              <?php echo $rowCate['name'] ?></option>

                            <?php
                                                            }
                                                        }
                                                        ?>
                          </select>
                        </div>
                        <div class="mb-4">
                          <label for="form-product/name" class="form-label">Chọn
                            % khuyến mãi</label>
                          <select style="width: 10%;" name="product_discount"
                            class="form-select">
                            <!-- Lấy % khuyến mãi hoạt động -->
                            <?php
                                                        $sqlDis = "SELECT * FROM discount WHERE active='1'";
                                                        $resultDis = $conn->query($sqlDis);
                                                        if ($resultDis->num_rows > 0) {
                                                            while ($rowDis = $resultDis->fetch_assoc()) {
                                                        ?>
                            <option value="<?php echo $rowDis['id'] ?>">
                              <?php echo $rowDis['discount_percent'] . "%"; ?>
                            </option>
                            <?php
                                                            }
                                                        }
                                                        ?>
                          </select>
                        </div>
                        <div class="mb-5">
                          <h2 class="mb-0 fs-exact-18">Nhập thông tin Chi tiết
                          </h2>
                        </div>
                        <div class="mb-4">
                          <label for="form-product/sku"
                            class="form-label">ROM</label>
                          <input style="width: 10%;" type="text"
                            class="form-control" id="product_rom"
                            name="product_rom" />
                          <label for="form-product/sku"
                            class="form-label">RAM</label>
                          <input style="width: 10%;" type="text"
                            class="form-control" id="product_ram"
                            name="product_ram" />
                          <label for="form-product/quantity"
                            class="form-label">CHIP GPU</label>
                          <input style="width: 30%;" type="text"
                            class="form-control" id="product_chip_gpu"
                            name="product_chip_gpu" />
                          <label for="form-product/quantity"
                            class="form-label">CHIP SET</label>
                          <input style="width: 30%;" type="text"
                            class="form-control" id="product_chip_set"
                            name="product_chip_set" />
                          <label for="form-product/quantity"
                            class="form-label">Độ phân giải màn Hình</label>
                          <input style="width: 50%;" type="text"
                            class="form-control" id="product_screen"
                            name="product_screen" />
                          <label for="form-product/quantity"
                            class="form-label">Mô tả ngắn</label>
                          <textarea id="product_desc_short" class="form-control"
                            rows="4" name="product_desc_short"></textarea>
                        </div>
                        <div class="mb-5">
                          <h2 class="mb-0 fs-exact-18">Nhập thông tin cho màu
                            thứ nhất</h2>
                        </div>
                        <div class="mb-4">
                          <label for="form-product/sku"
                            class="form-label">Màu</label>
                          <input style="width: 15%;" type="text"
                            class="form-control" id="color1" name="color1" />
                          <label for="form-product/quantity"
                            class="form-label">Giá</label>
                          <input style="width: 15%;" type="number"
                            class="form-control" id="price_color1"
                            name="price_color1" />
                          <label for="form-product/quantity"
                            class="form-label">Số lượng</label>
                          <input style="width: 15%;" type="number"
                            class="form-control" id="quantity_color1"
                            name="quantity_color1" />
                          <div class="mb-4">
                            <label for="form-product/name"
                              class="form-label">Upload ảnh</label>
                            <div class="row g-4">
                              <div class="col">
                                Chọn ảnh:
                                <input type="file" name="fileToUpload_1"
                                  id="fileToUpload_1">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mb-5">
                          <h2 class="mb-0 fs-exact-18">Nhập thông tin cho màu
                            thứ hai nếu có</h2>
                        </div>
                        <div class="mb-4">
                          <label for="form-product/sku"
                            class="form-label">Màu</label>
                          <input style="width: 15%;" type="text"
                            class="form-control" id="color2" name="color2" />
                          <label for="form-product/quantity"
                            class="form-label">Giá</label>
                          <input style="width: 15%;" type="number"
                            class="form-control" id="price_color2"
                            name="price_color2" />
                          <label for="form-product/quantity"
                            class="form-label">Số lượng</label>
                          <input style="width: 15%;" type="number"
                            class="form-control" id="quantity_color2"
                            name="quantity_color2" />
                          <div class="mb-4">
                            <label for="form-product/name"
                              class="form-label">Upload ảnh</label>
                            <div class="row g-4">
                              <div class="col">
                                Chọn ảnh:
                                <input type="file" name="fileToUpload_2"
                                  id="fileToUpload_2">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mb-5">
                          <h2 class="mb-0 fs-exact-18">Nhập thông tin cho màu
                            thứ ba nếu có</h2>
                        </div>
                        <div class="mb-4">
                          <label for="form-product/sku"
                            class="form-label">Màu</label>
                          <input style="width: 15%;" type="text"
                            class="form-control" id="color3" name="color3" />
                          <label for="form-product/quantity"
                            class="form-label">Giá</label>
                          <input style="width: 15%;" type="number"
                            class="form-control" id="price_color3"
                            name="price_color3" />
                          <label for="form-product/quantity"
                            class="form-label">Số lượng</label>
                          <input style="width: 15%;" type="number"
                            class="form-control" id="quantity_color3"
                            name="quantity_color3" />
                          <div class="mb-4">
                            <label for="form-product/name"
                              class="form-label">Upload ảnh</label>
                            <div class="row g-4">
                              <div class="col">
                                Chọn ảnh:
                                <input type="file" name="fileToUpload_3"
                                  id="fileToUpload_3">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto d-flex">
                          <input id="btn_addProduct" type="submit"
                            value="Hoàn tất" class="btn btn-primary">
                        </div>
                        <script>
                        $(document).ready(function() {
                          $("#btn_addProduct").click(function() {
                            //Biến kiểm tra
                            var run = true;
                            //Lấy tên sản phẩm
                            var name = $("#product_name").val();
                            //Kiểm tra tên
                            if (!name) {
                              run = false;
                              alert("Chưa nhập tên sản phẩm");
                              return false;
                            }
                            var product_desc = $("#product_desc").val();
                            if (!product_desc) {
                              run = false;
                              alert("Chưa nhập mô tả sản phẩm");
                              return false;
                            }
                            var product_rom = $("#product_rom").val();
                            if (!product_rom) {
                              run = false;
                              alert("Chưa nhập rom");
                              return false;
                            }
                            var product_ram = $("#product_ram").val();
                            if (!product_ram) {
                              run = false;
                              alert("Chưa nhập ram");
                              return false;
                            }
                            var product_chip_gpu = $(
                              "#product_chip_gpu").val();
                            if (!product_chip_gpu) {
                              run = false;
                              alert("Chưa nhập chip gpu");
                              return false;
                            }
                            var product_chip_set = $(
                              "#product_chip_set").val();
                            if (!product_chip_set) {
                              run = false;
                              alert("Chưa nhập chip set");
                              return false;
                            }
                            var product_screen = $("#product_screen")
                              .val();
                            if (!product_screen) {
                              run = false;
                              alert("Chưa nhập độ phận giải màn hình");
                              return false;
                            }
                            var product_desc_short = $(
                              "#product_desc_short").val();
                            if (!product_desc_short) {
                              run = false;
                              alert("Chưa nhập mô tả ngắn");
                              return false;
                            }

                            //Kiểm tra xem màu 1 có đủ thông tin không
                            var color1 = $("#color1").val();
                            if (!color1) {
                              run = false;
                              alert(
                                "Chưa nhập màu thứ nhất của sản phẩm");
                              return false;
                            }
                            var price_color1 = $("#price_color1").val();
                            if (!price_color1) {
                              run = false;
                              alert(
                                "Chưa nhập giá thứ nhất của sản phẩm");
                              return false;
                            }
                            var quantity_color1 = $("#quantity_color1")
                              .val();
                            if (!quantity_color1) {
                              run = false;
                              alert(
                                "Chưa nhập số lượng thứ nhất của sản phẩm"
                                );
                              return false;
                            }
                            var fileToUpload_1 = $("#fileToUpload_1")
                              .val();
                            if (!fileToUpload_1) {
                              run = false;
                              alert(
                                "Chưa upload ảnh thứ nhất của sản phẩm"
                                );
                              return false;
                            }

                            //Kiểm tra xem có nhập thông tin màu 2 không
                            var color2 = $("#color2").val();
                            if (!color2) {
                              //Rỗng
                            } else {
                              //Không rỗng
                              //Kiểm tra giá
                              var price_color2 = $("#price_color2")
                              .val();
                              if (!price_color2) {
                                run = false;
                                alert(
                                  "Chưa nhập giá thứ hai của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra số lượng
                              var quantity_color2 = $(
                                "#quantity_color2").val();
                              if (!quantity_color2) {
                                run = false;
                                alert(
                                  "Chưa nhập số lượng thứ hai của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra ảnh
                              var fileToUpload_2 = $("#fileToUpload_2")
                                .val();
                              if (!fileToUpload_2) {
                                run = false;
                                alert(
                                  "Chưa upload ảnh thứ hai của sản phẩm"
                                  );
                                return false;
                              }

                              if (price_color2 <= 0) {
                                run = false;
                                alert(
                                  "Giá màu thứ hai phải lớn hơn không"
                                  );
                                return false;
                              }
                              if (Number.isInteger(quantity_color2) ==
                                false) {
                                quantity_color2 = Number(
                                  quantity_color2);
                                if (Number.isInteger(quantity_color2) ==
                                  false) {
                                  run = false;
                                  alert(
                                    "Số lượng màu thứ hai không hợp lệ"
                                    );
                                  return false;
                                }
                              }
                            }

                            var price_color2 = $("#price_color2").val();
                            if (!price_color2) {
                              //Rỗng
                            } else {
                              //Không rỗng
                              //Kiểm tra màu
                              var color2 = $("#color2").val();
                              if (!color2) {
                                run = false;
                                alert(
                                  "Chưa nhập màu thứ hai của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra số lượng
                              var quantity_color2 = $(
                                "#quantity_color2").val();
                              if (!quantity_color2) {
                                run = false;
                                alert(
                                  "Chưa nhập số lượng thứ hai của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra ảnh
                              var fileToUpload_2 = $("#fileToUpload_2")
                                .val();
                              if (!fileToUpload_2) {
                                run = false;
                                alert(
                                  "Chưa upload ảnh thứ hai của sản phẩm"
                                  );
                                return false;
                              }

                              if (price_color2 <= 0) {
                                run = false;
                                alert(
                                  "Giá màu thứ hai phải lớn hơn không"
                                  );
                                return false;
                              }
                              if (Number.isInteger(quantity_color2) ==
                                false) {
                                quantity_color2 = Number(
                                  quantity_color2);
                                if (Number.isInteger(quantity_color2) ==
                                  false) {
                                  run = false;
                                  alert(
                                    "Số lượng màu thứ hai không hợp lệ"
                                    );
                                  return false;
                                }
                              }
                            }

                            var quantity_color2 = $("#quantity_color2")
                              .val();
                            if (!quantity_color2) {
                              //Rỗng
                            } else {
                              //Không rỗng
                              //Kiểm tra màu
                              var color2 = $("#color2").val();
                              if (!color2) {
                                run = false;
                                alert(
                                  "Chưa nhập màu thứ hai của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra giá
                              var price_color2 = $("#price_color2")
                              .val();
                              if (!price_color2) {
                                run = false;
                                alert(
                                  "Chưa nhập giá thứ hai của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra ảnh
                              var fileToUpload_2 = $("#fileToUpload_2")
                                .val();
                              if (!fileToUpload_2) {
                                run = false;
                                alert(
                                  "Chưa upload ảnh thứ hai của sản phẩm"
                                  );
                                return false;
                              }

                              if (price_color2 <= 0) {
                                run = false;
                                alert(
                                  "Giá màu thứ hai phải lớn hơn không"
                                  );
                                return false;
                              }
                              if (Number.isInteger(quantity_color2) ==
                                false) {
                                quantity_color2 = Number(
                                  quantity_color2);
                                if (Number.isInteger(quantity_color2) ==
                                  false) {
                                  run = false;
                                  alert(
                                    "Số lượng màu thứ hai không hợp lệ"
                                    );
                                  return false;
                                }
                              }
                            }

                            var fileToUpload_2 = $("#fileToUpload_2")
                              .val();
                            if (!fileToUpload_2) {
                              //Rỗng
                            } else {
                              //Không rỗng
                              //Kiểm tra màu
                              var color2 = $("#color2").val();
                              if (!color2) {
                                run = false;
                                alert(
                                  "Chưa nhập màu thứ hai của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra giá
                              var price_color2 = $("#price_color2")
                              .val();
                              if (!price_color2) {
                                run = false;
                                alert(
                                  "Chưa nhập giá thứ hai của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra số lượng
                              var quantity_color2 = $(
                                "#quantity_color2").val();
                              if (!quantity_color2) {
                                run = false;
                                alert(
                                  "Chưa nhập số lượng thứ hai của sản phẩm"
                                  );
                                return false;
                              }

                              if (price_color2 <= 0) {
                                run = false;
                                alert(
                                  "Giá màu thứ hai phải lớn hơn không"
                                  );
                                return false;
                              }
                              if (Number.isInteger(quantity_color2) ==
                                false) {
                                quantity_color2 = Number(
                                  quantity_color2);
                                if (Number.isInteger(quantity_color2) ==
                                  false) {
                                  run = false;
                                  alert(
                                    "Số lượng màu thứ hai không hợp lệ"
                                    );
                                  return false;
                                }
                              }
                            }


                            //Kiểm tra xem có nhập thông tin màu 3 không
                            var color3 = $("#color3").val();
                            if (!color3) {
                              //Rỗng
                            } else {
                              //Không rỗng
                              //Kiểm tra giá
                              var price_color3 = $("#price_color3")
                              .val();
                              if (!price_color3) {
                                run = false;
                                alert(
                                  "Chưa nhập giá thứ ba của sản phẩm");
                                return false;
                              }
                              //Kiểm tra số lượng
                              var quantity_color3 = $(
                                "#quantity_color3").val();
                              if (!quantity_color3) {
                                run = false;
                                alert(
                                  "Chưa nhập số lượng thứ ba của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra ảnh
                              var fileToUpload_3 = $("#fileToUpload_3")
                                .val();
                              if (!fileToUpload_3) {
                                run = false;
                                alert(
                                  "Chưa upload ảnh thứ ba của sản phẩm"
                                  );
                                return false;
                              }

                              if (price_color3 <= 0) {
                                run = false;
                                alert(
                                  "Giá màu thứ ba phải lớn hơn không");
                                return false;
                              }
                              if (Number.isInteger(quantity_color3) ==
                                false) {
                                quantity_color3 = Number(
                                  quantity_color3);
                                if (Number.isInteger(quantity_color3) ==
                                  false) {
                                  run = false;
                                  alert(
                                    "Số lượng màu thứ ba không hợp lệ"
                                    );
                                  return false;
                                }
                              }
                            }

                            var price_color3 = $("#price_color3").val();
                            if (!price_color3) {
                              //Rỗng
                            } else {
                              //Không rỗng
                              //Kiểm tra màu
                              var color3 = $("#color3").val();
                              if (!color3) {
                                run = false;
                                alert(
                                  "Chưa nhập màu thứ ba của sản phẩm");
                                return false;
                              }
                              //Kiểm tra số lượng
                              var quantity_color3 = $(
                                "#quantity_color3").val();
                              if (!quantity_color3) {
                                run = false;
                                alert(
                                  "Chưa nhập số lượng thứ ba của sản phẩm"
                                  );
                                return false;
                              }
                              //Kiểm tra ảnh
                              var fileToUpload_3 = $("#fileToUpload_3")
                                .val();
                              if (!fileToUpload_3) {
                                run = false;
                                alert(
                                  "Chưa upload ảnh thứ ba của sản phẩm"
                                  );
                                return false;
                              }

                              if (price_color3 <= 0) {
                                run = false;
                                alert(
                                  "Giá màu thứ ba phải lớn hơn không");
                                return false;
                              }
                              if (Number.isInteger(quantity_color3) ==
                                false) {
                                quantity_color3 = Number(
                                  quantity_color3);
                                if (Number.isInteger(quantity_color3) ==
                                  false) {
                                  run = false;
                                  alert(
                                    "Số lượng màu thứ ba không hợp lệ"
                                    );
                                  return false;
                                }
                              }
                            }

                            var quantity_color3 = $("#quantity_color3")
                              .val();
                            if (!quantity_color3) {
                              //Rỗng
                            } else {
                              //Không rỗng
                              //Kiểm tra màu
                              var color3 = $("#color3").val();
                              if (!color3) {
                                run = false;
                                alert(
                                  "Chưa nhập màu thứ ba của sản phẩm");
                                return false;
                              }
                              //Kiểm tra giá
                              var price_color3 = $("#price_color3")
                              .val();
                              if (!price_color3) {
                                run = false;
                                alert(
                                  "Chưa nhập giá thứ ba của sản phẩm");
                                return false;
                              }
                              //Kiểm tra ảnh
                              var fileToUpload_3 = $("#fileToUpload_3")
                                .val();
                              if (!fileToUpload_3) {
                                run = false;
                                alert(
                                  "Chưa upload ảnh thứ ba của sản phẩm"
                                  );
                                return false;
                              }

                              if (price_color3 <= 0) {
                                run = false;
                                alert(
                                  "Giá màu thứ ba phải lớn hơn không");
                                return false;
                              }
                              if (Number.isInteger(quantity_color3) ==
                                false) {
                                quantity_color3 = Number(
                                  quantity_color3);
                                if (Number.isInteger(quantity_color3) ==
                                  false) {
                                  run = false;
                                  alert(
                                    "Số lượng màu thứ ba không hợp lệ"
                                    );
                                  return false;
                                }
                              }
                            }

                            var fileToUpload_3 = $("#fileToUpload_3")
                              .val();
                            if (!fileToUpload_3) {
                              //Rỗng
                            } else {
                              //Không rỗng
                              //Kiểm tra màu
                              var color3 = $("#color3").val();
                              if (!color3) {
                                run = false;
                                alert(
                                  "Chưa nhập màu thứ ba của sản phẩm");
                                return false;
                              }
                              //Kiểm tra giá
                              var price_color3 = $("#price_color3")
                              .val();
                              if (!price_color3) {
                                run = false;
                                alert(
                                  "Chưa nhập giá thứ ba của sản phẩm");
                                return false;
                              }
                              //Kiểm tra số lượng
                              var quantity_color3 = $(
                                "#quantity_color3").val();
                              if (!quantity_color3) {
                                run = false;
                                alert(
                                  "Chưa nhập số lượng thứ ba của sản phẩm"
                                  );
                                return false;
                              }

                              if (price_color3 <= 0) {
                                run = false;
                                alert(
                                  "Giá màu thứ ba phải lớn hơn không");
                                return false;
                              }
                              if (Number.isInteger(quantity_color3) ==
                                false) {
                                quantity_color3 = Number(
                                  quantity_color3);
                                if (Number.isInteger(quantity_color3) ==
                                  false) {
                                  run = false;
                                  alert(
                                    "Số lượng màu thứ ba không hợp lệ"
                                    );
                                  return false;
                                }
                              }
                            }

                            //Kiểm tra số lượng với giá xem hợp lệ không
                            if (price_color1 <= 0) {
                              run = false;
                              alert(
                                "Giá màu thứ nhất phải lớn hơn không");
                              return false;
                            }
                            if (Number.isInteger(quantity_color1) ==
                              false) {
                              quantity_color1 = Number(quantity_color1);
                              if (Number.isInteger(quantity_color1) ==
                                false) {
                                run = false;
                                alert(
                                  "Số lượng màu thứ nhất không hợp lệ"
                                  );
                                return false;
                              }
                            }
                          });
                        });
                        </script>
                      </div>
                    </div>
                  </form>
                </div>
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