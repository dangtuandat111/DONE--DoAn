@extends('server::base_layout')

@section('title', 'Property page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách thuộc tính</h4>
                        <div class="new-action float-right" style="padding-top: 13px; margin-bottom: 1.5rem;">
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.property.create.get') }}">Thêm thuộc tính mới</a>
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.property.group.create.get') }}">Thêm nhóm thuộc tính</a>
                        </div>
                        <div class="filter-area col-12 col-md-12 col-sm-12 pl-0">
                            <div class="form-group col-4 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Hiển thị</label>
                                <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="2">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="-1" selected>Tất cả</option>
                                </select>
                                <label class="mb-0 pl-2"> / trang</label>
                            </div>

                            <div class="form-group col-4 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Chọn nhóm thuộc tính </label>
                                <select name="filter_search_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    @foreach($property_group_data as $property_group_data_item)
                                        <option value="{{ $property_group_data_item->id }}">{{ $property_group_data_item->name }}</option>
                                    @endforeach
                                    <option value="-1" selected>Tất cả</option>
                                </select>
                            </div>

                            <div class="form-group padding-r-15">
                                <div class="input-group">
                                    <input type="text" class="form-control border-radius-15" id="search_property_name" placeholder="Tìm kiếm theo thuộc tính" name="search">
                                </div>
                            </div>

                            <div class="form-group d-flex">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                        <div class="data-property-group-table">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <input type="hidden" id="search_property_group" value="{{ route("server.api.property.group.search") }}">
    <input type="hidden" id="search_property" value="{{ route("server.api.property.search") }}">
    <!-- input hidden -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/property/property.js') }}"></script>
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
