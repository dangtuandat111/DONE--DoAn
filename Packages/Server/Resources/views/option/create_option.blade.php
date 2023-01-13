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
                        <h4 class="card-title">Thêm tùy chọn</h4>
                        <div class="forms-sample" data-route="{{ route('server.api.option.create') }}">
                            <div class="form-group">
                                <label for="optionName">Tên tùy chọn</label>
                                <input type="text" class="form-control" id="optionName" name="optionName" placeholder="Tên tùy chọn" required oninvalid="this.setCustomValidity('Lỗi: Tên tùy chọn không hợp lệ.)">
                            </div>
                            <div class="form-group">
                                <label for="optionGroupSelect">Nhóm tùy chọn</label>
                                <select name="optionGroupSelect" id="optionGroupSelect" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="-1" selected disabled hidden>Chọn nhóm tùy chọn</option>
                                    @foreach($optionGroup as $optionGroupItem)
                                        <option value="{{ $optionGroupItem->id }}">{{ $optionGroupItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="optionValue">Tùy chọn</label>
                                <input type="text" class="form-control" id="optionValue" name="optionValue" placeholder="Nhập tùy chọn" required oninvalid="this.setCustomValidity('Giá trị tùy chọn không hợp lệ.')">
                            </div>
                            <div class="form-group">
                                <label for="optionBonus">Giá thêm</label>
                                <input type="number" class="form-control" id="optionBonus" name="optionBonus" placeholder="Giá tùy chọn thêm" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit mr-2">Thêm</button>
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
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/option/create_option.js') }}"></script>
@endsection
