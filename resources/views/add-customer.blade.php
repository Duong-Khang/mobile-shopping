<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
    <meta charSet="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thêm khách hàng</title><!-- icon -->
    <link rel="icon" type="image/png" href="../Admin/images/favicon.png" />
    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" />
    <!-- css -->
    <link rel="stylesheet" href="../Admin/vendor/bootstrap/css/bootstrap.ltr.css" />
    <link rel="stylesheet" href="../Admin/vendor/highlight.js/styles/github.css" />
    <link rel="stylesheet" href="../Admin/vendor/simplebar/simplebar.min.css" />
    <link rel="stylesheet" href="../Admin/vendor/quill/quill.snow.css" />
    <link rel="stylesheet" href="../Admin/vendor/air-datepicker/css/datepicker.min.css" />
    <link rel="stylesheet" href="../Admin/vendor/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../Admin/vendor/datatables/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../Admin/vendor/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="../Admin/vendor/fullcalendar/main.min.css" />
    <link rel="stylesheet" href="../Admin/css/style.css" />
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8"></script>
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
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <!-- sa-app__sidebar -->
        <div class="sa-app__sidebar">
            <div class="sa-sidebar">
                <div style="background-color: white;" class="sa-sidebar__header"><a class="sa-sidebar__logo" href="../../Admin/">
                        <!-- logo -->
                        <div class="sa-sidebar-logo">
                            <img style="height: 50px;" src="../Admin/images/logo.png" alt="">
                        </div><!-- logo / end -->
                    </a></div>
                <div class="sa-sidebar__body" data-simplebar="">
                    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
                        <li class="sa-nav__section">
                            <!-- <div class="sa-nav__section-title"><span>Application</span></div> -->
                            <ul class="sa-nav__menu sa-nav__menu--root">
                                <style>
                                    .sa-nav__menu-item {
                                        margin: 10px 0;
                                    }

                                    .sa-nav__icon {
                                        margin: 10px 0;
                                    }
                                </style>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon"><a href="../../Admin/" class="sa-nav__link"><span class="sa-nav__icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                                                <path d="M8,13.1c-4.4,0-8,3.4-8-3C0,5.6,3.6,2,8,2s8,3.6,8,8.1C16,16.5,12.4,13.1,8,13.1zM8,4c-3.3,0-6,2.7-6,6c0,4,2.4,0.9,5,0.2C7,9.9,7.1,9.5,7.4,9.2l3-2.3c0.4-0.3,1-0.2,1.3,0.3c0.3,0.5,0.2,1.1-0.2,1.4l-2.2,1.7c2.5,0.9,4.8,3.6,4.8-0.2C14,6.7,11.3,4,8,4z">
                                                </path>
                                            </svg></span><span class="sa-nav__title">Bảng điều
                                            khiển</span></a></li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open"><a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                                                <path d="M8,6C4.7,6,2,4.7,2,3s2.7-3,6-3s6,1.3,6,3S11.3,6,8,6z M2,5L2,5L2,5C2,5,2,5,2,5z M8,8c3.3,0,6-1.3,6-3v3c0,1.7-2.7,3-6,3S2,9.7,2,8V5C2,6.7,4.7,8,8,8z M14,5L14,5C14,5,14,5,14,5L14,5z M2,10L2,10L2,10C2,10,2,10,2,10z M8,13c3.3,0,6-1.3,6-3v3c0,1.7-2.7,3-6,3s-6-1.3-6-3v-3C2,11.7,4.7,13,8,13z M14,10L14,10C14,10,14,10,14,10L14,10z">
                                                </path>
                                            </svg></span><span class="sa-nav__title">Quản lý sản
                                            phẩm</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                <path d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                </path>
                                            </svg></span></a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item"><a href="../../Admin/app-product-list.php" class="sa-nav__link"><span class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Danh sách sản phẩm</span></a>
                                        </li>

                                        <li class="sa-nav__menu-item"><a href="../../Admin/app-category-list.php" class="sa-nav__link"><span class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Danh mục sản phẩm</span></a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open"><a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                                                <path d="M8,10c-3.3,0-6,2.7-6,6H0c0-3.2,1.9-6,4.7-7.3C3.7,7.8,3,6.5,3,5c0-2.8,2.2-5,5-5s5,2.2,5,5c0,1.5-0.7,2.8-1.7,3.7c2.8,1.3,4.7,4,4.7,7.3h-2C14,12.7,11.3,10,8,10z M8,2C6.3,2,5,3.3,5,5s1.3,3,3,3s3-1.3,3-3S9.7,2,8,2z">
                                                </path>
                                            </svg></span><span class="sa-nav__title">Khách
                                            hàng</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                <path d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                </path>
                                            </svg></span></a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item"><a href="../../Admin/app-customer-list.php" class="sa-nav__link"><span class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Danh sách khách hàng</span></a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open"><a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                                                <path d="M14.2,10.3c-0.1,0.4-0.5,0.7-0.9,0.7H4.8c-0.5,0-0.9-0.3-1-0.8L2.2,4C2.1,3.4,1.6,3,1,3H0.4C0.2,3,0,2.8,0,2.6V1.4C0,1.2,0.2,1,0.4,1h1.4c1,0,1.9,0.7,2.1,1.7l1.5,6.1C5.5,8.9,5.7,9,5.8,9h6.5c0.1,0,0.2-0.1,0.3-0.2l1.1-3.4C13.8,5.2,13.7,5,13.5,5H7.4C7.2,5,7,4.8,7,4.6V3.4C7,3.2,7.2,3,7.4,3H15c0.6,0,1,0.4,1,1v1L14.2,10.3z M4.5,13C5.3,13,6,13.7,6,14.5C6,15.3,5.3,16,4.5,16S3,15.3,3,14.5C3,13.7,3.7,13,4.5,13z M11.5,13c0.8,0,1.5,0.7,1.5,1.5c0,0.8-0.7,1.5-1.5,1.5S10,15.3,10,14.5C10,13.7,10.7,13,11.5,13z">
                                                </path>
                                            </svg></span><span class="sa-nav__title">Đơn đặt
                                            hàng</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                <path d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                </path>
                                            </svg></span></a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item"><a href="../../Admin/app-order-list.php" class="sa-nav__link"><span class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Danh sách đơn đặt
                                                    hàng</span></a></li>

                                    </ul>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open"><a href="#" class="sa-nav__link" data-sa-collapse-trigger=""><span class="sa-nav__icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                                                <path d="M11.5,3C12.9,3,14,4.1,14,5.5c0,2.7-4.3,6.4-6,7.4c-1.7-1-6-4.7-6-7.4C2,4.1,3.1,3,4.5,3C5.3,3,6,3.3,6.4,3.9L8,5.3l1.6-1.4C10,3.3,10.7,3,11.5,3 M11.5,1C10.1,1,8.8,1.6,8,2.7C7.2,1.6,5.9,1,4.5,1C2,1,0,3,0,5.5C0,10,7,15,8,15s8-5,8-9.5C16,3,14,1,11.5,1L11.5,1z">
                                                </path>
                                            </svg></span><span class="sa-nav__title">Khuyến
                                            mãi</span><span class="sa-nav__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="9" viewBox="0 0 6 9" fill="currentColor">
                                                <path d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                </path>
                                            </svg></span></a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item"><a href="../../Admin/app-discount-list.php" class="sa-nav__link"><span class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Danh sách khuyến mãi</span></a>
                                        </li>
                                        <li class="sa-nav__menu-item"><a href="../../Admin/app-code-list.php" class="sa-nav__link"><span class="sa-nav__menu-item-padding"></span><span class="sa-nav__title">Danh sách mã giảm giá</span></a>
                                        </li>


                                    </ul>
                                </li>
                                <li>
                                    <ul class="sa-nav__menu sa-nav__menu--root">
                                        <li style="position: absolute; bottom: 0;" class="sa-nav__menu-item sa-nav__menu-item--has-icon"><a id="my-logout" style="width: 240px;" href="../../Admin/logout.php" class="sa-nav__link"><span class="sa-nav__icon"><i class="fas fa-sign-out-alt"></i></span><span class="sa-nav__title">Đăng xuất</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sa-app__sidebar-shadow"></div>
            <div class="sa-app__sidebar-backdrop" data-sa-close-sidebar=""></div>
        </div><!-- sa-app__sidebar / end -->
        <!-- sa-app__content -->
        <div class="sa-app__content">
            <!-- sa-app__toolbar -->
            <div class="sa-toolbar sa-toolbar--search-hidden sa-app__toolbar">
                <div class="sa-toolbar__body">
                    <div class="sa-toolbar__item"><button class="sa-toolbar__button" type="button" aria-label="Menu" data-sa-toggle-sidebar=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M1,11V9h18v2H1z M1,3h18v2H1V3z M15,17H1v-2h14V17z">
                                </path>
                            </svg></button></div>
                    <div class="sa-toolbar__item sa-toolbar__item--search">

                    </div>
                    <div class="mx-auto"></div>
                    <div class="sa-toolbar__item d-sm-none"><button class="sa-toolbar__button" type="button" aria-label="Show search" data-sa-action="show-search"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z">
                                </path>
                            </svg></button></div>

                    <div class="dropdown sa-toolbar__item"><button class="sa-toolbar-user" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-bs-offset="0,1" aria-expanded="false"><span class="sa-toolbar-user__avatar sa-symbol sa-symbol--shape--rounded"><img src="../Admin/images/user1.png" width="64" height="64" alt="" /></span><span class="sa-toolbar-user__info"><span class="sa-toolbar-user__title">
                                    <!-- Hiển thị username signin -->
                                    <?php

                                    if (isset($_SESSION['username'])) {
                                        $admin = $_SESSION['username'];
                                        echo $admin;
                                    } else {
                                        $admin = "no login admin";
                                    }

                                    ?>
                                </span><span class="sa-toolbar-user__subtitle"></span></span></button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="../../Admin/change-password.php">Đổi mật khẩu</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="../../Admin/logout.php">Đăng
                                    xuất</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sa-toolbar__shadow"></div>
            </div><!-- sa-app__toolbar / end -->
            <input type="hidden" id="loginadmin" value="{{$admin}}">
            <!-- sa-app__body -->
            <div id="top" class="sa-app__body">
                <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
                    <div class="container container--max--xl">
                        <div class="py-5">
                            <div class="row g-4 align-items-center">
                                <div class="col">
                                    <nav class="mb-2" aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-sa-simple">
                                            <li class="breadcrumb-item"><a href="../../Admin/">Trang
                                                    chủ</a></li>
                                            <li class=""><a href="../../Admin/app-customer-list.php">
                                                    / Danh sách khách hàng</a></li>
                                            <li class="" aria-current="page"> / Thêm khách hàng</li>
                                        </ol>
                                    </nav>
                                </div>

                            </div>
                        </div>
                        <div class="sa-entity-layout" data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
                            <div class="sa-entity-layout__body">
                                <div class="sa-entity-layout__main">
                                    <div class="card">
                                        <div class="card-body p-5">
                                            <div class="mb-4"><label for="form-category/name" class="form-label">Tên tài khoản</label><input id="username" type="text" class="form-control" />
                                            </div>

                                            <div class="mb-4"><label for="" class="form-label">Mật
                                                    khẩu</label><input type="password" id="password" class="form-control" />
                                            </div>
                                            <div class="mb-4"><label for="" class="form-label">Nhập
                                                    lại mật khẩu</label><input type="password" id="cpassword" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 20px;" class="col-auto d-flex">
                            <a id="btn_addCustomer" class="btn btn-primary">Thêm</a>
                        </div>
                    </div>

                </div>
            </div><!-- sa-app__body / end -->
            <!-- sa-app__footer -->

        </div><!-- sa-app__content / end -->
        <!-- sa-app__toasts -->
        <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
        <!-- sa-app__toasts / end -->
    </div><!-- sa-app / end -->
    <!-- scripts -->
    <script src="../Admin/vendor/jquery/jquery.min.js"></script>
    <script src="../Admin/vendor/feather-icons/feather.min.js"></script>
    <script src="../Admin/vendor/simplebar/simplebar.min.js"></script>
    <script src="../Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Admin/vendor/highlight.js/highlight.pack.js"></script>
    <script src="../Admin/vendor/quill/quill.min.js"></script>
    <script src="../Admin/vendor/air-datepicker/js/datepicker.min.js"></script>
    <script src="../Admin/vendor/air-datepicker/js/i18n/datepicker.en.js">
    </script>
    <script src="../Admin/vendor/select2/js/select2.min.js"></script>
    <script src="../Admin/vendor/fontawesome/js/all.min.js" data-auto-replace-svg="" async=""></script>
    <script src="../Admin/vendor/chart.js/chart.min.js"></script>
    <script src="../Admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../Admin/vendor/datatables/js/dataTables.bootstrap5.min.js">
    </script>
    <script src="../Admin/vendor/nouislider/nouislider.min.js"></script>
    <script src="../Admin/vendor/fullcalendar/main.min.js"></script>
    <script src="../Admin/js/stroyka.js"></script>
    <script src="../Admin/js/custom.js"></script>
    <script src="../Admin/js/calendar.js"></script>
    <script src="../Admin/js/demo.js"></script>
    <script src="../Admin/js/demo-chart-js.js"></script>
</body>

</html>

<!-- Xử lý thêm khách hàng -->
<script>
    $(document).ready(function() {
        var loginadmin = $("#loginadmin").val();
        if (loginadmin == "no login admin") {
            window.location.href = "../../Admin/login-admin.php";
        }
        //Khi nhấn btn_addCustomer
        $("#btn_addCustomer").click(function() {
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
                alert("Mật khẩu không trùng nhau");
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Gửi ajax
            $.ajax({
                url: "{{route('them-khach-hang')}}",
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
                        alert("Thêm thành công");
                        $("#username").val('');
                        $("#password").val('');
                        $("#cpassword").val('');
                    }
                }
            });
        });
    });
</script>

<?php
ob_flush();
?>