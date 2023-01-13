@extends('server::base_layout')

@section('title', 'Category page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách loại giày</h4>
                        <div class="new-action float-right" style="padding-top: 13px; margin-bottom: 1.5rem;">
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.category.create.get') }}">Thêm loại giày mới</a>
                        </div>
                        <div class="form-group float-right" style="padding-right: 1rem">
                            <div class="input-group">
                                <input type="text" class="form-control border-radius-15" id="search_category_name" placeholder="Tìm kiếm theo tên" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive category_list">
                            <table class="table table-striped" id="sortable-table-1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="sortStyle unsortStyle">Tên loại giày<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle unsortStyle">Mô tả</th>
                                    <th class="sortStyle unsortStyle">Thời gian tạo<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle unsortStyle">Thời gian cập nhật<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle unsortStyle">Tình trạng</th>
                                    <th class="sortStyle unsortStyle">Hành động thêm</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $stt = 1 ?>
                                @foreach ($category_date as $category_date_item)
                                    <tr>
                                        <td>{{ $stt }}</td>
                                        <td>{{ $category_date_item->name }}</td>
                                        <td class="mw-100px wrap-content">{{ $category_date_item->description }}</td>
                                        <td>{{ $category_date_item->c_at }}</td>
                                        <td>{{ $category_date_item->u_at }}</td>
                                        <td>
                                            <label class="badge badge-warning @if ($category_date_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $category_date_item->id }}">Khả dụng</label>
                                            <label class="badge badge-danger @if ($category_date_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $category_date_item->id }}">Không khả dụng</label>
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.category.edit.get', ['slug' => $category_date_item->slug]) }}">Chỉnh sửa {{ $category_date_item->name }}</a>
                                        </td>
                                        <?php $stt++ ?>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->

    <!-- input hidden -->
    <input type="hidden" id="update_status_category" value="{{ route("server.api.category.update") }}">
    <input type="hidden" id="search_category" value="{{ route("server.api.category.search") }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/category/category.js') }}"></script>
    <script>
        $(document).ready(function() {
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
