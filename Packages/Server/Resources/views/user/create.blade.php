@extends('server::base_layout')

@section('title', 'Create brand page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm mới tài khoản</h4>
                        <form class="forms-sample" method="post" action="{{ route('server.account.create.post') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên tài khoản</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên tài khoản" required oninvalid="this.setCustomValidity('Lỗi: tên tài khoản không hợp lệ.')">
                            </div>
                            <div class="form-group">
                                <label for="name">Địa chỉ email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Địa chỉ email" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Mật khẩu</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Tình trạng</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="0">Khả dụng</option>
                                    <option value="1">Không khả dụng</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role" name="role" class="form-control">
                                    <option value="0">Nhân viên</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                            <a class="btn btn-light" href="{{ route('server.account.get') }}">Hủy bỏ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/user/user.js') }}"></script>
    <script src="{{ asset('DoAnTotNghiep/server/js/file-upload.js') }}"></script>

    "></script>
@endsection
