<?php
ob_start();
session_start();
include "connect.php";
//Lấy uid
if (isset($_GET['uid']) && $_GET['uid'] !== '') {
    $uid = $_GET['uid'];
} else {
    header("location: ../Admin/app-customer-list.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
  <meta charSet="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="format-detection" content="telephone=no" />
  <title>Cập nhật khách hàng</title><!-- icon -->
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
  <input type="hidden" id="user_id" value="<?php echo $uid ?>">
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
                      <li class=""><a href="../Admin/app-customer-list.php"> /
                          Danh sách khách hàng</a></li>
                      <li class="" aria-current="page"> / Cập nhật khách hàng
                      </li>
                    </ol>
                  </nav>
                  <!-- <h1 class="h3 m-0">Edit Category</h1> -->
                </div>
                <div class="col-auto d-flex">
                  <!-- <a href="#" class="btn btn-secondary me-3">Duplicate</a> -->
                  <a id="btn_editCustomer" class="btn btn-primary">Cập nhật</a>
                </div>
              </div>
            </div>
            <div class="sa-entity-layout"
              data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
              <div class="sa-entity-layout__body">
                <div class="sa-entity-layout__main">
                  <div class="card">
                    <div class="card-body p-5">
                      <!-- <div class="mb-5">
                                                <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                            </div> -->
                      <div class="mb-4"><label for="form-category/name"
                          class="form-label">Tên tài khoản</label><input
                          id="username" type="text" class="form-control" />
                      </div>

                      <div class="mb-4"><label for="" class="form-label">Mật
                          khẩu</label><input type="password" id="password"
                          class="form-control"></input>
                      </div>
                      <div class="mb-4"><label for="" class="form-label">Nhập
                          lại mật khẩu</label><input type="password"
                          id="cpassword" class="form-control"></input>
                      </div>
                      <div class="mb-4">
                        <div class="mb-5">
                          <h2 class="form-label">Trạng thái</h2>
                        </div>
                        <div class="mb-n2 mt-n3">
                          <label style="cursor: pointer;" id="user_active"
                            class="form-check">
                            <input id="check_active" type="radio"
                              class="form-check-input" name="status" />
                            <span class="form-check-label">Hoạt động</span>
                          </label>
                          <label style="cursor: pointer;" id="user_noactive"
                            class="form-check mb-0">
                            <input id="check_noactive" type="radio"
                              class="form-check-input" name="status" />
                            <span class="form-check-label">Không hoạt
                              động</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
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
<!-- Mirrored from stroyka-admin.html.themeforest.scompiler.ru/variants/ltr/app-category.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Sep 2021 08:12:13 GMT -->

</html>
<?php
ob_flush();
?>

<!-- Xử lý thêm khách hàng -->
<script>
$(document).ready(function() {
  //Lấy thông tin cũ
  var uid = $("#user_id").val();

  $.ajax({
    url: "Controller/ControlllerGetInfoUserOld.php",
    type: "get",
    dataType: "json",
    data: {
      uid: uid
    },
    success: function(result) {
      var username = '';
      var password = '';
      var check = 0;
      $.each(result, function(key, item) {
        username = item['username'];
        password = item['password'];
        check = item['check'];
      });
      $("#username").val(username);
      $("#password").val(password);
      $("#cpassword").val(password);
      if (check == 1) {
        $("#check_active").attr("checked", "checked");
      } else if (check == 0) {
        $("#check_noactive").attr("checked", "checked");
      }
    }
  });

  //Xử lý status
  var status = 1;

  $("#user_active").click(function() {
    status = 1;
  });

  $("#user_noactive").click(function() {
    status = 0;
  });

  //Xử lý update info user
  $("#btn_editCustomer").click(function() {
    var uid = $("#user_id").val();
    //Lấy username
    var username = $("#username").val();
    //Lấy password
    var password = $("#password").val();
    //Lấy nhập lại password
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
      alert("Mật khẩu không giống nhau");
      return false;
    }
    //Gửi ajax
    $.ajax({
      url: "Controller/ControllerUpdateInfoUser.php",
      type: "get",
      dataType: "text",
      data: {
        uid: uid,
        username: username,
        password: password,
        status: status
      },
      success: function(result) {
        if (result !== "Success") {
          alert(result);
        } else {
          alert("Cập nhật thành công");
          window.location.href = "../Admin/app-customer-list.php";
        }
      }
    });
  });
});
</script>