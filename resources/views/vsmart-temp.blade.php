<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <!-- Page Title -->
  <title>Danh mục vsmart</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>
  <!--Fevicon-->
  <link rel="icon" href="assets/img/icon/favicon.ico" type="image/x-icon" />
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- linear-icon -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/linear-icon.css">
  <!-- all css plugins css -->
  <link rel="stylesheet" href="assets/css/plugins.css">
  <!-- default style -->
  <link rel="stylesheet" href="assets/css/default.css">
  <!-- Main Style css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- responsive css -->
  <link rel="stylesheet" href="assets/css/responsive.css">
  <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
  <!-- Modernizer JS -->
  <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
  <input type="hidden" name="" id="value_product" value="Vsmart">
  <!-- header area start -->
  <header class="header-pos">
    <!-- Bắt đầu header top -->
    @include('layout.header-top')
    <!-- Kết thúc header top -->
    <!-- Bắt đầu header middle -->
    @include('layout.header-middle')
    <!-- Kết thúc header middle -->
    <!-- Bắt đầu header top menu -->
    @include('layout.header-top-menu')
    <!-- Kết thúc header top menu -->
  </header>
  <!-- header area end -->

  <!-- breadcrumb area start -->
  <div class="breadcrumb-area mb-30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumb-wrap">
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a>Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh mục
                  vsmart</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb area end -->

  <!-- shop page main wrapper start -->
  <div class="main-wrapper pt-35">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3">
          <div class="shop-sidebar-inner mb-30">
            <!-- filter-price-content start -->
            <div class="single-sidebar mb-45">
              <div class="sidebar-inner-title mb-25">
                <h3>Giá</h3>
              </div>
              <div class="sidebar-content-box">
                <div class="filter-price-content">
                  {{-- <form action="#" method="post"> --}}
                  <div id="price-slider"
                    class="price-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                    <div class="ui-slider-range ui-widget-header ui-corner-all"
                      style="left: 16.6667%; width: 79.1667%;"></div><span
                      class="ui-slider-handle ui-state-default ui-corner-all"
                      tabindex="0" style="left: 16.6667%;"></span><span
                      class="ui-slider-handle ui-state-default ui-corner-all"
                      tabindex="0" style="left: 95.8333%;"></span>
                  </div>
                  <div class="filter-price-wapper">
                    <div class="filter-price-cont">
                      <div class="input-type">
                        <input style="width: 100px; border: 1px solid #6c757d;"
                          id="min-price" type="text">
                      </div>
                      <div class="input-type">
                        <input style="width: 100px; border: 1px solid #6c757d;"
                          id="max-price" type="text">
                      </div>

                      <input id="min-price-save" type="hidden">
                      <input id="max-price-save" type="hidden">
                    </div>
                    <div>
                      <input id="btn_price" class="btn btn-secondary"
                        type="submit" value="Áp dụng">
                    </div>
                  </div>
                  {{-- </form>   --}}
                </div>
              </div>
            </div>
            <script>
            $(document).ready(function() {
              $("#btn_price").click(function() {
                $(document).scrollTop(600);
                // var min = $("#min-price-save").val();
                // var max = $("#max-price-save").val();
                var value_product = $("#value_product").val();
                var apdungFrom = $("#min-price-save").val();
                var apdungTo = $("#max-price-save").val();

                if (apdungFrom == '') {
                  alert("Bạn chưa điền giá bắt đầu");
                  return false;
                }

                if (apdungTo == '') {
                  alert("Bạn chưa điền giá kết thúc");
                  return false;
                }

                $.ajax({
                  url: "{{route('ap-dung-gia')}}",
                  type: "get",
                  dataType: "text",
                  data: {
                    value_product: value_product,
                    apdungFrom: apdungFrom,
                    apdungTo: apdungTo
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);
                  }
                });
              });
            });
            </script>
            <!-- filte price end -->
            <!-- categories filter start -->
            <div class="single-sidebar mb-45">
              <div class="sidebar-inner-title mb-25">
                <h3>ROM</h3>
              </div>
              <div class="sidebar-content-box">
                <div class="filter-attribute-container">
                  <ul>
                    <li><a id="btn_32" style="cursor: pointer;"
                        onclick="changeurl(32, '')">32GB</a></li>
                    <li><a id="btn_32_hide" style="cursor: pointer;"
                        onclick="changeurlHide(32)">32GB</a></li>
                    <li><a id="btn_64" style="cursor: pointer;"
                        onclick="changeurl(64, '')">64GB</a></li>
                    <li><a id="btn_64_hide" style="cursor: pointer;"
                        onclick="changeurlHide(64)">64GB</a></li>
                    <li><a id="btn_128" style="cursor: pointer;"
                        onclick="changeurl(128, '')">128GB</a></li>
                    <li><a id="btn_128_hide" style="cursor: pointer;"
                        onclick="changeurlHide(128)">128GB</a></li>
                    <li><a id="btn_256" style="cursor: pointer;"
                        onclick="changeurl(256, '')">256GB</a></li>
                    <li><a id="btn_256_hide" style="cursor: pointer;"
                        onclick="changeurlHide(256)">256GB</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <script>
            function changeurl(url, title) {
              var urlPage = window.location.pathname;
              var new_url = urlPage + "?filter=" + url;
              window.history.pushState('data', title, new_url);
            }

            function changeurlHide(url) {
              var urlPage = window.location.pathname;
              var new_url = urlPage;
              $('#btn_' + url + '').show();
              window.history.pushState('data', '', new_url);
            }
            </script>
            <script>
            $(document).ready(function() {
              $("#btn_32_hide").hide();
              $("#btn_32").click(function() {
                $(this).hide();
                $(document).scrollTop(600);
                $("#btn_32_hide").show();
                $('#btn_32_hide').addClass("active gb");

                $("#btn_64_hide").hide();
                $("#btn_64").show();
                $("#btn_128_hide").hide();
                $("#btn_128").show();
                $("#btn_256_hide").hide();
                $("#btn_256").show();
                const rom = new URLSearchParams(window.location.search)
                  .get('filter');
                console.log(rom);

                //Lấy value_product
                var value_product = $("#value_product").val();
                $.ajax({
                  url: "{{route('set-32gb')}}",
                  type: "get",
                  dataType: "text",
                  data: {
                    value_product: value_product,
                    rom32gb: rom
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);
                  }
                });
              });
              $("#btn_32_hide").click(function() {
                $(this).hide();
                $(document).scrollTop(600);
                console.log("Bỏ tích")

                var value_product = $("#value_product").val();
                //Hiển thị tất cả sẩn phẩm của apple
                $.ajax({
                  url: "{{route('get-apple')}}",
                  type: 'get',
                  dataType: "text",
                  data: {
                    value_product: value_product
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);
                  }
                });
              });

              $("#btn_64_hide").hide();
              $("#btn_64").click(function() {
                $(this).hide();
                $(document).scrollTop(600);
                $("#btn_64_hide").show();
                $('#btn_64_hide').addClass("active gb");

                $("#btn_32_hide").hide();
                $("#btn_32").show();
                $("#btn_128_hide").hide();
                $("#btn_128").show();
                $("#btn_256_hide").hide();
                $("#btn_256").show();
                const rom = new URLSearchParams(window.location.search)
                  .get('filter');
                console.log(rom);
                var value_product = $("#value_product").val();
                $.ajax({
                  url: "{{route('set-64gb')}}",
                  type: "get",
                  dataType: "text",
                  data: {
                    value_product: value_product,
                    rom64gb: rom
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);

                  }
                });
              });
              $("#btn_64_hide").click(function() {
                $(this).hide();
                $(document).scrollTop(600);
                console.log("Bỏ tích")

                var value_product = $("#value_product").val();
                //Hiển thị tất cả sẩn phẩm của apple
                $.ajax({
                  url: "{{route('get-apple')}}",
                  type: 'get',
                  dataType: "text",
                  data: {
                    value_product: value_product
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);
                  }
                });
              });

              $("#btn_128_hide").hide();
              $("#btn_128").click(function() {
                $(this).hide();
                $(document).scrollTop(600);
                $("#btn_128_hide").show();
                $('#btn_128_hide').addClass("active gb");

                $("#btn_64_hide").hide();
                $("#btn_64").show();
                $("#btn_32_hide").hide();
                $("#btn_32").show();
                $("#btn_256_hide").hide();
                $("#btn_256").show();
                const rom = new URLSearchParams(window.location.search)
                  .get('filter');
                console.log(rom);
                var value_product = $("#value_product").val();
                $.ajax({
                  url: "{{route('set-128gb')}}",
                  type: "get",
                  dataType: "text",
                  data: {
                    value_product: value_product,
                    rom128gb: rom
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);
                  }
                });
              });
              $("#btn_128_hide").click(function() {
                $(this).hide();
                $(document).scrollTop(600);
                console.log("Bỏ tích")

                var value_product = $("#value_product").val();
                //Hiển thị tất cả sẩn phẩm của apple
                $.ajax({
                  url: "{{route('get-apple')}}",
                  type: 'get',
                  dataType: "text",
                  data: {
                    value_product: value_product
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);
                  }
                });
              });

              $("#btn_256_hide").hide();
              $("#btn_256").click(function() {
                $(this).hide();
                $(document).scrollTop(600);
                $("#btn_256_hide").show();
                $('#btn_256_hide').addClass("active gb");

                $("#btn_64_hide").hide();
                $("#btn_64").show();
                $("#btn_128_hide").hide();
                $("#btn_128").show();
                $("#btn_32_hide").hide();
                $("#btn_32").show();
                const rom = new URLSearchParams(window.location.search)
                  .get('filter');
                console.log(rom);
                var value_product = $("#value_product").val();
                $.ajax({
                  url: "{{route('set-256gb')}}",
                  type: "get",
                  dataType: "text",
                  data: {
                    value_product: value_product,
                    rom256gb: rom
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);
                  }
                });
              });
              $("#btn_256_hide").click(function() {
                $(this).hide();
                $(document).scrollTop(600);
                console.log("Bỏ tích")

                var value_product = $("#value_product").val();
                //Hiển thị tất cả sẩn phẩm của apple
                $.ajax({
                  url: "{{route('get-apple')}}",
                  type: 'get',
                  dataType: "text",
                  data: {
                    value_product: value_product
                  },
                  success: function(result) {
                    $("#show_result_filter").html(result);
                  }
                });
              });
            });
            </script>
            <!-- categories filter end -->
            <!-- categories filter start -->
            <div class="single-sidebar mb-45">
              <div class="sidebar-inner-title mb-25">
                <h3>Màu</h3>
              </div>
              <div class="sidebar-content-box">
                <div class="filter-attribute-container">
                  <ul>
                    <li><a id="btn_white" style="cursor: pointer;">Trắng</a>
                    </li>
                    <li><a id="btn_white_hide"
                        style="cursor: pointer;">Trắng</a></li>
                    <li><a id="btn_green" style="cursor: pointer;">Xanh</a></li>
                    <li><a id="btn_green_hide" style="cursor: pointer;">Xanh</a>
                    </li>
                    <li><a id="btn_black" style="cursor: pointer;">Đen</a></li>
                    <li><a id="btn_black_hide" style="cursor: pointer;">Đen</a>
                    </li>
                    <li><a id="btn_violet" style="cursor: pointer;">Tím</a></li>
                    <li><a id="btn_violet_hide" style="cursor: pointer;">Tím</a>
                    </li>
                    <li><a id="btn_silver" style="cursor: pointer;">Bạc</a></li>
                    <li><a id="btn_silver_hide" style="cursor: pointer;">Bạc</a>
                    </li>
                    <li><a id="btn_gray" style="cursor: pointer;">Xám</a></li>
                    <li><a id="btn_gray_hide" style="cursor: pointer;">Xám</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <script>
          $(document).ready(function() {
            $("#btn_white_hide").hide();
            $("#btn_white").click(function() {
              $("#btn_white_hide").show();
              $("#btn_white_hide").addClass("active");
              var color = $(this).text();
              $(this).hide();
              var urlPage = window.location.pathname;
              var new_url = urlPage + "?color=" + color;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              $("#btn_silver").show();
              $("#btn_green").show();
              $("#btn_black").show();
              $("#btn_gray").show();
              $("#btn_violet").show();

              $("#btn_silver_hide").hide();
              $("#btn_green_hide").hide();
              $("#btn_black_hide").hide();
              $("#btn_gray_hide").hide();
              $("#btn_violet_hide").hide();

              var value_product = $("#value_product").val();
              $.ajax({
                url: "{{route('set-white')}}",
                type: "get",
                dataType: "text",
                data: {
                  value_product: value_product,
                  white: color
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });
            $("#btn_white_hide").click(function() {
              $(this).hide();
              $("#btn_white").show();
              var urlPage = window.location.pathname;
              var new_url = urlPage;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              var value_product = $("#value_product").val();
              //Hiển thị tất cả sẩn phẩm của apple
              $.ajax({
                url: "{{route('get-apple')}}",
                type: 'get',
                dataType: "text",
                data: {
                  value_product: value_product
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });

            $("#btn_green_hide").hide();
            $("#btn_green").click(function() {
              $("#btn_green_hide").show();
              $("#btn_green_hide").addClass("active");
              var color = $(this).text();
              $(this).hide();
              var urlPage = window.location.pathname;
              var new_url = urlPage + "?color=" + color;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              $("#btn_silver").show();
              $("#btn_white").show();
              $("#btn_black").show();
              $("#btn_gray").show();
              $("#btn_violet").show();

              $("#btn_silver_hide").hide();
              $("#btn_white_hide").hide();
              $("#btn_black_hide").hide();
              $("#btn_gray_hide").hide();
              $("#btn_violet_hide").hide();

              var value_product = $("#value_product").val();
              $.ajax({
                url: "{{route('set-blue')}}",
                type: "get",
                dataType: "text",
                data: {
                  value_product: value_product,
                  blue: color
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });
            $("#btn_green_hide").click(function() {
              $(this).hide();
              $("#btn_green").show();
              var urlPage = window.location.pathname;
              var new_url = urlPage;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              var value_product = $("#value_product").val();
              //Hiển thị tất cả sẩn phẩm của apple
              $.ajax({
                url: "{{route('get-apple')}}",
                type: 'get',
                dataType: "text",
                data: {
                  value_product: value_product
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });

            $("#btn_black_hide").hide();
            $("#btn_black").click(function() {
              $("#btn_black_hide").show();
              $("#btn_black_hide").addClass("active");
              var color = $(this).text();
              $(this).hide();
              var urlPage = window.location.pathname;
              var new_url = urlPage + "?color=" + color;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              $("#btn_silver").show();
              $("#btn_green").show();
              $("#btn_white").show();
              $("#btn_gray").show();
              $("#btn_violet").show();

              $("#btn_silver_hide").hide();
              $("#btn_green_hide").hide();
              $("#btn_white_hide").hide();
              $("#btn_gray_hide").hide();
              $("#btn_violet_hide").hide();

              var value_product = $("#value_product").val();
              $.ajax({
                url: "{{route('set-black')}}",
                type: "get",
                dataType: "text",
                data: {
                  value_product: value_product,
                  black: color
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });
            $("#btn_black_hide").click(function() {
              $(this).hide();
              $("#btn_black").show();
              var urlPage = window.location.pathname;
              var new_url = urlPage;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              var value_product = $("#value_product").val();
              //Hiển thị tất cả sẩn phẩm của apple
              $.ajax({
                url: "{{route('get-apple')}}",
                type: 'get',
                dataType: "text",
                data: {
                  value_product: value_product
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });

            $("#btn_violet_hide").hide();
            $("#btn_violet").click(function() {
              $("#btn_violet_hide").show();
              $("#btn_violet_hide").addClass("active");
              var color = $(this).text();
              $(this).hide();
              var urlPage = window.location.pathname;
              var new_url = urlPage + "?color=" + color;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              $("#btn_silver").show();
              $("#btn_green").show();
              $("#btn_black").show();
              $("#btn_gray").show();
              $("#btn_white").show();

              $("#btn_silver_hide").hide();
              $("#btn_green_hide").hide();
              $("#btn_black_hide").hide();
              $("#btn_gray_hide").hide();
              $("#btn_white_hide").hide();

              var value_product = $("#value_product").val();
              $.ajax({
                url: "{{route('set-violet')}}",
                type: "get",
                dataType: "text",
                data: {
                  value_product: value_product,
                  violet: color
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });
            $("#btn_violet_hide").click(function() {
              $(this).hide();
              $("#btn_violet").show();
              var urlPage = window.location.pathname;
              var new_url = urlPage;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              var value_product = $("#value_product").val();
              $.ajax({
                url: "{{route('get-apple')}}",
                type: 'get',
                dataType: "text",
                data: {
                  value_product: value_product
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });

            $("#btn_silver_hide").hide();
            $("#btn_silver").click(function() {
              $("#btn_silver_hide").show();
              $("#btn_silver_hide").addClass("active");
              var color = $(this).text();
              $(this).hide();
              var urlPage = window.location.pathname;
              var new_url = urlPage + "?color=" + color;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              $("#btn_white").show();
              $("#btn_green").show();
              $("#btn_black").show();
              $("#btn_gray").show();
              $("#btn_violet").show();

              $("#btn_white_hide").hide();
              $("#btn_green_hide").hide();
              $("#btn_black_hide").hide();
              $("#btn_gray_hide").hide();
              $("#btn_violet_hide").hide();

              var value_product = $("#value_product").val();
              $.ajax({
                url: "{{route('set-silver')}}",
                type: "get",
                dataType: "text",
                data: {
                  value_product: value_product,
                  silver: color
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });
            $("#btn_silver_hide").click(function() {
              $(this).hide();
              $("#btn_silver").show();
              var urlPage = window.location.pathname;
              var new_url = urlPage;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              var value_product = $("#value_product").val();
              //Hiển thị tất cả sẩn phẩm của apple
              $.ajax({
                url: "{{route('get-apple')}}",
                type: 'get',
                dataType: "text",
                data: {
                  value_product: value_product
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });

            $("#btn_gray_hide").hide();
            $("#btn_gray").click(function() {
              $("#btn_gray_hide").show();
              $("#btn_gray_hide").addClass("active");
              var color = $(this).text();
              $(this).hide();
              var urlPage = window.location.pathname;
              var new_url = urlPage + "?color=" + color;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              $("#btn_silver").show();
              $("#btn_green").show();
              $("#btn_black").show();
              $("#btn_white").show();
              $("#btn_violet").show();

              $("#btn_silver_hide").hide();
              $("#btn_green_hide").hide();
              $("#btn_black_hide").hide();
              $("#btn_white_hide").hide();
              $("#btn_violet_hide").hide();

              var value_product = $("#value_product").val();
              $.ajax({
                url: "{{route('set-gray')}}",
                type: "get",
                dataType: "text",
                data: {
                  value_product: value_product,
                  gray: color
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });
            $("#btn_gray_hide").click(function() {
              $(this).hide();
              $("#btn_gray").show();
              var urlPage = window.location.pathname;
              var new_url = urlPage;
              window.history.pushState('data', '', new_url);
              $(document).scrollTop(600);

              var value_product = $("#value_product").val();
              //Hiển thị tất cả sẩn phẩm của apple
              $.ajax({
                url: "{{route('get-apple')}}",
                type: 'get',
                dataType: "text",
                data: {
                  value_product: value_product
                },
                success: function(result) {
                  $("#show_result_filter").html(result);
                }
              });
            });
          });
          </script>
          <!-- sidebar promote picture start -->
          <div class="single-sidebar mb-30">
            <div class="sidebar-thumb">
              <a href="#"><img style="margin-bottom: 10px;"
                  src="assets/img/banner/img-static-sidebar-change.jpg"
                  alt=""></a>
            </div>
          </div>
          <!-- sidebar promote picture end -->
        </div>
        <div class="col-lg-9 order-first order-lg-last">
          <div class="product-shop-main-wrapper mb-50">
            <div class="shop-baner-img mb-70">
              <a href="#"><img src="assets/img/banner/category-image-change.jpg"
                  alt=""></a>
            </div>
            <div class="shop-top-bar mb-30">
              <div class="row">
                <div class="col-md-6">
                  <div class="top-bar-left">
                    <div class="product-view-mode">
                      <a class="active" href="#"
                        data-target="column_3"><span>3-col</span></a>
                      <a href="#" data-target="grid"><span>4-col</span></a>
                      {{-- <a href="#" data-target="list"><span>list</span></a> --}}
                    </div>
                    <div class="product-page">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="top-bar-right">
                    <div class="per-page">
                    </div>
                    <div class="product-short">
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div id="show_result_filter"
              class="shop-product-wrap grid column_3 row">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- shop page main wrapper end -->
  <script>
  $(document).ready(function() {
    var value_product = $("#value_product").val();
    //Hiển thị tất cả sẩn phẩm của apple
    $.ajax({
      url: "{{route('get-apple')}}",
      type: 'get',
      dataType: "text",
      data: {
        value_product: value_product
      },
      success: function(result) {
        $("#show_result_filter").html(result);
      }
    });
  });
  </script>
  <!-- scroll to top -->
  <div class="scroll-top not-visible">
    <i class="fas fa-angle-up"></i>
  </div> <!-- /End Scroll to Top -->

  <!-- footer area start -->
  @include('layout.footer')
  <!-- footer area end -->

  <!-- all js include here -->
  <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/ajax-mail.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>