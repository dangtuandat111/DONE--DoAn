@if (!empty($product_data) && count($product_data) >= 1)
    @foreach($product_data as $key => $product_item)
        @if (($key + 1) % 3 == 1)
            <div class="row">
        @endif
                <div class="product-layouts col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="product-thumb">
                        <div class="image zoom">
                            <a href="{{ route('client.product.detail') }}">
                                <img src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $product_item->thumbnail) }}" alt=""/>
                                <img src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $product_item->thumbnail) }}"
                                     alt="04" class="second_image img-responsive">
                            </a>
                        </div>
                        <div class="thumb-description" style="background-color: rgba(0,0,0,.25); top: 20px; height: 70% !important;">
                            <div class="caption">
                                <h4 class="product-title text-capitalize">
                                    <a href="{{ route('client.product.detail', ['product-slug' => $product_item->slug]) }}">
                                        <span>Xem chi tiết sản phẩm</span>
                                    </a>
                                </h4>
                            </div>

                            <div class="price">
                                <div class="product_price text-dark bg-white">{{ $product_item->price }}$</div>
                            </div>
                            <div class="button-wrapper">
                                <div class="button-group text-center">
                                    <button type="button" class="btn btn-primary btn-cart"
                                            data-target="#cart-pop" data-toggle="modal" style="opacity: 1"
                                            onclick="$(this).closest('.thumb-description').find('.product-title span').trigger('click')">
                                        <i class="material-icons">shopping_cart</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">{{ $product_item->name }}</div>
                    </div>
                </div>
        @if (($key + 1) % 3 == 0)
            </div>
        @endif
    @endforeach


    @if($product_data instanceof Illuminate\Pagination\LengthAwarePaginator)
        {{ $product_data->onEachSide(2)->links('client::paginate', ['data_pagination' => $product_data])  }}
    @endif
@else
    <h2 class="category-description">
        Không có sản phẩm nào phù hợp. Hãy quay lại sau.
    </h2>
@endif
