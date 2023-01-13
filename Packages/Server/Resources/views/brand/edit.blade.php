@extends('server::base_layout')

@section('title', 'Edit brand page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cập nhật thông tin nhãn hàng</h4>
                        <form class="forms-sample" method="post" action="{{ route('server.brand.edit.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên nhãn hàng</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên nhãn hàng" value="{{ $brand_data->name }}" required oninvalid="this.setCustomValidity('Lỗi: Tên nhãn hàng không hợp lệ.')">
                            </div>
                            <input type="hidden" name="slug" value="{{ $slug }}">
                            <div class="form-group">
                                <label>Cập nhật ảnh</label>
                                <input type="file" name="img[]" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Tải ảnh lên" value="{{ $brand_data->thumbnail }}">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Tải lên</button>
                                    </span>
                                </div>
                                @if (isset($brand_data->img) && !empty($brand_data->img))
                                    <img class="preview-img" style="height: 50px; margin-top: 20px;" src="{{ asset($brand_data->img) }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" id="description" name="description" rows="4"> {{ $brand_data->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                            <a class="btn btn-light" href="{{ route('server.brand.get') }}">Hủy bỏ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/brand/brand.js') }}"></script>
    <script src="{{ asset('DoAnTotNghiep/server/js/file-upload.js') }}"></script>
@endsection
