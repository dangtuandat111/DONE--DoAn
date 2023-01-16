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
                        <h4 class="card-title">Chỉnh sửa thông tin sản phẩm</h4>
                        <form class="forms-sample" method="post" action="{{ route('server.api.product.edit') }}">
                            @csrf
                            <div class="tab-product">
                                <input type="hidden" name="product_id" value="{{ $product_data[0]->id }}">
                                <div class="create-product">
                                    <div class="tab-brand tab-category col-12 d-flex flex-column pl-0">
                                        <div class="brand-area mb-4 col-6 pl-0">
                                            <div class="info-label d-flex">
                                                <div class="mb-2">Chọn nhãn hàng cho sản phẩm</div>
                                                <div style="width: 5px"></div>
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <select id="id_brand" name="id_brand" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                                @foreach($brand_data as $brand_data_item)
                                                    <option value="{{ $brand_data_item->id }}" @if ($brand_data_item->id == $product_data[0]->id_brand) selected @endif>{{ $brand_data_item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="category-area col-6 pl-0 mb-4">
                                            <div class="info-label d-flex">
                                                <div class="mb-2">chọn loại giày cho sản phẩm</div>
                                                <div style="width: 5px"></div>
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <select id="id_category" name="id_category" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                                <option value="" disabled selected>Chọn loại giày</option>
                                                @foreach($category_data as $category_data_item)
                                                    <option value="{{ $category_data_item->id }}" @if ($category_data_item->id == $product_data[0]->id_category) selected @endif>{{ $category_data_item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="info-label">
                                            <label for="product_name">Tên sản phẩm</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Tên sản phẩm" value="{{ $product_data[0]->name }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label for="product_status">Tình trạng sản phẩm</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <select id="product_status" name="product_status" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                           <option value="0" @if ($product_data[0]->status == 0 ) selected @endif>Không khả dụng</option>
                                           <option value="1" @if ($product_data[0]->status == 1 ) selected @endif>Khả dụng</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="info-label">
                                            <label for="product_price">Giá tiền</label> <i class="mdi mdi-alert-circle-outline"></i>
                                        </div>
                                        <input type="number" class="form-control" step="0.01" id="product_price" name="product_price" placeholder="Giá tiền" value="{{ $product_data[0]->price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_feature">Feature</label>
                                        <textarea class="wysiwyg" id="product_feature" name="product_feature">{!! $product_data[0]->feature !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_description">Mô tả</label>
                                        <textarea class="wysiwyg" id="product_description" name="product_description">{!! $product_data[0]->description !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label" for="product_discount">
                                                <input class="checkbox" type="checkbox" id="product_discount" name="product_discount"
                                                       @if ($product_data[0]->id_category) checked @endif>
                                                Chọn để thiết lập giảm giá
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="product_detail @if (!$product_data[0]->id_category) d-none @endif form-group">
                                            <div class="info-label">
                                                <label for="product_discount_percent">Giảm giá (%) </label> <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                            <input type="number" id="product_discount_percent" name="product_discount_percent" placeholder="Giảm giá (%)" class="form-control" value="{{ $product_data[0]->discount }}">
                                            <div class="product_time d-none col-6 pl-0 mt-4 d-flex justify-content-center">
                                                <div class="product_time_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_start_discount">Thời gian bắt đầu</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control" id="product_start_discount" name="product_start_discount" value="{{ $product_data[0]->s_at }}">
                                                </div>
                                                <div class="product_end_start col-6 pl-0">
                                                    <div class="info-label">
                                                        <label for="product_end_discount">Thời gian kết thúc</label> <i class="mdi mdi-alert-circle-outline"></i>
                                                    </div>
                                                    <input type="date" class="form-control" id="product_end_discount" name="product_end_discount" value="{{ $product_data[0]->e_at }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 btn-submit">Cập nhật</button>
                            <a class="btn btn-light" href="{{ route('server.product.get') }}">Hủy bỏ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/product/edit_product.js') }}"></script>
    <script src="{{ asset('DoAnTotNghiep/server/js/file-upload.js') }}"></script>
@endsection
