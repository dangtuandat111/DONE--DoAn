@extends('client::layouts.master')

@section('title', 'Home page')

@section('more-css')
@endsection

@section('content')
    <!-- content-wrapper ends -->
    <div class="main-content w-100 float-left">
        <div class="container">
            <div class="row">
                <div class="content-wrapper col-xl-9 col-lg-9 order-lg-2">
                    <header class="product-grid-header d-flex d-xs-block d-sm-flex d-lg-flex w-100 float-left">
                        <div
                            class="hidden-sm-down total-products d-flex d-xs-block d-lg-flex col-md-3 col-sm-3 col-xs-12 align-items-center">
                            <div class="row">
                                <div class="nav" role="tablist">
                                    <a class="grid active" href="#grid" data-toggle="tab" role="tab"
                                       aria-selected="true"
                                       aria-controls="grid"><i class="material-icons align-middle">grid_on</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div
                            class="shop-results-wrapper d-flex d-sm-flex d-xs-block d-lg-flex justify-content-end col-md-9 col-sm-9 col-xs-12">
                            <div class="shop-results d-flex align-items-center"><span>Hiển thị</span>
                                <div class="shop-select">
                                    <select name="product_per_page" id="product_per_page">
                                        <option value="3">3</option>
                                        <option value="6">6</option>
                                        <option value="12">12</option>
                                        <option value="-1" selected>Chọn tất cả</option>
                                    </select>
                                </div>
                            </div>
                            <div class="shop-results d-flex align-items-center"><span>Tìm kiếm theo tên sản phẩm</span>
                                <input id="product_name" name="product_name">
                            </div>
                        </div>
                    </header>
                    <div class="searchContent text-center products w-100 float-left">
                        <div class="tab-pane grid fade active searchResult show" id="grid" role="tabpanel">
                        </div>
                    </div>
                    <!-- Paginate -->
                </div>

                <div class="left-column sidebar col-xl-3 col-lg-3 order-lg-1">
                    <div class="sidebar-filter left-sidebar w-100 float-left">
                        <div class="reset-params btn mb-3 px-0">Xóa lọc</div>

                        <div class="title">
                            <a data-toggle="collapse" href="#sidebar-main" aria-expanded="false" aria-controls="sidebar-main" class="d-lg-none block-toggler">Danh sách loại giày</a>
                        </div>
                        <div id="sidebar-main" class="sidebar-main collapse">
                            <div class="sidebar-block categories">
                                <h3 class="widget-title"><a data-toggle="collapse" href="#categoriesMenu" role="button" aria-expanded="true" aria-controls="categoriesMenu">Danh sách loại giày</a></h3>
                                <div id="categoriesMenu" class="expand-lg collapse show">
                                    <div class="nav nav-pills flex-column mt-4">
                                        @foreach($category_data as $category_data_item)
                                            <div class="nav-link d-flex justify-content-between mb-2 change_category" data-category="{{ $category_data_item->id }}">
                                                <span class="col-12">{{ $category_data_item->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-block brand">
                                <h3 class="widget-title"><a data-toggle="collapse" href="#categoriesMenu" role="button" aria-expanded="true" aria-controls="categoriesMenu">Nhãn hàng</a></h3>
                                <div id="categoriesMenu" class="expand-lg collapse show">
                                    <div class="nav nav-pills flex-column mt-4">
                                        @foreach($brand_data as $brand_data_item)
                                            <div class="nav-link d-flex justify-content-between mb-2 change_brand" data-brand="{{ $brand_data_item->id }}">
                                                <span class="col-12">{{ $brand_data_item->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-block color">
                                <h3 class="widget-title"><a data-toggle="collapse" href="#color" role="button" aria-expanded="true" aria-controls="color">Màu sắc</a></h3>
                                <div id="color" class="sidebar-widget-option-wrapper collapse show">
                                    <div class="color-inner">
                                        @foreach($property_data as $property_data_item)
                                            @if($property_data_item->id_property_group == 1)
                                                <div class="sidebar-widget-option mb-2 d-flex change-color">
                                                    <a class="pr-2 rounded" data-color="{{ $property_data_item->id }}" style="background-color: {{ $property_data_item->value }};"></a>
                                                    <div class="pl-2 col-10 rounded">{{ $property_data_item->name }}</div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- input hidden -->
    <input type="hidden" id="search_product" value="{{ route('client.search') }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/client/assets/js/search.js') }}"></script>

    <script>
        $(document).ready(function () {
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
