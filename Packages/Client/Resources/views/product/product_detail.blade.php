@extends('client::layouts.master')

@section('title', 'Product Detail page')

@section('more-css')
@endsection

@section('content')
    <!-- content-wrapper ends -->
    <div class="product-deatils-section float-left w-100">
        <div class="container">
            <div class="row">
                <!-- Image -->
                <div class="left-columm col-lg-5 col-md-5">
                    <div class="product-large-image tab-content">
                        @foreach($product_variant_data[0]->image as $key => $img)
                            <div class="tab-pane @if ($key == 0) active show @endif" id="product-0{{ $key + 1 }}" role="tabpanel" aria-labelledby="product-tab-0{{ $key + 1 }}">
                                <div class="single-img" style="position: relative; overflow: hidden;">
                                    <a>
                                        <img
                                            src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $img->name) }}"
                                            class="img-fluid" alt="">
                                    </a>
                                    <img role="presentation" alt=""
                                         src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $img->name) }}"
                                         class="js-qv-product-cover zoomImg"
                                         style="position: absolute; top: 0px; left: 0px; opacity: 0; width: 970px; height: 1261px; border: none; max-width: none; max-height: none;">
                                </div>
                            </div>
                        @endforeach
                        <div class="default-image d-none">
                            <div class="tab-pane" id="product-0xxx" role="tabpanel" aria-labelledby="product-0xxx">
                                <div class="single-img" style="position: relative; overflow: hidden;">
                                    <a>
                                        <img
                                            data-src="{{ asset('DoAnTotNghiep/server/assets/images/product/') }}"
                                            class="img-fluid" alt="">
                                    </a>
                                    <img role="presentation" alt=""
                                         data-src="{{ asset('DoAnTotNghiep/server/assets/images/product/') }}"
                                         class="js-qv-product-cover zoomImg"
                                         style="position: absolute; top: 0px; left: 0px; opacity: 0; width: 970px; height: 1261px; border: none; max-width: none; max-height: none;">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="default small-image-list float-left w-100">
                        <div
                            class="nav-add small-image-slider-single-product-tabstyle-3 owl-carousel owl-loaded owl-drag"
                            role="tablist">
                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                     style="transform: translate3d(-98px, 0px, 0px); transition: all 0.25s ease 0s; width: 491px;">
                                    @foreach($product_variant_data[0]->image as $key => $img)
                                        <div class="owl-item @if ($key == 0) active @endif" style="width: 88.125px; margin-right: 10px;">
                                            <div class="single-small-image img-full">
                                                <a data-toggle="tab" id="product-tab-0{{ $key + 1 }}" href="#product-0{{ $key + 1 }}" class="img"><img
                                                        src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $img->name) }}"
                                                        class="img-fluid" alt=""></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="default-small-image d-none">
                                    <div class="owl-item" style="width: 88.125px; margin-right: 10px;">
                                        <div class="single-small-image img-full">
                                            <a data-toggle="tab" id="product-tab-0xxx" href="#product-0xxx" class="img"><img
                                                    data-src="{{ asset('DoAnTotNghiep/server/assets/images/product/') }}"
                                                    class="img-fluid" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Info -->
                <div class="right-columm col-lg-7 col-md-7">
                    <div class="product-information">
                        <h4 class="product-title text-capitalize float-left w-100">
                            <div class="float-left w-100">{{ $product_data->name }}</div>
                        </h4>
                        <div class="description">
                            {!! $product_variant_data[0]->description !!}
                        </div>
                        <div class="feature">
                            {!! $product_data->feature !!}
                        </div>
                        <div class="sales">
                            <input type="hidden" value="{{ $product_data->price }}" id="prod_price">
                            @if ($product_variant_data[0]->discount > 0)
                                <div class="label"><div>Giảm giá: </div><h3 class="fw-bold sales_discount" style="color:darkred">{{ $product_variant_data[0]->discount }} %</h3></div>
{{--                                <ul class="countdown countdown1 float-left w-100">--}}
{{--                                    <li><span class="days">{{ Carbon\Carbon::parse($product_variant_data[0]->end_at)->format('d') }}</span>--}}
{{--                                </ul>--}}
{{--                                <ul class="countdown countdown1 float-left w-100">--}}
{{--                                    <li><span class="hour">{{ Carbon\Carbon::parse($product_variant_data[0]->end_at)->format('m') }} </span>--}}
{{--                                </ul>--}}
{{--                                <ul class="countdown countdown1 float-left w-100">--}}
{{--                                    <li style="padding-right: 20px;"><span class="years">{{ Carbon\Carbon::parse($product_variant_data[0]->end_at)->format('Y') }}</span>--}}
{{--                                </ul>--}}
                            @endif
                            <div class="price float-left w-100 d-flex">
                                @if ($product_variant_data[0]->discount > 0)
                                    <div class="regular-price">{{ ((100 - $product_variant_data[0]->discount) * $product_data->price / 100) }}$</div>
                                    <div class="old-price">{{ $product_data->price }}$</div>
                                @else
                                    <div class="regular-price">{{ $product_data->price }}$</div>
                                @endif
                            </div>
                        </div>

                        <div class="product-variants float-left w-100">
                            <div class="col-md-12 col-sm-6 col-xs-12 size-options d-flex align-items-center">
                                <h5>Màu sắc: </h5>
                                <div class="select_color">
                                    @foreach($product_data->list_color as $allow_color)
                                        <button type="button" value="{{ $allow_color}}"
                                                class=" btn btn-fw text-dark
                                                @if ($allow_color == $product_variant_data[0]->color) btn-outline-dark
                                                @endif"
                                                style="min-width: 50px; margin-right: 10px;"
                                        >{{ $allow_color }}</button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-xs-12 size-options d-flex align-items-center">
                                <h5>Kích cỡ:  </h5>
                                <div class="select_size">
                                    @foreach($product_data->list_size as $allow_size)
                                        <button type="button" value="{{ $allow_size }}"
                                                class=" btn btn-fw text-dark"
                                                style="min-width: 50px; margin-right: 10px;"
                                        >{{ $allow_size }}</button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-xs-12 size-options d-flex align-items-center">
                                <h5>Độ rộng: </h5>
                                <div class="select_width">
                                    @foreach($product_data->list_width as $allow_width)
                                        <button type="button" value="{{ $allow_width }}"
                                                class=" btn btn-fw text-dark"
                                                style="min-width: 50px; margin-right: 10px;"
                                        >{{ $allow_width }}</button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-xs-12 ih-options align-items-center mb-4 d-none">
                                <h5>Chiều cao Lót giày:  </h5>
                                <div class="select_insole_height d-none">

                                </div>
                                <button type="button"
                                        class="default_insole_height_element d-none btn btn-fw text-dark"
                                        style="min-width: 50px; margin-right: 10px;"
                                >1cm</button>
                            </div>

                            <div class="col-md-12 col-sm-6 col-xs-12 sc-options align-items-center d-none">
                                <h5>Màu dây giày:  </h5>
                                <div class="select_shoeslace_color d-none">

                                </div>
                                <button type="button"
                                        class="default_shoeslace_color_element d-none btn btn-fw text-dark"
                                        style="min-width: 50px; margin-right: 10px;"
                                >1cm</button>
                            </div>
                        </div>
                        <div class="btn-cart d-flex align-items-center float-left w-100">
                            <h5>Số lượng</h5>
                            <input value="1" type="number" id="qty_number" step="1" min="0">
                            @if (\Auth::guard('customer')->check())
                                <button type="button" class="btn btn-primary btn-cart m-0 btn-add-cart" data-target="#cart-pop"
                                        data-toggle="modal" data-id="{{ $product_variant_data[0]->id }}">
                                    <i class="material-icons">shopping_cart</i> Thêm vào giỏ hàng
                                </button>
                            @else
                                <button type="button" class="btn btn-primary btn-cart m-0" data-target="#cart-pop"
                                        data-toggle="modal">
                                    <a href="#" class="modal-view button" data-toggle="modal" data-target="#modalLoginForm">Đăng nhập</a>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- input hidden -->
    <input type="hidden" id="add_cart" value="{{ route('client.cart.add') }}">
    <input type="hidden" id="product_data" value="{{ json_encode($product_variant_data) }}">
    <input type="hidden" id="currentChoose" value="{{ ($product_variant_data[0]) }}">
    <input type="hidden" id="imageURL" value="{{ asset('DoAnTotNghiep/server/assets/images/product/') }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/client/assets/js/product_detail.js') }}"></script>

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
