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
  <title>Đổi mật khẩu</title><!-- icon -->
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
      <input type="hidden" id="admin" value="<?php echo $admin ?>">
      <!-- sa-app__body -->
      <div id="top" class="sa-app__body px-2 px-lg-4">
        <div class="card w-25x flex-grow-1 flex-sm-grow-0 m-sm-auto">
          <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
            <h1 class="mb-0 fs-3" style="text-align: center;">Đổi mật khẩu</h1>
            <div class="fs-exact-14 text-muted mt-2 pt-1 mb-5 pb-2"></div>
            <div class="mb-4"><label class="form-label">Mật khẩu
                cũ</label><input type="password"
                class="form-control form-control-lg" id="passwordOld" /></div>
            <div class="mb-4"><label class="form-label">Mật khẩu
                mới</label><input type="password"
                class="form-control form-control-lg" id="passwordNew" /></div>
            <div class="mb-4"><label class="form-label">Nhập lại mật
                khẩu</label><input type="password"
                class="form-control form-control-lg" id="passwordConfirm" />
            </div>
            <div><button id="btn_change_password" type="submit"
                class="btn btn-primary btn-lg w-100">Xác nhận</button></div>
          </div>
          <div class="sa-divider sa-divider--has-text">
          </div>
        </div>
      </div><!-- scripts -->
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

<script>
$(document).ready(function() {
  $("#btn_change_password").click(function() {
    //Lấy mật khẩu cũ
    var passwordOld = $("#passwordOld").val();
    //Kiểm tra xem có hợp lệ không
    if (!passwordOld) {
      alert("Chưa nhập mật khẩu cũ");
      return false;
    }
    //var passwordOldClear = passwordOld.replace(/[^a-zA-Z]/g, "");
    //Lấy mật khẩu mới
    var passwordNew = $("#passwordNew").val();
    if (!passwordNew) {
      alert("Chưa nhập mật khẩu mới");
      return false;
    }
    //Lấy nhập lại mật khẩu mới
    var passwordConfirm = $("#passwordConfirm").val();
    if (!passwordConfirm) {
      alert("Chưa nhập lại mật khẩu mới");
      return false;
    }
    if (passwordNew != passwordConfirm) {
      alert("Hai mật khẩu không trùng");
      return false;
    }
    //Lấy admin
    var admin = $("#admin").val();

    //Gửi ajax
    $.ajax({
      url: "Controller/ControllerChangePassword.php",
      type: "post",
      dataType: "text",
      data: {
        passwordOld: passwordOld,
        passwordNew: passwordNew,
        admin: admin
      },
      success: function(result) {
        if (result == 1) {
          alert("Đổi mật khẩu thành công");
          window.location.href = "../Admin/";
        } else {
          alert(result)
        }

      }
    });
  });
});
</script>