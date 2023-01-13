<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dumpskin - Login page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/css/auth/login.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('logo-2.png') }}" />
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo mb-0">
                            <img src="{{ asset('logo-2.png') }}" alt="logo">
                        </div>
                        <h4>Xin chào, Hãy bắt đầu bằng việc đăng kí tài khoản mới</h4>
                        <h6 class="font-weight-light">Đăng kí để tiếp tục nào.</h6>
                        <form id="signupForm" class="pt-3" action="{{ route('server.signup.post') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" required class="form-control form-control-lg rounded" id="email"  name="email" placeholder="Địa chỉ email" value="{{ old('email') }}" oninvalid="this.setCustomValidity('Lỗi: địa chỉ email không hợp lệ.')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <input type="password"  class="form-control form-control-lg rounded" id="password" name="password" placeholder="Mật khẩu" value="{{ old('password') }}" required oninvalid="this.setCustomValidity('Lỗi: mật khẩu không hợp lệ.')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <input type="text" required class="form-control form-control-lg rounded" id="user_name" name="user_name" placeholder="Tên người dùng" value="{{ old('user_name') }}" oninvalid="this.setCustomValidity('Lỗi: tên người dùng không hợp lệ.')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mt-3">
                                <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="SIGN UP">
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                Đã có tài khoản <a href="{{ route('server.login.get') }}" class="text-primary">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('DoAnTotNghiep/server/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('DoAnTotNghiep/server/js/off-canvas.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/template.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/settings.js') }}"></script>
<script src="{{ asset('DoAnTotNghiep/server/js/todolist.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 5000;
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    });

</script>
<!-- endinject -->
</body>

</html>
