<!doctype html>
<html lang="en">
<head>
    <title>Damskin - @yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,900" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('DoAnTotNghiep/client/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('DoAnTotNghiep/client/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('DoAnTotNghiep/client/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('DoAnTotNghiep/client/css/owl-carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('DoAnTotNghiep/client/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('DoAnTotNghiep/client/css/jquery-ui.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="shortcut icon" href="{{ asset('logo-2.png') }}"/>
    @yield('more-css')
<!-- Custom styles for this template -->
</head>

<body>

<header class="header-area header-sticky text-center header-default">
    <div class="header-main-sticky">
        <div class="header-main-head">
            <div class="header-main">
                <div class="container">
                    <div class="header-middle float-left">
                        <div class="logo">
                            <a href="{{ route('client.home.get') }}"><img src="{{ asset('logo-3.png') }}" alt="Dumpskin" style="width: 60px; height: 60px"></a></div>
                    </div>
                    <div class="header-right d-flex d-xs-block d-sm-flex justify-content-end float-right">
                        <div class="user-info">
                            <button type="button" class="btn">
                                <i class="material-icons">perm_identity</i>
                            </button>
                            <div id="user-dropdown" class="user-menu">
                                <ul>
                                    @if (\Auth::guard('customer')->check())
                                        <li><a href="{{ route('client.profile') }}" class="text-capitalize">Thông tin tài khoản</a></li>
                                        <li><a class="text-capitalize btn-logout">Đăng xuất</a></li>
                                    @else
                                    <li><a href="#" class="modal-view button" data-toggle="modal"
                                           data-target="#modalRegisterForm">Đăng kí</a></li>
                                    <li><a href="#" class="modal-view button" data-toggle="modal"
                                           data-target="#modalLoginForm">Đăng nhập</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        @if (\Auth::guard('customer')->check())
                        <div class="cart-wrapper">
                            <button type="button" class="btn">
                                <i class="material-icons">shopping_cart</i>
                                <span class="ttcount">i</span>
                            </button>
                            <div id="cart-dropdown" class="cart-menu">
                                <ul class="w-100 float-left">
                                    <li class="buttons w-100 float-left">
                                        <a href="{{ route("client.cart") }}" alt="" class="btn pull-left mt_10 btn-primary btn-rounded w-100">Xem giỏ hàng</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="menu">
                <div class="container">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light d-sm-none d-xs-none d-lg-block">
                        <!-- Collapse button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent2"
                                aria-controls="navbarSupportedContent2" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Collapsible content -->
                        <div class="collapse navbar-collapse">
                            <!-- Links -->
                            <ul class="navbar-nav m-auto justify-content-center">
                                <!-- Features -->
                                <li class="nav-item dropdown active">
                                    <a class="nav-link text-uppercase" href="{{ route('client.home.get') }}">
                                        Trang chủ
                                    </a>
                                </li>
                                @if (\Auth::guard('customer')->check())
                                    <li class="nav-item dropdown">
                                        <a class="nav-link text-uppercase btn-logout">Đăng xuất</a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link text-uppercase" data-toggle="modal"
                                           data-target="#modalRegisterForm">Đăng kí</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link text-uppercase" data-toggle="modal"
                                           data-target="#modalLoginForm">Đăng nhập</a>
                                    </li>
                                @endif
                                @if (\Auth::guard('customer')->check())
                                    <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase">Cá nhân</a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3">
                                        <div class="sub-menu">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a class="menu-item pl-0" href="{{ route('client.profile') }}">
                                                        Trang cá nhân</a>
                                                    </li>
                                                <li>
                                                    <a class="menu-item pl-0" href="{{ route('client.cart') }}">
                                                        Giỏ hàng</a>
                                                    </li>
                                                <li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            <!-- Links -->
                        </div>
                        <!-- Collapsible content -->
                    </nav>
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light d-lg-none navbar-responsive">
                        <!-- Collapse button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent2"
                                aria-controls="navbarSupportedContent2" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class='material-icons'>sort</i></span>
                        </button>
                        <!-- Collapsible content -->

                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

@yield('content')

<!-- Footer -->
<div class="block-newsletter">
    <div class="parallax" data-source-url="{{ asset('DoAnTotNghiep/client/img/banner/banner_prod.jpg') }}"
         style="background-image:url({{ asset('DoAnTotNghiep/client/img/banner/banner_prod.jpg') }}); background-position:50% 65.8718%;">
        <div class="container d-flex">
            <div class="col-sm-7">
                <h2 class="text-uppercase text-white">SẢN PHẨM TỪ DAMSKIN</h2>
            </div>
            <div class="block-content col-sm-5">
                <form method="post" action="#">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-theme text-uppercase btn-primary" disabled>Mua ngay thôi</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="page-footer font-small footer-default">
    <div class="container text-center text-md-left">
        <div class="row">
            <div class="col-md-2 footer-cms footer-column">
                <div class="ttcmsfooter">
                    <div class="footer-logo"><img src="{{ asset('logo-3.png') }}" alt="footer-logo"></div>
                    <div class="footer-desc text-center"> DAMSKIN
                    </div>
                </div>
            </div>
            <div class="col-md-2 footer-column">
                <div class="title">
                    <a href="#company" class="font-weight-normal text-capitalize mb-10" data-toggle="collapse"
                       aria-expanded="false">Cửa hàng</a></div>
                <ul id="company" class="list-unstyled collapse">
                    <li>
                        <a href="{{ route('client.home.get') }}">Tìm kiếm</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 footer-column">
                <div class="title">
                    <a href="#products" class="font-weight-normal text-capitalize mb-10" data-toggle="collapse"
                       aria-expanded="false">Loại giày</a></div>
                <ul id="products" class="list-unstyled collapse" style="color: #aaaaaa;">
                    @foreach($category_data as $category_data_item)
                        <li class="mb-2">{{ $category_data_item->name }}</li>
                    @endforeach
                </ul>

            </div>
            <div class="col-md-2 footer-column">
                <div class="title">
                    <a href="#account" class="font-weight-normal text-capitalize mb-10" data-toggle="collapse"
                       aria-expanded="false">Cá nhân</a></div>
                <ul id="account" class="list-unstyled collapse">
                    <li>
                        <a href="{{ route('client.profile') }}">Trang cá nhân</a></li>
                    <li>
                        <a href="{{ route('client.cart') }}">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom-wrap">
        <div class="container">
            <div class="row">
                <div class="footer-copyright text-center py-3">
                    © 2022 - MAKE BY ME
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="goToTop" title="Back to top" class="btn-primary"><i class="material-icons arrow-up">keyboard_arrow_up</i></a>
</footer>
<!-- Footer -->


<!-- Register modal -->
<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-medium text-left">Đăng kí</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-4">
                    <input type="text" id="RegisterForm-name" class="form-control validate" placeholder="Nhập tên người dùng ">
                </div>
                <div class="md-form mb-4">
                    <input type="email" id="RegisterForm-email" class="form-control validate" placeholder="Nhập địa chỉ email">
                </div>
                <div class="md-form mb-4">
                    <input type="password" id="RegisterForm-pass" class="form-control validate"
                           placeholder="Nhập mật khẩu">
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary btn-sign-up">Đăng kí</button>
            </div>
        </div>
    </div>
</div>

<!-- Login modal -->
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-medium text-left">Đăng nhập</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-4">
                    <input type="email" id="LoginForm-name" class="form-control validate" placeholder="Nhập địa chỉ email">
                </div>
                <div class="md-form mb-4">
                    <input type="password" id="LoginForm-pass" class="form-control validate"
                           placeholder="Nhập mật khẩu">
                </div>
                <div class="checkbox-link d-flex justify-content-between">
                    <div class="left-col">
                        <input type="checkbox" id="remember_me"><label for="remember_me">Lưu đăng nhập</label>
                    </div>
{{--                    <div class="right-col"><a href="#">Forget Password?</a></div>--}}
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary btn-sign-in">Đăng nhập</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="login_post" value="{{ route('client.login') }}">
<input type="hidden" id="signup_post" value="{{ route('client.signup') }}">
<input type="hidden" id="logout_post" value="{{ route('client.logout') }}">

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('DoAnTotNghiep/client/js/jquery.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/custom.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/parallax.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/ResizeSensor.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/theia-sticky-sidebar.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/js/jquery.zoom.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{ asset('DoAnTotNghiep/client/assets/js/login.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/client/assets/js/signup.js') }}"></script>
@yield('more-js')

</body>
</html>




