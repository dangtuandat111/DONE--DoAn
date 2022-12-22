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
                        <h4 class="card-title">Product List</h4>
                        <div class="new-action float-right" style="padding-top: 13px; margin-bottom: 1.5rem;">
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.product.create') }}">Create new Product</a>
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.product.variant.create') }}">Create new Product Variant</a>
                        </div>
                        <div class="filter-area col-12 col-md-12 col-sm-12 pl-0">
                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Show</label>
                                <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="2">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="-1" selected>All</option>
                                </select>
                                <label class="mb-0 pl-2">entries</label>
                            </div>

                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">
                                <select name="search_brand_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled selected>Select brand</option>
                                    @foreach($brand_data as $brand_data_item)
                                        <option value="{{ $brand_data_item->id }}">{{ $brand_data_item->name }}</option>
                                    @endforeach
                                    <option value="-1">All</option>
                                </select>
                            </div>

                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">
                                <select name="search_category_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled selected>Select category</option>
                                    @foreach($category_data as $category_data_item)
                                        <option value="{{ $category_data_item->id }}">{{ $category_data_item->name }}</option>
                                    @endforeach
                                    <option value="-1">All</option>
                                </select>
                            </div>

{{--                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">--}}
{{--                                <select name="search_option_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">--}}
{{--                                    <option value="" disabled selected>Select option</option>--}}
{{--                                    @foreach($option_data as $option_data_item)--}}
{{--                                        <option value="{{ $option_data_item->id }}">{{ $option_data_item->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                    <option value="-1">All</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">--}}
{{--                                <select name="search_property_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">--}}
{{--                                    <option value="" disabled selected>Select property</option>--}}
{{--                                    @foreach($property_data as $property_data_item)--}}
{{--                                        <option value="{{ $property_data_item->id }}">{{ $property_data_item->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                    <option value="-1">All</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <div class="form-group padding-r-15">
                                <div class="input-group">
                                    <input type="text" class="form-control border-radius-15" id="search_product_name" placeholder="Search by property name or property group name" name="search">
                                </div>
                            </div>

                            <div class="form-group d-flex">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="data-product-group-table">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <input type="hidden" id="search_product" value="{{ route('server.api.product.search') }}">
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
