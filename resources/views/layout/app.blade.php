
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield("title")</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{url("assets/img/favicon.ico")}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{url("assets/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/flaticon.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/slicknav.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/animate.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/fontawesome-all.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/themify-icons.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/slick.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/nice-select.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/style.css")}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
</head>

<body>
<!--? Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="{{url("logo.png")}}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->
<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="menu-wrapper">
                    <!-- Logo -->
                    <div class="logo">
                        <img src="{{url("logo.png")}}" class="img-fluid" style="height: 60px" alt="">
                    </div>
                    <!-- Main-menu -->
                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li><a href="/">Beranda</a></li>
                                <li><a href="/product">Produk Kami</a></li>
                                <li><a href="/about">Tentang Tukang Ikan</a></li>
                                <li><a href="/contact">Hubungi Kami</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Right -->
                    <div class="header-right">
                        <ul>
                            <li> <a href="{{route("login")}}"><span class="flaticon-user"></span></a></li>
                            <li><a href="{{route("store.cart")}}"><span class="flaticon-shopping-cart"></span></a> </li>
                        </ul>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<main>
   @yield("content")
</main>
<!-- Search model end -->

<!-- JS here -->

<script src="{{url("assets/js/vendor/modernizr-3.5.0.min.js")}}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{url("assets/js/vendor/jquery-1.12.4.min.js")}}"></script>
<script src="{{url("assets/js/popper.min.js")}}"></script>
<script src="{{url("assets/js/bootstrap.min.js")}}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{url("assets/js/jquery.slicknav.min.js")}}"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{url("assets/js/owl.carousel.min.js")}}"></script>
<script src="{{url("assets/js/slick.min.js")}}"></script>

<!-- One Page, Animated-HeadLin -->
<script src="{{url("assets/js/wow.min.js")}}"></script>
<script src="{{url("assets/js/animated.headline.js")}}"></script>
<script src="{{url("assets/js/jquery.magnific-popup.js")}}"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="{{url("assets/js/jquery.scrollUp.min.js")}}"></script>
<script src="{{url("assets/js/jquery.nice-select.min.js")}}"></script>
<script src="{{url("assets/js/jquery.sticky.js")}}"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="{{url("assets/js/plugins.js")}}"></script>
<script src="{{url("assets/js/main.js")}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@yield("js")
@include("msg")
</body>
</html>
