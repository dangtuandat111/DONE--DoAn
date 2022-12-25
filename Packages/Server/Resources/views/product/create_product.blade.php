@extends('server::base_layout')

@section('title', 'Create product page')

@section('more-css')
        <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/css/product.css') }}">
        <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/mdi/css/materialdesignicons.min.css') }}">
@endsection

@section('bodyclass') sidebar-icon-only @endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create new Product</h4>
                        <form class="forms-samples form-mutiple-step step-1" method="post" action="{{ route('server.api.product.create') }}" enctype="multipart/form-data">
                            @csrf
                            <ul class="form-steps">
                                <li class="is-active step-1">Step 1</li>
                                <li class=" step-2">Step 2</li>
                            </ul>

                            <div class="tab-product">
                                <div class="form-group d-flex flex-column">
                                    <div class="info-label">
                                        <label class="mb-2">Select option</label> <i class="mdi mdi-alert-circle-outline"></i>
                                    </div>

                                    <select id="product_select_create_option" class="custom-select custom-select-sm form-control h-100 border-radius-15 col-4" name="product_select_create_option">
                                        <option value="0" selected>Select current product</option>
                                        <option value="1">Create a new one</option>
                                    </select>
                                </div>
                                <div class="create-product d-none">
                                    <div class="tab-brand tab-category col-12 d-flex flex-column pl-0">
                                        <div class="brand-area mb-4 col-6 pl-0">
                                            <div class="info-label d-flex">
                                                <div class="mb-2">Select brand for product </div>
                                                <div style="width: 5px"></div>
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <select id="id_brand" name="id_brand" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                                <option value="" disabled selected>Select brand</option>
                                                @foreach($brand_data as $brand_data_item)
                                                    <option value="{{ $brand_data_item->id }}">{{ $brand_data_item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="category-area col-6 pl-0 mb-4">
                                            <div class="info-label d-flex">
                                                <div class="mb-2">Select category for product </div>
                                                <div style="width: 5px"></div>
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <select id="id_category" name="id_category" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                                <option value="" disabled selected>Select category</option>
                                                @foreach($category_data as $category_data_item)
                                                    <option value="{{ $category_data_item->id }}">{{ $category_data_item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="info-label">
                                            <label for="product_name">Product name</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product name">
                                    </div>
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label for="product_price">Price</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="number" class="form-control" step="0.01" id="product_price" name="product_price" placeholder="Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_feature">Feature</label>
                                        <textarea class="wysiwyg" id="product_feature" name="product_feature"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_description">Description</label>
                                        <textarea class="wysiwyg" id="product_description" name="product_description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label" for="product_discount">
                                                <input class="checkbox" type="checkbox" id="product_discount" name="product_discount">
                                                Checked for set discount detail
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="product_detail d-none form-group">
                                            <div class="info-label">
                                                <label for="product_discount_percent">Discount percent</label> <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <input type="number" id="product_discount_percent" name="product_discount_percent" placeholder="Discount percent" class="form-control">
                                            <div class="product_time d-none col-6 pl-0 mt-4 d-flex justify-content-center">
                                                <div class="product_time_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_start_discount">Start Time</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control" id="product_start_discount" name="product_start_discount">
                                                </div>
                                                <div class="product_end_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_end_discount">End Time</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control" id="product_end_discount" name="product_end_discount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="select-product form-cl">
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label class="mb-2">Select product</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <select id="product_select_product" class="custom-select custom-select-sm form-control h-100 border-radius-15" name="product_select_product">
                                            <option value="" disabled selected>Select one of these product</option>
                                            @foreach($product_data as $product_data_item)
                                                <option value="{{ $product_data_item->id }}">{{ $product_data_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-product-variant">
                                <div class="product-variant-area">
                                    <div class="form-group">
                                        <label for="product_variant_description">Description</label>
                                        <textarea class="wysiwyg" id="product_variant_description" name="product_variant_description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label for="product_variant_count">Count</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="number" class="form-control" id="product_variant_count" name="product_variant_count" placeholder="Product variant count" >
                                    </div>
                                    <div class="info-label">
                                        <label for="product_variant_property fw-bold">Select property</label> <i class="mdi mdi-alert-circle-outline"></i>
                                    </div>
                                    <div class="form-group product_variant_property_form_group pl-4">
                                        @foreach($property_group_data as $property_group_data_item)
                                            <div class="mb-2">
                                                <div class="info-label">
                                                    <label for="product_variant_property_{{ $property_group_data_item->id }}">{{ $property_group_data_item->name }}</label>
                                                </div>
                                                <select id="product_variant_property_{{ $property_group_data_item->id }}" class="custom-select custom-select-sm form-control h-100 border-radius-15" name="product_variant_property_{{ $property_group_data_item->id }}">
                                                    <option value="" disabled selected>Select one of these product property</option>
                                                    @foreach($property_data as $property_data_item)
                                                        @if ($property_data_item->id_property_group == $property_group_data_item->id)
                                                            <option value="{{ $property_data_item->id }}">{{ $property_data_item->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="info-label">
                                        <label for="product_variant_option fw-bold">Select option</label> <i class="mdi mdi-alert-circle-outline"></i>
                                    </div>
                                    <div class="form-group product_variant_option_form_group pl-4">
                                        @foreach($option_group_data as $option_group_data_item)
                                            <div class="mb-2">
                                                <div class="info-label">
                                                    <label for="product_variant_property_{{ $option_group_data_item->id }}">{{ $option_group_data_item->name }}</label>
                                                    @if($option_group_data_item->id == 1)
                                                        <i class="mdi mdi-alert-circle-outline"></i>
                                                    @endif
                                                </div>
                                                <select id="product_variant_option_{{ $option_group_data_item->id }}" class="custom-select custom-select-sm form-control h-100 border-radius-15" name="product_variant_option_{{ $option_group_data_item->id }}" multiple>
                                                    <option value="" disabled selected>Select one of these product option</option>
                                                    @foreach($option_data as $option_data_item)
                                                        @if ($option_data_item->id_option_group == $option_group_data_item->id)
                                                            <option value="{{ $option_data_item->id }}">{{ $option_data_item->value }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label" for="product_variant_discount">
                                                <input class="checkbox" type="checkbox" id="product_variant_discount" name="product_variant_discount">
                                                Checked for set discount detail
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="product_variant_detail d-none form-group">
                                            <div class="info-label">
                                                <label for="product_variant_discount_percent">Discount percent</label> <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <input type="number" id="product_variant_discount_percent" name="product_variant_discount_percent" placeholder="Discount percent" class="form-control">
                                            <div class="product_variant_time d-none col-6 pl-0 mt-4 d-flex justify-content-center">
                                                <div class="product_variant_time_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_variant_start_discount">Start Time</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control" id="product_variant_start_discount" name="product_variant_start_discount">
                                                </div>
                                                <div class="product_variant_end_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_variant_end_discount">End Time</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control" id="product_variant_end_discount" name="product_variant_end_discount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label>Product image thumbnail</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="file" name="product_variant_image" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                            <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="form-group upload-multiple-image">
                                        <div class="dandev-reviews">
                                            <div class="form_upload">
                                                <label class="dandev_insert_attach"><span class="p-0">Product variant image</span></label> <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <div class="list_attach">
                                                <ul class="dandev_attach_view">

                                                </ul>
                                                <span class="dandev_insert_attach"><i class="dandev-plus">+</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="next-prev pager col-12">
                                <a class="btn btn-sm btn-primary disabled previous-button">Previous</a>
                                <a class="btn btn-sm btn-primary next-button">Next</a>
                                <a class="btn btn-sm btn-primary close-button" href="{{ route('server.product.get') }}">Close</a>
                                <button class="btn btn-sm btn-primary submit-button d-none" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/product/product_create.js') }}"></script>
    <script src="{{ asset('DoAnTotNghiep/server/js/file-upload.js') }}"></script>
@endsection
