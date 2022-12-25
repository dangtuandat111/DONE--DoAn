@extends('server::base_layout')

@section('title', 'Edit product page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/vendors/mdi/css/materialdesignicons.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Category</h4>
                        <form class="forms-sample" method="post" action="{{ route('server.api.product.variant.edit') }}">
                            @csrf
                            <div class="tab-product-variant">
                                <div class="product-variant-area">
                                    <div class="form-group">
                                        <label for="product_variant_description">Description</label>
                                        <textarea class="wysiwyg" id="product_variant_description" name="product_variant_description">
                                            @if (!empty($product_variant_data[0]->description))
                                                {!! $product_variant_data[0]->description !!}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label for="product_variant_count">Count</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="number" class="form-control" id="product_variant_count" name="product_variant_count" placeholder="Product variant count" value="{{ $product_variant_data[0]->count }}" >
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
                                                    @foreach($property_data as $property_data_item)
                                                        @if ($property_data_item->id_property_group == $property_group_data_item->id)
                                                            <option value="{{ $property_data_item->id }}"
                                                            @foreach($selected_property as $selected_property_item)
                                                                @if ($selected_property_item->id_property == $property_data_item->id)
                                                                    selected
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                            >{{ $property_data_item->name }}</option>
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
                                                    @foreach($option_data as $option_data_item)
                                                        @if ($option_data_item->id_option_group == $option_group_data_item->id)
                                                            <option value="{{ $option_data_item->id }}"
                                                                @foreach($selected_option as $selected_option_item)
                                                                    @if ($selected_option_item->id_option == $option_data_item->id)
                                                                        selected
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            >{{ $option_data_item->value }}</option>
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
                                            <input type="number" id="product_variant_discount_percent" name="product_variant_discount_percent" placeholder="Discount percent" class="form-control" value="{{ $product_variant_data[0]->discount }}">
                                            <div class="product_variant_time d-none col-6 pl-0 mt-4 d-flex justify-content-center">
                                                <div class="product_variant_time_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_variant_start_discount">Start Time</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control" id="product_variant_start_discount" name="product_variant_start_discount" value="{{ \Carbon\Carbon::parse($product_variant_data[0]->start_at)->format('Y-m-d')}}">
                                                </div>
                                                <div class="product_variant_end_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_variant_end_discount">End Time</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control" id="product_variant_end_discount" name="product_variant_end_discount" value="{{ \Carbon\Carbon::parse($product_variant_data[0]->end_at)->format('Y-m-d')}}">
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
                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" value="{{ $product_variant_data[0]->thumbnail }}">
                                            <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="form-group upload-multiple-image">
                                        <div class="dandev-reviews">
                                            <div class="form_upload">
                                                <label class="dandev_insert_attach"><span class="p-0">Product variant image</span></label>
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
                            <button type="submit" class="btn btn-primary mr-2 btn-submit">Submit</button>
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
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/product/edit_product_variant.js') }}"></script>
@endsection
