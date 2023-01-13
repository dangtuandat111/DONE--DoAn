@extends('server::base_layout')

@section('title', 'Customer page')

@section('more-css')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <img
                                        src="@if (isset($admin_data) && isset($admin_data->avatar)) {{ asset($admin_data->avatar) }} @else {{ asset('DoAnTotNghiep/server/assets/images/admin_default.png') }} @endif"
                                        alt="profile" class="img-lg rounded-circle mb-3">
                                    <div class="mb-3">
                                        <h3></h3>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted">{{ $admin_data->name }}</h5>
                                        </div>
                                    </div>
                                    <p class="w-75 mx-auto mb-3">
                                        @if (isset($admin_data) && isset($admin_data->role) && $admin_data->role == 1)
                                            Tài khoản có quyền admin
                                        @else
                                            Tài khoản có quyền nhân viên
                                        @endif
                                    </p>
                                </div>
                                <div class="py-4">
                                    <p class="clearfix">
                                        <span class="float-left">Tình trạng</span>
                                        <span class="float-right text-muted">Khả dụng</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Số điện thoại
                                        </span>
                                        <span class="float-right text-muted">{{ $admin_data->phone_number }}</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Địa chỉ email
                                        </span>
                                        <span class="float-right text-muted">{{ $admin_data->email }}</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Thời gian tạo
                                        </span>
                                        <span class="float-right text-muted">

                                            <span>{{ \Carbon\Carbon::parse($admin_data->created_at)->format('d-m-Y')}}</span>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Thời gian cập nhật
                                        </span>
                                        <span class="float-right text-muted">
                                            <span>{{ \Carbon\Carbon::parse($admin_data->updated_at)->format('d-m-Y')}}</span>
                                        </span>
                                    </p>
                                </div>
                                <button class="btn btn-primary btn-block mb-2 btn-change-avatar">Thay đổi avatar</button>
                                <div class="form-edit border d-none" id="change_avatar" style="padding: 20px;">
                                    <form method="post" class="form-sample" action="{{ route('server.profile.update.avatar') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="">
                                            <label>Tải lên ảnh đại diện</label>
                                            <div class="input-group col-xs-12">
                                                <input type="file" name="avatar_image" class="file-upload-default d-none">

                                                <input type="text" class="form-control file-upload-info" placeholder="Tải ảnh lên" name="avatar_image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Tải</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 px-0 col-12 mt-5">
                                            <button class="btn bg-primary text-white" type="submit">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="mt-4 py-2 border-top border-bottom" role="tablist">
                                    <ul class="nav nav-tabs profile-navbar">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="nav-history-tab" data-target="#nav-history">
                                                <i class="ti-user"></i>
                                                Lịch sử đăng nhập
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="nav-profile-tab" data-target="#nav-profile">
                                                <i class="ti-calendar"></i>
                                                Chỉnh sửa thông tin
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <div class="tab-pane fade show active" id="nav-history" >
                                        @foreach($user_history_data as $user_history_data_item)
                                            <div class="d-flex align-items-start profile-feed-item">
                                                <div class="ms-4">
                                                    <h6>
                                                        <small class="ms-4 text-muted">
                                                            <i class="ti-time me-1"></i> {{ date('d-m-Y', strtotime($user_history_data_item->ago)) }}
                                                        </small>
                                                    </h6>
                                                    <p>
                                                        <strong>{{ $admin_data->name }}</strong> đã đăng nhập
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="col-12 col-sm-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Profile</h4>
                                                    <p class="card-description">
                                                        Chỉnh sửa thông tin cá nhân
                                                    </p>
                                                    <form id="editProfileForm" class="forms-sample" method="post">
                                                        @csrf
                                                        <input type="hidden" class="form-control" id="user_id" value="{{ $admin_data->id }}">
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-3 col-form-label">Tên</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="name" placeholder="Tên" value="{{ $admin_data->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email" class="col-sm-3 col-form-label">Địa chỉ email</label>
                                                            <div class="col-sm-9">
                                                                <input type="email" class="form-control" id="email" placeholder="Địa chỉ email" value="{{ $admin_data->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="phone_number" class="col-sm-3 col-form-label">Số điện thoại</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="phone_number" placeholder="Số điện thoại" value="{{ $admin_data->phone_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="password" class="col-sm-3 col-form-label">Mật khẩu</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" class="form-control" id="password" placeholder="Mật khẩu">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="password_confirm" class="col-sm-3 col-form-label">Xác nhận mật khẩu</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" class="form-control" id="password_confirm" placeholder="Xác nhận mật khẩu">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- input hidden -->
    <input type="hidden" id="update_profile" value="{{ route('server.api.profile.update') }}">
@endsection


@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/profiler/profiler.js') }}"></script>
    <script src="{{ asset('DoAnTotNghiep/server/js/file-upload.js') }}"></script>

    <script>
        $(document).ready(function () {
            toastr.options.timeOut = 5000;
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
            @endif
            @if (Session::has('success'))
            toastr.success('{{session('success')}}');
            @endif
        });
    </script>
@endsection
