<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dumpskin - Login page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <h4>Hello! let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <form class="pt-3" action="{{ route('server.login.post') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-group">
                                <input type="email" required class="form-control form-control-lg rounded" id="email"  name="email" placeholder="Username" value="{{ old('email') }}" oninvalid="this.setCustomValidity('Messsage Error: Please enter valid email')" oninput="this.setCustomValidity('')">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        @if (str_contains($error, 'email'))
                                            <div class="alert alert-danger alert-dismissible mt-3" role="alert">
                                                <ul class="mb-0">
                                                    <li>{{ $error }}</li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" required class="form-control form-control-lg rounded" id="password" name="password" placeholder="Password" value="{{ old('email') }}" oninvalid="this.setCustomValidity('Messsage Error: Please enter valid password')" oninput="this.setCustomValidity('')" maxlength="8" size="8">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        @if (str_contains($error, 'password'))
                                            <div class="alert alert-danger alert-dismissible mt-3"  role="alert">
                                                <ul class="mb-0">
                                                    <li>{{ $error }}</li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-3">
                                <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="SIGN IN">
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label texts-muted">
                                        <input type="checkbox" class="form-check-input" name="remember">
                                        Keep me signed in
                                    </label>
                                </div>
{{--                                <a href="#" class="auth-link text-black">Forgot password?</a>--}}
                            </div>
{{--                            <div class="mb-2">--}}
{{--                                <button type="button" class="btn btn-block btn-facebook auth-form-btn">--}}
{{--                                    <i class="ti-facebook mr-2"></i>Connect using facebook--}}
{{--                                </button>--}}
{{--                            </div>--}}
                            <div class="text-center mt-4 font-weight-light">
                                Don't have an account? <a href="{{ route('server.signup.get') }}" class="text-primary">Create</a>
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
