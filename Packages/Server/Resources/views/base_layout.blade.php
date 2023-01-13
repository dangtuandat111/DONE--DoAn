<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DAMSKIN - @yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('more-plugin-css')
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/ti-icons/css/themify-icons.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/css/modal/modal.css') }}">
    @yield('more-css');
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('logo-2.png') }}" />
</head>
<body>
<div class="container-scroller @yield('bodyclass')" >
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="#">
                <img src="{{ asset('logo-2.png') }}" class="mr-2" alt="logo"/>
                <div class="page-dumpskin">DAMSKIN</div>
            </a>
            <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('logo-2.png') }}" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="@if (isset($admin_data) && isset($admin_data->avatar) && $admin_data->avatar) {{ asset($admin_data->avatar) }} @else {{ asset('DoAnTotNghiep/server/assets/images/admin_default.png') }} @endif" alt="profile"/>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('server.profile.get') }}">
                            <i class="ti-settings text-primary"></i>
                            Thông tin tài khoản
                        </a>
                        <a class="dropdown-item" href="{{ route('server.logout.get') }}">
                            <i class="ti-power-off text-primary"></i>
                            Đăng xuất
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('server.home.get') }}">
                        <i class="icon-grid menu-icon side-bar-icon"></i>
                        <span class="menu-title" id="Home">Trang chủ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                        <i class="icon-marquee-minus menu-icon side-bar-icon"></i>
                        <span class="menu-title" id="Product">Trang sản phẩm</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('server.product.get') }}">Danh sách sản phẩm</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('server.property.get') }}">Danh sách thuộc tính</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('server.option.get') }}">Danh sách tùy chọn</a></li>
{{--                            <li class="nav-item"><a class="nav-link" href="#">Sales</a></li>--}}
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="icon-layout menu-icon side-bar-icon"></i>
                        <span class="menu-title" id="Account">Tài khoản</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('server.profile.get') }}">Trang cá nhân</a></li>
                            @if ($admin_data->role == 1)
                            <li class="nav-item"> <a class="nav-link" href="{{ route('server.account.get') }}">Danh sách tài khoản</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
                        <i class="icon-layout menu-icon side-bar-icon"></i>
                        <span class="menu-title" id="Order">Đơn hàng</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="editors">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route("server.order.get") }}">Danh sách đơn hàng</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-customer" aria-expanded="false" aria-controls="ui-customer">
                        <i class="icon-layout menu-icon side-bar-icon"></i>
                        <span class="menu-title" id="Customer">Khách hàng</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-customer">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('server.customer.get') }}">Danh sách người dùng</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('server.brand.get') }}">
                        <i class="icon-paper menu-icon side-bar-icon"></i>
                        <span class="menu-title" id="Brand">Nhãn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('server.category.get') }}">
                        <i class="icon-paper menu-icon side-bar-icon"></i>
                        <span class="menu-title" id="Category">Loại giày</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('server.statistic.get') }}">
                        <i class="icon-bar-graph menu-icon"></i>
                        <span class="menu-title" id="Statistic">Thống kê</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            @yield('content')
            <!-- content-wrapper ends -->

            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Tạo bởi DTD<a href="#" target="_blank">mrboss862000@gmail.com</a></span>
                </div>
            </footer>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ asset('DoAnTotNghiep/server/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('DoAnTotNghiep/server/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/dataTables.select.min.js') }}"></script>
@yield('more-plugin-js')
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('DoAnTotNghiep/server/js/off-canvas.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/template.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/settings.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('DoAnTotNghiep/server/js/dashboard.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/tablesort.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/Chart.roundedBarCharts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@yield('more-js')

<script>
    $(document).ready(function() {
        let selectedNavItem = @if (isset($selectedNavItem)) '{{$selectedNavItem}}' @else 'Home' @endif;
        $(document).find('.nav-item').removeClass('active');
        if (selectedNavItem !== 'Customer')  {
            $('#ui-customer').removeClass('show');
        }
        if (selectedNavItem !== 'Account')  {
            $('#ui-basic').removeClass('show');
        }
        if (selectedNavItem !== 'Product')  {
            $('#form-elements').removeClass('show');
        }
        if (selectedNavItem !== 'Order')  {
            $('#editors').removeClass('show');
        }

        selectedNavItem = $('#' + selectedNavItem);
        $(selectedNavItem).closest('.nav-item').addClass('active');
        $(selectedNavItem).closest('.nav-link').attr('aria-expanded', true);
        $('#' + $(selectedNavItem).closest('.nav-link').attr('aria-controls')).closest('.collapse').addClass('show');
    });

</script>
</script>
<!-- End custom js for this page-->
</body>

</html>

