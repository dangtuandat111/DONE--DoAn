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
                        <div class="forms-sample" data-route="{{ route('server.api.property.create') }}">
                            <div class="form-group">
                                <label for="propertyName">Tên thuộc tính</label>
                                <input type="text" class="form-control" id="propertyName" name="propertyName" placeholder="Tên thuộc tính" required oninvalid="this.setCustomValidity('Lỗi: Tên thuộc tính không hợp lệ.')">
                            </div>
                            <div class="form-group">
                                <label for="propertyGroupSelect">Nhóm thuộc tính</label>
                                <select name="propertyGroupSelect" id="propertyGroupSelect" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="-1" selected disabled hidden>Chọn nhóm thuộc tính</option>
                                    @foreach($property_group as $property_group_item)
                                        <option value="{{ $property_group_item->id }}">{{ $property_group_item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="propertyValue">Giá trị thuộc tính</label>
                                <input type="text" class="form-control" id="propertyValue" name="propertyValue" placeholder="Giá trị thuộc tính" required oninvalid="this.setCustomValidity('Lỗi: Giá trị thuộc tính không hợp lệ')">
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit mr-2">Thêm</button>
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
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/property/create_property.js') }}"></script>
@endsection
