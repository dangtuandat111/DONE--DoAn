@extends('server::base_layout')

@section('title', 'Create product page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create new Product</h4>
                        <form class="forms-sample" method="post" action="{{ route('server.product.create.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-brand">
                                <select name="search_brand" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled selected>Select brand</option>
                                    @foreach($brand_data as $brand_data_item)
                                        <option value="{{ $brand_data_item->id }}">{{ $brand_data_item->name }}</option>
                                    @endforeach
                                    <option value="-1">All</option>
                                </select>
                            </div>
                            <div class="tab-category">
                                <select name="search_category_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled selected>Select category</option>
                                    @foreach($category_data as $category_data_item)
                                        <option value="{{ $category_data_item->id }}">{{ $category_data_item->name }}</option>
                                    @endforeach
                                    <option value="-1">All</option>
                                </select>
                            </div>
                            <div class="tab-property">

                            </div>
                            <div class="tab-product">
                                <div class="form-group">
                                    <label for="name">Product name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Product name" required oninvalid="this.setCustomValidity('Messsage Error: Please enter valid product name')">
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="img[]" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                        <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a class="btn btn-light" href="{{ route('server.product.get') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
{{--    <script src="{{ asset('DoAnTotNghiep/server/assets/js/brand/brand.js') }}"></script>--}}
    <script src="{{ asset('DoAnTotNghiep/server/js/file-upload.js') }}"></script>
@endsection
