@extends('client::layouts.master')

@section('title', 'Home page')

@section('more-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/client/assets/css/profile.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
@endsection

@section('content')
    <!-- content-wrapper ends -->
    <div class="main-content w-100 float-left">
        <div class="container">
            <div class="row">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                         aria-orientation="vertical">
                        <div class="col-12">
                            <img class="pb-2" src="{{ ($customer_data->avatar != '' && $customer_data->avatar != 'admin_default.png') ? asset('DoAnTotNghiep/client/assets/images/' . $customer_data->avatar) : asset('DoAnTotNghiep/server/assets/images/admin_default.png') }}">
                        </div>
                        <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-profile" type="button" role="tab"
                                aria-controls="v-pills-profile" aria-selected="false">Thông tin chung
                        </button>
                        <button class="nav-link" id="v-pills-edit-avatar-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-edit-avatar" type="button" role="tab"
                                aria-controls="v-pills-edit-avatar" aria-selected="false">Thay đổi ảnh đại diện
                        </button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-settings" type="button" role="tab"
                                aria-controls="v-pills-settings" aria-selected="false">Thay đổi mật khẩu
                        </button>
                        <button class="nav-link d-none" id="v-pills-edit-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-edit-profile" type="button" role="tab"
                                aria-controls="v-pills-edit-profile" aria-selected="false">
                        </button>
                    </div>
                    <div class="tab-content col-10" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                             aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tên người dùng</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $customer_data->name }}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Địa chỉ email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $customer_data->email }}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Số điện thoại</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $customer_data->phone_number }}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Mô tả</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {!! $customer_data->description !!}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Giới tính</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $customer_data->gender == 0 ? 'Nam' : ($customer_data->gender == 1 ? 'Nữ' : '') }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Đăng kí địa chỉ</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $customer_data->address }}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a id="v-pills-edit-profile-tab" class="btn bg-primary text-white" onclick="$('#v-pills-edit-profile-tab').trigger('click');">Chỉnh sửa thông tin chung</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                             aria-labelledby="v-pills-edit-profile-tab" tabindex="0">
                            <div class="form-edit border step-1" style="padding: 20px;">
                                <div class="mb-2">
                                    <label>Mật khẩu hiện tại</label>
                                    <input type="password" id="customer_password" class="form-control validate" placeholder="Nhập mật khẩu hiện tại">
                                </div>
                                <div class="mb-2">
                                    <label>Mật khẩu mới</label>
                                    <input type="password" id="customer_new_password" class="form-control validate" placeholder="Nhập mật khẩu mới">
                                </div>
                                <div class="mb-2">
                                    <label>Xác nhận mật khẩu mới</label>
                                    <input type="password" id="customer_password_confirm" class="form-control validate" placeholder="Xác nhận mật khẩu mới">
                                </div>
                                <div class="col-sm-12 px-0">
                                    <a id="send-mail" class="btn bg-primary text-white">Gửi mail xác nhận</a>
                                </div>
                            </div>
                            <div class="form-edit border step-2 d-none" style="padding: 20px;">
                                <div class="mb-2">
                                    <label>Nhập mã xác nhận</label>
                                    <input type="text" id="customer_otp" class="form-control validate" placeholder="Nhập mã xác nhận">
                                </div>
                                <div class="col-sm-12 px-0">
                                    <a id="send-update-pass" class="btn bg-primary text-white">Xác nhận</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-edit-profile" role="tabpanel"
                             aria-labelledby="v-pills-edit-profile-tab" tabindex="0">
                            <div class="form-edit border" style="padding: 20px;">
                                <div class="mb-2">
                                    <label>Tên người dùng (*)</label>
                                    <input type="text" id="customer_name" class="form-control validate" placeholder="Nhập tên người dùng" value="{{ $customer_data->name }}">
                                </div>
                                <div class="mb-2">
                                    <label>Số điện thoại</label>
                                    <input type="text" id="customer_phone_number" class="form-control validate" placeholder="Nhập số điện thoại" maxlength="11" value="{{ $customer_data->phone_number }}">
                                </div>
                                <div class="mb-2">
                                    <label>Địa chỉ email</label>
                                    <input type="text" id="customer_email" class="form-control validate" placeholder="Nhập địa chỉ email" maxlength="11" value="{{ $customer_data->email }}">
                                </div>
                                <div class="mb-2">
                                    <label>Mô tả</label>
                                    <textarea class="wysiwyg" id="customer_description" name="customer_description">{!! $customer_data->description !!}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label>Giới tính</label>
                                    <select id="customer_gender" class="form-control">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                        <option value="-1">Bỏ qua</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Địa chỉ</label>
                                    <input type="text" id="customer_address" class="form-control validate" placeholder="Nhập địa chỉ" value="{{ $customer_data->address }}">
                                </div>
                                <div class="col-sm-12 px-0">
                                    <a id="edit-profile" class="btn bg-primary text-white">Cập nhật</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-edit-avatar" role="tabpanel"
                             aria-labelledby="v-pills-edit-avatar-tab" tabindex="0">
                            <div class="form-edit border" style="padding: 20px;">
                                <form method="post" class="form-sample" action="{{ route('client.profile.update.avatar') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class>
                                        <label>Tải lên ảnh đại diện</label>
                                        <input type="file" class="form-control" name="avatar_image" />
                                    </div>
                                    <div class="col-sm-12 px-0 col-12 mt-5">
                                        <button class="btn bg-primary text-white" type="submit">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- input hidden -->
    <input type="hidden" id="profile_update" value="{{ route('client.profile.update') }}">
    <input type="hidden" id="base_mail" value="{{ $customer_data->email }}">
    <input type="hidden" id="profile_send_mail_password" value="{{ route('client.profile.update.mail') }}">
    <input type="hidden" id="profile_update_pass" value="{{ route('client.profile.update.pass') }}">
    <input type="hidden" id="profile_update_avatar" value="{{ route('client.profile.update.avatar') }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/client/assets/js/profile.js') }}"></script>
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
