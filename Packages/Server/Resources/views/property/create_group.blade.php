@extends('server::base_layout')

@section('title', 'Create property group page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm thuộc tính mới</h4>
                        <div class="forms-sample" data-route="{{ route('server.api.property.group.create') }}">
                            <div class="form-group">
                                <label for="propertyName">Tên thuộc tính</label>
                                <input type="text" class="form-control" id="propertyName" name="propertyName" placeholder="Tên thuộc tính" required oninvalid="this.setCustomValidity('Lỗi: Tên thuộc tính không hợp lệ')">
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit mr-2">Cập nhật</button>
                            <a class="btn btn-light button-cancel" href="{{ route('server.property.get') }}"><span>Hủy bỏ</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/property/create_property_group.js') }}"></script>
@endsection
