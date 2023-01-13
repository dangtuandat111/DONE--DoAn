@extends('server::base_layout')

@section('title', 'Product page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách sản phẩm</h4>
                        <div class="new-action float-right" style="padding-top: 13px; margin-bottom: 1.5rem;">
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.product.create') }}">Thêm mới sản phẩm</a>
                        </div>
                        <div class="filter-area col-12 col-md-12 col-sm-12 pl-0">
                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Hiển thị</label>
                                <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="2">2</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="-1" selected>Tất cả</option>
                                </select>
                                <label class="mb-0 pl-2"> / trang</label>
                            </div>

                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">
                                <select name="search_brand_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled selected>Chọn nhãn hàng</option>
                                    @foreach($brand_data as $brand_data_item)
                                        <option value="{{ $brand_data_item->id }}">{{ $brand_data_item->name }}</option>
                                    @endforeach
                                    <option value="-1">Tất cả</option>
                                </select>
                            </div>

                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">
                                <select name="search_category_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled selected>Chọn loại giày</option>
                                    @foreach($category_data as $category_data_item)
                                        <option value="{{ $category_data_item->id }}">{{ $category_data_item->name }}</option>
                                    @endforeach
                                    <option value="-1">Tất cả</option>
                                </select>
                            </div>

                            <div class="form-group padding-r-15">
                                <div class="input-group">
                                    <input type="text" class="form-control border-radius-15" id="search_product_name" placeholder="Tìm kiếm theo thuộc tính" name="search">
                                </div>
                            </div>

                            <div class="form-group d-flex">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                        <div class="data-product-group-table">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="productVariant" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-header flex-row-reverse ">
                            <h4 class="modal-title">
                                <div style="float:right">Danh sách biến thể sản phẩm</div><br>
                            </h4>
                        </div>
                        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default close-button" style="text-align:right" data-dismiss="modal">Trở lại trang</button>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <input type="hidden" id="search_product" value="{{ route('server.api.product.search') }}">
    <input type="hidden" id="get_product_variant" value="{{ route('server.api.product.variant') }}">
    <!-- input hidden -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/product/product.js') }}"></script>
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
