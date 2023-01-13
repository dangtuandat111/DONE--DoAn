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
                        <h4 class="card-title">Chỉnh sửa biến thể giày</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data"
                              action="{{ route('server.api.product.variant.edit') }}">
                            @csrf
                            <div class="tab-product-variant">
                                <div class="product-variant-area">
                                    <div class="form-group">
                                        <label for="product_variant_description">Mô tả</label>
                                        <textarea class="wysiwyg" id="product_variant_description"
                                                  name="product_variant_description">
                                            @if (!empty($product_variant_data[0]->description))
                                                {!! $product_variant_data[0]->description !!}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label for="product_variant_count">Số lượng</label> <i
                                                class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="number" class="form-control" id="product_variant_count"
                                               name="product_variant_count" placeholder="Nhập số lượng"
                                               value="{{ $product_variant_data[0]->count }}">
                                    </div>
                                    <div class="info-label">
                                        <label for="product_variant_property fw-bold">Chọn thuộc tính</label> <i
                                            class="mdi mdi-alert-circle-outline"></i>
                                    </div>
                                    <div class="form-group product_variant_property_form_group pl-4">
                                        @foreach($property_group_data as $property_group_data_item)
                                            <div class="mb-2">
                                                <div class="info-label">
                                                    <label
                                                        for="product_variant_property_{{ $property_group_data_item->id }}">{{ $property_group_data_item->name }}</label>
                                                </div>
                                                <select
                                                    id="product_variant_property_{{ $property_group_data_item->id }}"
                                                    class="custom-select custom-select-sm form-control border-radius-15"
                                                    name="product_variant_property_{{ $property_group_data_item->id }}">
                                                    <option value="-1">Chọn màu sắc</option>
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
                                        <label for="product_variant_option fw-bold">Chọn tùy chọn</label> <i
                                            class="mdi mdi-alert-circle-outline"></i>
                                    </div>
                                    <div class="form-group product_variant_option_form_group pl-4">
                                        @foreach($option_group_data as $option_group_data_item)
                                            <div class="mb-2">
                                                <div class="info-label">
                                                    <label
                                                        for="product_variant_property_{{ $option_group_data_item->id }}">{{ $option_group_data_item->name }}</label>
                                                    @if($option_group_data_item->id == 1)
                                                        <i class="mdi mdi-alert-circle-outline"></i>
                                                    @endif
                                                </div>
                                                <select id="product_variant_option_{{ $option_group_data_item->id }}"
                                                        class="custom-select custom-select-sm form-control border-radius-15"
                                                        name="product_variant_option_{{ $option_group_data_item->id }}">
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
                                                <input class="checkbox" type="checkbox" id="product_variant_discount"
                                                       name="product_variant_discount">
                                                Chọn để thiết đặt giảm giá
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="product_variant_detail d-none form-group">
                                            <div class="info-label">
                                                <label for="product_variant_discount_percent">Giảm giá (%)</label> <i
                                                    class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <input type="number" id="product_variant_discount_percent"
                                                   name="product_variant_discount_percent"
                                                   placeholder="Nhập giảm giá (%)" class="form-control"
                                                   value="{{ $product_variant_data[0]->discount }}">
                                            <div
                                                class="product_variant_time d-none col-6 pl-0 mt-4 d-flex justify-content-center">
                                                <div class="product_variant_time_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_variant_start_discount">Thời gian bắt
                                                            đầu</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control"
                                                           id="product_variant_start_discount"
                                                           name="product_variant_start_discount"
                                                           value="{{ \Carbon\Carbon::parse($product_variant_data[0]->start_at)->format('Y-m-d')}}">
                                                </div>
                                                <div class="product_variant_end_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_variant_end_discount">Thời gian kết
                                                            thúc</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control"
                                                           id="product_variant_end_discount"
                                                           name="product_variant_end_discount"
                                                           value="{{ \Carbon\Carbon::parse($product_variant_data[0]->end_at)->format('Y-m-d')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label>Ảnh đại diện</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="file" name="product_variant_image" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled=""
                                                   placeholder="Tải ảnh lên"
                                                   value="{{ $product_variant_data[0]->thumbnail }}">
                                            <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Tải lên</button>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="form-group upload-multiple-image">
                                        <div class="dandev-reviews">
                                            <div class="form_upload">
                                                <label class="dandev_insert_attach"><span
                                                        class="p-0">Ảnh sản phẩm</span></label>
                                            </div>
                                            <div class="list_attach">
                                                <ul class="dandev_attach_view">
                                                    @foreach($product_variant_image as $key => $image)
                                                    <li id="li_files_{{ $image->id }}" class="">
                                                        <div class="img-wrap">
                                                            <span class="close" onclick="DelImg(this)">×</span>
                                                            <div class="img-wrap-box"><img src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $image->name) }}"></div>
                                                        </div>
                                                        <div class="1672155703614">
                                                            <input type="file" class="hidden"
                                                                  onchange="uploadImg(this)"
                                                                  id="files_{{ $image->id }}"
                                                                  name="files_{{ $image->id }}" data-key="{{ $image->id }}">
                                                            <input type="hidden" id="id_files_{{ $image->id }}" value="{{ $image->id }}" name="pv_file[]">
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <span class="dandev_insert_attach"><i class="dandev-plus">+</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="product_variant_id"  name="id_product_variant" value="{{ $product_variant_data[0]->id }}">
                            </div>
                            <div class="submit-cancel col-12 float-right">
                                <button type="submit" class="btn btn-primary mr-2 btn-submit">Cập nhật</button>
                                <a class="btn btn-light" href="{{ route('server.product.get') }}">Hủy bỏ</a>
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
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/product/edit_product_variant.js') }}"></script>
@endsection

