<?php

    if(Session::has('username')){
        $token = session('username');
    }else{
        $token = "guest";
    }

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/a076d05399.js"
    crossorigin="anonymous"></script>
  <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <!-- Page Title -->
  <title>Shop</title>
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

  <!-- Modernizer JS -->
  <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
  <input type="hidden" name="" id="userLogin" value="{{$token}}">
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
                <li class="breadcrumb-item"><a href="{{route('/')}}">Trang
                    chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
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
        <div class="col-lg-12">
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
                      <a href="#" data-target="column_3"><span>3-col</span></a>
                      <a class="active" href="#"
                        data-target="grid"><span>4-col</span></a>
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
            <div class="shop-product-wrap grid row">
              {{-- Hiển thị data từ database --}}
              @foreach ($shop as $item)
              <div class="col-lg-3 col-md-4 col-sm-6">
                <div style="height: 380px;" class="product-item mb-30">
                  <div class="product-thumb">
                    <a href="product-details?pid={{$item->id}}">
                      <img style="width: 200px; height: 200px;"
                        src="product_images/{{$item->photo_name}}"
                        class="pri-img" alt="">
                    </a>
                    <div class="box-label">
                      @if ($item->active == 1)
                      <div class="label-product label_sale">
                        <span>
                          @if ($item->remove_date == NULL)
                          -{{$item->discount_percent}}%
                          @else

                          @endif
                        </span>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="product-caption">
                    <div class="manufacture-product">
                      <p><a href="#">{{$item->manufacturer}}</a></p>
                    </div>
                    <div class="product-name">
                      <h4><a
                          href="product-details?pid={{$item->id}}">{{$item->name}}</a>
                      </h4>
                    </div>
                    <div id="show_star_{{$item->id}}" class="ratings">
                    </div>
                    <input type="hidden" name="" id="pid_{{$item->id}}"
                      value="{{$item->id}}">
                    <script>
                    $(document).ready(function() {
                      var pid = $("#pid_{{$item->id}}").val();
                      $.ajax({
                        url: "{{route('show-average-star')}}",
                        type: "get",
                        dataType: "text",
                        data: {
                          pid: pid
                        },
                        success: function(result) {
                          $("#show_star_{{$item->id}}").html(result);
                        }
                      });
                    });
                    </script>
                    <div class="price-box">
                      <span class="regular-price"><span class="special-price">
                          @if ($item->active == 1)
                          {{number_format(($item->price*(100-$item->discount_percent))/100)}}đ
                          @endif

                          @if ($item->active == 0 || $item->active == 2)
                          {{number_format($item->price)}} đ
                          @endif
                        </span></span>
                      <span class="old-price">
                        <del>
                          @if ($item->active==1)
                          {{number_format($item->price)}} đ
                          @endif
                        </del>
                      </span>
                    </div>
                  </div>
                </div> <!-- end single grid item -->
              </div>
              @endforeach
            </div>
            <div class="paginatoin-area style-2 pt-35 pb-20">
              <div class="row">
                <div class="col-sm-6">
                  <ul class="" style="float: right;">
                    <li>{!! $shop->links() !!}</li>
                  </ul>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- shop page main wrapper end -->

  <!-- scroll to top -->
  <div class="scroll-top not-visible">
    <i class="fas fa-angle-up"></i>
  </div> <!-- /End Scroll to Top -->

  <!-- footer area start -->
  @include('layout.footer')
  <!-- footer area end -->

  <!-- all js include here -->

  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/ajax-mail.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>