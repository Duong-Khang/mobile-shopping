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
  <title>Sign up</title><!-- icon -->
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
  <div class="min-h-100 p-0 p-sm-6 d-flex align-items-stretch">
    <div class="card w-25x flex-grow-1 flex-sm-grow-0 m-sm-auto">
      <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
        <h1 class="mb-0 fs-3" style="text-align: center;">Đăng ký</h1>
        <div class="fs-exact-14 text-muted mt-2 pt-1 mb-5 pb-2"></div>
        <div class="mb-4"><label class="form-label">Tên tài khoản</label><input
            id="username" type="text" class="form-control form-control-lg" />
        </div>
        <div class="mb-4"><label class="form-label">Mật khẩu</label><input
            id="password" type="password"
            class="form-control form-control-lg" /></div>
        <div class="mb-4"><label class="form-label">Nhập lại mật
            khẩu</label><input id="cpassword" type="password"
            class="form-control form-control-lg" /></div>
        <div><button type="submit" id="btn_signup"
            class="btn btn-primary btn-lg w-100">Đăng ký</button></div>
      </div>
      <div class="form-group mb-4 mt-0 pt-2 text-center text-muted">Đã có tài
        khoản? <a href="../Admin/login-admin.php">Đăng nhập</a></div>
    </div>
  </div>
  </div><!-- scripts -->
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

<!-- Xử lý đăng ký -->
<script>
$(document).ready(function() {
  //Khi nhấn btn_signup
  $("#btn_signup").click(function() {
    //Lấy username
    var username = $("#username").val();
    //Lấy password
    var password = $("#password").val();
    //Lấy cpassword
    var cpassword = $("#cpassword").val();
    //Kiểm tra
    if (!username) {
      alert("Chưa nhập tên tài khoản");
      return false;
    }
    if (!password) {
      alert("Chưa nhập mật khẩu");
      return false;
    }
    if (!cpassword) {
      alert("Chưa nhập lại mật khẩu");
      return false;
    }
    if (password !== cpassword) {
      alert("Hai mật khẩu không trùng");
      return false;
    }
    //Gửi ajax
    $.ajax({
      url: "Controller/ControllerSignup.php",
      type: "post",
      dataType: "text",
      data: {
        username: username,
        password: password
      },
      success: function(result) {
        if (result !== "Success") {
          alert(result);
        } else {
          window.location.href = '../Admin';
        }
      }
    });
  });
});
</script>

<?php
ob_flush();
?>