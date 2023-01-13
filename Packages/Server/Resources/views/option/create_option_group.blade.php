@extends('server::base_layout')

@section('title', 'Create option group page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm mới tùy chọn</h4>
                        <div class="forms-sample" data-route="{{ route('server.api.option.group.create') }}">
                            <div class="form-group">
                                <label for="optionGroupName">Tên nhóm tùy chọn </label>
                                <input type="text" class="form-control" id="optionGroupName" name="optionGroupName" placeholder="Tên nhóm tùy chọn" required oninvalid="this.setCustomValidity('Lỗi: Tên nhóm tùy chọn không hợp lệ.')">
                            </div>
                            <div class="form-group">
                                <label for="optionGroupStatus">Tình trạng nhóm tùy chọn</label>
                                <select name="optionGroupStatus" id="optionGroupStatus" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="0">Khả dụng</option>
                                    <option value="1" selected>Không khả dụng</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit mr-2">Cập nhật</button>
                            <a class="btn btn-light button-cancel" href="{{ route('server.option.get') }}"><span>Hủy bỏ</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/option/create_option_group.js') }}"></script>
@endsection
