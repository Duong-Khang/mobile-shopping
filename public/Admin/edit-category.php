<?php
ob_start();
session_start();
include "connect.php";
//Lấy category_id
if (
    isset($_GET['category_id']) &&
    $_GET['category_id'] != ''
) {
    $category_id = $_GET['category_id'];
} else {
    header("location: app-category-list");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
  <meta charSet="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <title>Cập nhật danh mục sản phẩm</title><!-- icon -->
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
  <input type="hidden" id="categoryID" value="<?php echo $category_id ?>">
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
                      <li class=""><a href="../Admin/app-category-list.php"> /
                          Danh mục sản phẩm</a></li>
                      <li class="" aria-current="page"> / Cập nhật danh mục</li>
                    </ol>
                  </nav>
                </div>

              </div>
            </div>
            <div class="sa-entity-layout"
              data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
              <div class="sa-entity-layout__body">
                <div class="sa-entity-layout__main">
                  <?php
                                    $sql = "SELECT * FROM product_category WHERE id='$category_id'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                    ?>
                  <div class="card">
                    <div class="card-body p-5">
                      <div class="mb-4"><label for="form-category/name"
                          class="form-label">Tên danh mục</label><input
                          id="category_name" value="<?php echo $row['name'] ?>"
                          type="text" class="form-control" />
                      </div>

                      <div class="mb-4"><label for="" class="form-label">Mô
                          tả</label><textarea id="category_desc"
                          class="form-control"
                          rows="4"><?php echo $row['desc'] ?></textarea>
                      </div>

                      <div class="mb-4">
                        <div class="mb-5">
                          <h2 class="form-label">Trạng thái</h2>
                        </div>
                        <div class="mb-n2 mt-n3">
                          <?php

                                                        if ($row['delete_at_category'] == NULL) {
                                                            echo '<label style="cursor: pointer;" id="cate_active" class="form-check">
                                                            <input type="radio" class="form-check-input" name="status" checked/>
                                                            <span class="form-check-label">Hoạt động</span>
                                                        </label>
                                                        <label style="cursor: pointer;" id="cate_noactive" class="form-check mb-0">
                                                            <input type="radio" class="form-check-input" name="status" />
                                                            <span class="form-check-label">Không hoạt động</span>
                                                        </label>
                                                        <input type="hidden" id="status" value="1">';
                                                        } else if ($row['delete_at_category'] != NULL) {
                                                            echo '<label style="cursor: pointer;" id="cate_active" class="form-check">
                                                            <input type="radio" class="form-check-input" name="status" />
                                                            <span class="form-check-label">Hoạt động</span>
                                                        </label>
                                                        <label style="cursor: pointer;" id="cate_noactive" class="form-check mb-0">
                                                            <input type="radio" class="form-check-input" name="status" checked/>
                                                            <span class="form-check-label">Không hoạt động</span>
                                                        </label>
                                                        <input type="hidden" id="status" value="0">';
                                                        }

                                                        ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                                    }
                                    ?>
                </div>
              </div>
            </div>
            <div style="margin-top: 20px;" class="col-auto d-flex">
              <a id="btn_categoryRepair" class="btn btn-primary">Cập nhật</a>
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

<!-- Xử lý thêm danh mục sản phẩm -->
<script>
$(document).ready(function() {

  var status = $("#status").val();

  $("#cate_active").click(function() {
    status = 1;
  });

  $("#cate_noactive").click(function() {
    status = 0;
  });

  //Khi nhấn btn_categoryRepair
  $("#btn_categoryRepair").click(function() {

    //Lấy name
    var name = $("#category_name").val();
    if (!name) {
      alert("Chưa nhập tên danh mục");
      return false;
    }
    //Lấy desc
    var desc = $("#category_desc").val();
    if (!desc) {
      alert("Chưa nhập mô tả");
      return false;
    }
    //Lấy id
    var categoryID = $("#categoryID").val();
    //Gửi ajax
    $.ajax({
      url: "Controller/ControllerUpdateCategory.php",
      type: "get",
      dataType: "text",
      data: {
        name: name,
        desc: desc,
        categoryID: categoryID,
        status: status
      },
      success: function(result) {
        if (result !== "Success") {
          alert(result);
        } else {
          alert("Sửa thành công");
          window.location.href = "../Admin/app-category-list.php";
        }
      }
    });
  });

});
</script>