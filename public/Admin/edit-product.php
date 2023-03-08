<?php
ob_start();
session_start();
include "connect.php";

//Lấy pid
if (isset($_GET['pid']) && $_GET['pid'] != '') {
    $pid = $_GET['pid'];
} else {
    header("location: ../Admin/app-product-list.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
  <meta charSet="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <title>Cập nhật sản phẩm</title><!-- icon -->
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
                      <li class="" aria-current="page"> / Cập nhật sản phẩm</li>
                    </ol>
                  </nav>
                </div>

              </div>
            </div>
            <div class="sa-entity-layout"
              data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
              <?php
                            $sql = "SELECT product.*, description.*, product_inventory.*, product.id AS pid, description.id AS did, product_inventory.id AS iid, product.delete_at AS remove_product
                                FROM ((product
                                INNER JOIN description ON description.product_id = product.id)
                                INNER JOIN product_inventory ON product_inventory.id = product.inventory_id)
                                WHERE product.id='$pid'
                                ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            ?>
              <div class="sa-entity-layout__body">
                <div class="sa-entity-layout__main">
                  <div class="card">
                    <div class="card-body p-5">
                      <div class="mb-4">
                        <label for="form-product/name" class="form-label">Tên
                          sản phẩm</label>
                        <input type="text" class="form-control"
                          id="product_name"
                          value="<?php echo $row['name'] ?>" />
                      </div>

                      <div class="mb-4">
                        <label for="form-product/description"
                          class="form-label">Mô tả</label>
                        <textarea id="product_desc" class="form-control"
                          rows="6"><?php echo $row['desc'] ?></textarea>
                      </div>
                      <div>
                        <label for="form-product/short-description"
                          class="form-label">Mô tả ngắn</label>
                        <textarea id="short_desc" class="form-control"
                          rows="4"><?php echo $row['small_desc'] ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="card mt-5">
                    <div class="card-body p-5">
                      <div class="mb-4">
                        <label for="form-product/sku"
                          class="form-label">ROM</label>
                        <input type="text" class="form-control" id="rom"
                          value="<?php echo $row['rom'] ?>" />
                        <label for="form-product/sku"
                          class="form-label">RAM</label>
                        <input type="text" class="form-control" id="ram"
                          value="<?php echo $row['ram'] ?>" />
                        <label for="form-product/sku" class="form-label">Chip
                          GPU</label>
                        <input type="text" class="form-control" id="chip_gpu"
                          value="<?php echo $row['chip_gpu'] ?>" />
                        <label for="form-product/sku" class="form-label">Chip
                          Set</label>
                        <input type="text" class="form-control" id="chip_set"
                          value="<?php echo $row['chip_set'] ?>" />
                        <label for="form-product/sku" class="form-label">Độ phân
                          giải màn hình</label>
                        <input type="text" class="form-control" id="screen"
                          value="<?php echo $row['sr'] ?>" />
                      </div>
                    </div>
                  </div>
                  <div class="card mt-5">
                    <div class="card-body p-5">
                    </div>
                    <div class="mt-n5">
                      <div class="sa-divider"></div>
                      <div class="table-responsive">
                        <table class="sa-table">
                          <thead>
                            <tr>
                              <th class="w-min">Ảnh</th>
                              <th class="w-min">Màu</th>
                              <th class="w-min">Giá</th>
                              <th class="w-min">Số lượng</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                                            //Hiển thị thông tin sản phẩm theo màu
                                                            if ($row['color1'] != NULL) {
                                                            ?>
                            <tr>
                              <td>
                                <div
                                  class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                  <img
                                    src="/product_images_desc/<?php echo $row['photo_color1'] ?>"
                                    width="40" height="40" alt="" />
                                </div>
                              </td>
                              <td><?php echo $row['dcolor1'] ?></td>
                              <td><input type="number"
                                  class="form-control form-control-sm w-10x"
                                  id="price_color1"
                                  value="<?php echo $row['price_color1'] ?>" />
                              </td>
                              <td>
                                <input type="number"
                                  class="form-control form-control-sm w-4x"
                                  id="quantity_color1"
                                  value="<?php echo $row['quantity_color1'] ?>" />
                              </td>
                            </tr>
                            <?php
                                                            }
                                                            ?>

                            <?php
                                                            if ($row['color2'] != NULL) {
                                                            ?>
                            <tr>
                              <td>
                                <div
                                  class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                  <img
                                    src="/product_images_desc/<?php echo $row['photo_color2'] ?>"
                                    width="40" height="40" alt="" />
                                </div>
                              </td>
                              <td><?php echo $row['dcolor2'] ?></td>
                              <td><input type="number"
                                  class="form-control form-control-sm w-10x"
                                  id="price_color2"
                                  value="<?php echo $row['price_color2'] ?>" />
                              </td>
                              <td>
                                <input type="number"
                                  class="form-control form-control-sm w-4x"
                                  id="quantity_color2"
                                  value="<?php echo $row['quantity_color2'] ?>" />
                              </td>
                            </tr>
                            <?php
                                                            }
                                                            ?>

                            <?php
                                                            if ($row['color3'] != NULL) {
                                                            ?>
                            <tr id="row_color3">
                              <td>
                                <div
                                  class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                  <img
                                    src="/product_images_desc/<?php echo $row['photo_color3'] ?>"
                                    width="40" height="40" alt="" />
                                </div>
                              </td>
                              <td><?php echo $row['dcolor3'] ?></td>
                              <td><input type="number"
                                  class="form-control form-control-sm w-10x"
                                  id="price_color3"
                                  value="<?php echo $row['price_color3'] ?>" />
                              </td>
                              <td>
                                <input type="number"
                                  class="form-control form-control-sm w-4x"
                                  id="quantity_color3"
                                  value="<?php echo $row['quantity_color3'] ?>" />
                              </td>
                            </tr>
                            <?php
                                                            }
                                                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="sa-entity-layout__sidebar">
                  <div class="card w-100">
                    <div class="card-body p-5">
                      <div class="mb-5">
                        <h2 class="mb-0 fs-exact-18">Trang thái</h2>
                      </div>
                      <?php
                                                if ($row['remove_product'] != NULL) {
                                                ?>
                      <div class="mb-4"><label id="btn_status_active"
                          style="cursor: pointer;" class="form-check">
                          <input type="radio" class="form-check-input"
                            name="status" />
                          <span class="form-check-label">Hoạt động</span>
                        </label>
                        <label id="btn_status_noactive" style="cursor: pointer;"
                          class="form-check">
                          <input type="radio" class="form-check-input"
                            name="status" checked="" />
                          <span class="form-check-label">Không hoạt động</span>
                        </label>
                        <input type="hidden" id="status" value="0">
                        <?php
                                                } else {
                                                    ?>
                        <div class="mb-4"><label id="btn_status_active"
                            style="cursor: pointer;" class="form-check">
                            <input type="radio" class="form-check-input"
                              name="status" checked="" />
                            <span class="form-check-label">Hoạt động</span>
                          </label>
                          <label id="btn_status_noactive"
                            style="cursor: pointer;" class="form-check">
                            <input type="radio" class="form-check-input"
                              name="status" />
                            <span class="form-check-label">Không hoạt
                              động</span>
                          </label>
                          <input type="hidden" id="status" value="1">
                          <?php
                                                    }
                                                        ?>

                        </div>
                      </div>
                    </div>
                    <div class="card w-100 mt-5">
                      <div class="card-body p-5">
                        <div class="mb-5">
                          <h2 class="mb-0 fs-exact-18">Khuyến mãi</h2>
                        </div>
                        <select id="choose_discount"
                          class="sa-select2 form-select">
                          <?php
                                                        $discount_id = $row['discount_id'];
                                                        $sqlDis = "SELECT * FROM discount WHERE id='$discount_id'";
                                                        $resultDis = $conn->query($sqlDis);
                                                        if ($resultDis->num_rows > 0) {
                                                            $rowDis = $resultDis->fetch_assoc();
                                                            if ($rowDis['delete_at'] == NULL) {
                                                                if ($rowDis['active'] == 1) {
                                                                    echo '<option value="' . $rowDis['id'] . '">' . $rowDis['discount_percent'] . '%</option>';
                                                                } else if ($rowDis['active'] == 0) {
                                                                    echo '<option value="' . $rowDis['id'] . '">' . $rowDis['discount_percent'] . '% đã hết hạn</option>';
                                                                }
                                                            } else if ($rowDis['delete_at'] != NULL) {
                                                            }
                                                            $sqlD = "SELECT * FROM discount WHERE id != '$discount_id' AND delete_at IS NULL AND active='1'";
                                                            $resultD = $conn->query($sqlD);
                                                            if ($resultD->num_rows > 0) {
                                                                while ($rowD = $resultD->fetch_assoc()) {
                                                        ?>
                          <option value="<?php echo $rowD['id'] ?>">
                            <?php
                                                                        echo $rowD['discount_percent'] . "%";
                                                                        ?>
                          </option>
                          <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                        </select>
                      </div>
                    </div>

                    <div class="card w-100 mt-5">
                      <div class="card-body p-5">
                        <div class="mb-5">
                          <h2 class="mb-0 fs-exact-18">Danh mục</h2>
                        </div>
                        <select id="choose_category"
                          class="sa-select2 form-select">
                          <?php
                                                        $category_id = $row['category_id'];
                                                        $sqlCate = "SELECT * FROM product_category WHERE id='$category_id'";
                                                        $resultCate = $conn->query($sqlCate);
                                                        if ($resultCate->num_rows > 0) {
                                                            $rowCate = $resultCate->fetch_assoc();
                                                            echo '<option value="' . $rowCate['id'] . '">' . $rowCate['name'] . '</option>';
                                                            $sqlC = "SELECT * FROM product_category WHERE id != '$category_id' AND delete_at_category IS NULL";
                                                            $resultC = $conn->query($sqlC);
                                                            if ($resultC->num_rows > 0) {
                                                                while ($rowC = $resultC->fetch_assoc()) {
                                                        ?>
                          <option value="<?php echo $rowC['id'] ?>">
                            <?php echo $rowC['name'] ?></option>
                          <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                        </select>
                      </div>
                    </div>

                  </div>
                </div>
                <div style="margin-top: 20px;" class="col-auto d-flex">
                  <a style="cursor: pointer;" id="btn_update_product"
                    class="btn btn-primary">Cập nhật</a>
                </div>
                <!-- Product id -->
                <input type="hidden" id="product_id" value="<?php echo $pid ?>">
                <?php
                            }
                                ?>
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
<!-- Xử lý submit update product -->
<script>
$(document).ready(function() {
  //Lấy status
  var status = $("#status").val();
  //Khi chọn status
  $("#btn_status_active").click(function() {
    status = 1;
  });
  $("#btn_status_noactive").click(function() {
    status = 0;
  });
  //Khi nhấn nút Cập nhật
  $("#btn_update_product").click(function() {
    //Lấy product id
    var pid = $("#product_id").val();
    //Lấy tên sản phẩm
    var name = $("#product_name").val();
    //Lấy mô tả
    var desc = $("#product_desc").val();
    //Lấy mô tả ngắn
    var short_desc = $("#short_desc").val();
    //Lấy ROM
    var rom = $("#rom").val();
    //Lấy ram
    var ram = $("#ram").val();
    //Lấy chip gpu
    var chip_gpu = $("#chip_gpu").val();
    //Lấy chip set
    var chip_set = $("#chip_set").val();
    //Lấy màn hình
    var screen = $("#screen").val();
    //Lấy % khuyến mãi
    var discount = $("#choose_discount").val();
    //Lấy danh mục
    var category = $("#choose_category").val();
    //Lấy giá, số lượng color1
    var price_color1 = $("#price_color1").val();
    var quantity_color1 = $("#quantity_color1").val();
    //Lấy giá, số lượng color2
    var price_color2 = $("#price_color2").val();
    var quantity_color2 = $("#quantity_color2").val();
    if (!price_color2) {
      price_color2 = "none";
    }
    if (!quantity_color2) {
      quantity_color2 = "none";
    }
    //Lấy giá, số lượng color3
    var price_color3 = $("#price_color3").val();
    var quantity_color3 = $("#quantity_color3").val();
    if (!price_color3) {
      price_color3 = "none";
    }
    if (!quantity_color3) {
      quantity_color3 = "none";
    }
    //Gửi ajax
    $.ajax({
      url: "Controller/ControllerUpdateProduct.php",
      type: "get",
      dataType: "text",
      data: {
        pid: pid,
        name: name,
        desc: desc,
        short_desc: short_desc,
        rom: rom,
        ram: ram,
        chip_gpu: chip_gpu,
        chip_set: chip_set,
        screen: screen,
        status: status,
        discount: discount,
        category: category,
        price_color1: price_color1,
        quantity_color1: quantity_color1,
        price_color2: price_color2,
        quantity_color2: quantity_color2,
        price_color3: price_color3,
        quantity_color3: quantity_color3
      },
      success: function(result) {
        if (result ==
          "SuccessSuccessSuccessSuccessSuccessSuccessSuccess") {
          alert("Cập nhật thành công!");
          window.location.href = "../Admin/app-product-list.php";
        } else {
          alert("Cập nhật thất bại");
        }
      }
    });
  });
});
</script>