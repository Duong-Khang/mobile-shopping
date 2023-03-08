<?php
ob_start();
session_start();
include "connect.php";
//Lấy did
if (isset($_GET['did']) && $_GET['did'] !== '') {
    $did = $_GET['did'];
} else {
    header("location: ../Admin/app-discount-list.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
  <meta charSet="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <title>Cập nhật khuyến mãi</title><!-- icon -->
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
  <input type="hidden" id="did" value="<?php echo $did ?>">
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
                      <li class=""><a href="../Admin/app-discount-list.php"> /
                          Danh sách khuyến mãi</a></li>
                      <li class="" aria-current="page"> / Cập nhật khuyến mãi
                      </li>
                    </ol>
                  </nav>
                </div>

              </div>
            </div>
            <div class="sa-entity-layout"
              data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
              <?php
                            $sql = "SELECT * FROM discount WHERE id='$did'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            ?>
              <div class="sa-entity-layout__body">
                <div class="sa-entity-layout__main">
                  <div class="card">
                    <div class="card-body p-5">
                      <div class="mb-5">
                      </div>
                      <div class="mb-4"><label for="form-coupon/code"
                          class="form-label">Tên</label><input type="text"
                          class="form-control" id="discount_name" placeholder=""
                          value="<?php echo $row['name'] ?>" />
                      </div>
                      <div class="mb-4"><label for="form-coupon/value"
                          class="form-label">Giá trị %</label><input
                          style="width: 100px;" type="number"
                          class="form-control" id="discount_value"
                          value="<?php echo $row['discount_percent'] ?>" />
                      </div>
                      <div class="mb-4"><label for="form-coupon/limit"
                          class="form-label">Mô tả</label><input type="text"
                          class="form-control" id="discount_desc"
                          value="<?php echo $row['desc'] ?>" /></div>
                      <div class="mb-4">
                        <div class="mb-5">
                          <h2 class="form-label">Trạng thái</h2>
                        </div>
                        <div class="mb-n2 mt-n3">

                          <?php
                                                        if ($row['active'] == 1) {
                                                            echo '<label style="cursor: pointer;" id="discount_active" class="form-check">
                                                            <input type="radio" class="form-check-input" name="status" checked/>
                                                            <span class="form-check-label">Hoạt động</span>
                                                        </label>
                                                        <label style="cursor: pointer;" id="discount_none" class="form-check mb-0">
                                                            <input type="radio" class="form-check-input" name="status" />
                                                            <span class="form-check-label">Hết hạn</span>
                                                        </label>
                                                        <label style="cursor: pointer;" id="discount_delete" class="form-check mb-0">
                                                            <input type="radio" class="form-check-input" name="status" />
                                                            <span class="form-check-label">Đã xóa</span>
                                                        </label>
                                                        <input type="hidden" id="status" value="1">
                                                        ';
                                                        } else if ($row['active'] == 0) {
                                                            echo '<label style="cursor: pointer;" id="discount_active" class="form-check">
                                                            <input type="radio" class="form-check-input" name="status"/>
                                                            <span class="form-check-label">Hoạt động</span>
                                                        </label>
                                                        <label style="cursor: pointer;" id="discount_none" class="form-check mb-0">
                                                            <input type="radio" class="form-check-input" name="status" checked/>
                                                            <span class="form-check-label">Hết hạn</span>
                                                        </label>
                                                        <label style="cursor: pointer;" id="discount_delete" class="form-check mb-0">
                                                            <input type="radio" class="form-check-input" name="status" />
                                                            <span class="form-check-label">Đã xóa</span>
                                                        </label>
                                                        <input type="hidden" id="status" value="0">
                                                        ';
                                                        } else if ($row['active'] == 2) {
                                                            echo '<label style="cursor: pointer;" id="discount_active" class="form-check">
                                                            <input type="radio" class="form-check-input" name="status"/>
                                                            <span class="form-check-label">Hoạt động</span>
                                                        </label>
                                                        <label style="cursor: pointer;" id="discount_none" class="form-check mb-0">
                                                            <input type="radio" class="form-check-input" name="status"/>
                                                            <span class="form-check-label">Hết hạn</span>
                                                        </label>
                                                        <label style="cursor: pointer;" id="discount_delete" class="form-check mb-0">
                                                            <input type="radio" class="form-check-input" name="status" checked />
                                                            <span class="form-check-label">Đã xóa</span>
                                                        </label>
                                                        <input type="hidden" id="status" value="2">
                                                        ';
                                                        }
                                                        ?>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="sa-entity-layout__sidebar">
                  <div class="card w-100">
                    <div class="card-body p-5">
                      <div class="mb-4"><label for="form-coupon/start-date"
                          class="form-label">Ngày bắt đầu</label><input
                          id="start_date" type="text"
                          class="form-control datepicker-here"
                          data-auto-close="true" data-language="en"
                          value="<?php echo $row['start_date'] ?>" /></div>
                      <div><label for="form-coupon/end-date"
                          class="form-label">Ngày kết thúc</label><input
                          id="end_date" type="text"
                          class="form-control datepicker-here"
                          data-auto-close="true" data-language="en"
                          value="<?php echo $row['end_date'] ?>" /></div>
                    </div>
                  </div>
                </div>
              </div>
              <div style="margin-top: 20px;" class="col-auto d-flex">
                <a id="btn_editDiscount" class="btn btn-primary">Cập nhật</a>
              </div>
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

<!-- Xử lý thêm discount -->
<script>
$(document).ready(function() {

  var status = $("#status").val();
  $("#discount_none").click(function() {
    status = 0;
  });
  $("#discount_active").click(function() {
    status = 1;
  });
  $("#discount_delete").click(function() {
    status = 2;
  });
  $("#btn_editDiscount").click(function() {
    // alert(status)
    var discount_name = $("#discount_name").val();
    var discount_desc = $("#discount_desc").val();
    var discount_value = $("#discount_value").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var did = $("#did").val();

    const s_d = new Date(start_date);
    const e_d = new Date(end_date);
    const nd = new Date();
    var y = nd.getFullYear();
    var m = nd.getMonth() + 1;
    var d = nd.getDate();
    var st = m + "/" + d + "/" + y;
    //Kiểm tra xem ngày bắt đầu vs kết thúc có phải là ngày hiện tại or tương lai k
    const now = new Date(st);
    var check = s_d - now;
    var check_ = e_d - now;
    if (check < 0) {
      alert("Chọn ngày bắt đầu không hợp lệ");
      return false;
    } else if (check_ <= 0) {
      alert("Chọn ngày bắt đầu không hợp lệ");
      return false;
    }

    if (!discount_name) {
      alert("Chưa nhập tên");
      return false;
    }
    if (!discount_desc) {
      alert("Chưa nhập mô tả");
      return false;
    }
    if (!discount_value) {
      alert("Chưa nhập giá trị");
      return false;
    }
    if (!start_date) {
      alert("Chưa nhập ngày bắt đầu");
      return false;
    }
    if (!end_date) {
      alert("Chưa nhập ngày kết thúc");
      return false;
    }
    //Kiểm tra discount value có hợp lệ k
    if (discount_value <= 0) {
      alert("Giá trị phải lớn hơn không");
      return false;
    } else if (Number.isInteger(discount_value) == false) {
      discount_value = Number(discount_value);
      if (Number.isInteger(discount_value) == false) {
        alert("Giá trị phải là số nguyên");
        return false;
      }
    } else if (discount_value > 100) {
      alert("Giá trị không cho phép");
      return false;
    }
    //Kiểm tra xem ngày bắt đầu và ngày kết thúc có hợp lệ không
    const sd = new Date(start_date);
    const ed = new Date(end_date);

    var d = ed - sd;
    if (d <= 0) {
      alert("Chọn ngày bắt đầu không hợp lệ");
      return false;
    }

    $.ajax({
      url: "Controller/ControllerEditDiscount.php",
      type: "get",
      dataType: "text",
      data: {
        discount_name: discount_name,
        discount_desc: discount_desc,
        discount_value: discount_value,
        start_date: start_date,
        end_date: end_date,
        status: status,
        did: did
      },
      success: function(result) {
        if (result !== "Success") {
          alert(result);
        } else {
          alert("Sửa thành công");
          window.location.href = "../Admin/app-discount-list.php";
        }
      }
    });
  });
});
</script>