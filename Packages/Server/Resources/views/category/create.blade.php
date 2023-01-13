@extends('server::base_layout')

@section('title', 'Create category page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm loại giày mới</h4>
                        <form class="forms-sample" method="post" action="{{ route('server.category.create.post') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên loại giày</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên loại giày" required oninvalid="this.setCustomValidity('Lỗi: Tên loại giày không hợp lệ.')">
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                            <a class="btn btn-light" href="{{ route('server.category.get') }}">Hủy bỏ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/category.js') }}"></script>
@endsection
