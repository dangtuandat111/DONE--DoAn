<div class="table-responsive">
    <td colspan="12">
        <table class="table table-striped" id="product-table">
            <thead>
            <tr>
                <th>#</th>
                <th class="sortStyle unsortStyle">Tên sản phẩm</th>
                <th class="sortStyle unsortStyle">Tên slug</th>
                <th class="sortStyle unsortStyle">Giá tiền</th>
                <th class="sortStyle unsortStyle">Thời gian tạo</th>
                <th class="sortStyle unsortStyle">Thời gian cập nhật</th>
                <th class="sortStyle unsortStyle">Tình trạng</th>
                <th class="sortStyle unsortStyle">Thông tin thêm</th>
                <th class="sortStyle unsortStyle">Hành động thêm</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1 ?>
            @foreach ($product_data as $product_data_item)
                <tr data-id="{{ $product_data_item['id'] }}">
                    <td>{{ $stt }}</td>
                    <td>{{ $product_data_item['name'] }}</td>
                    <td>{{ $product_data_item['slug'] }}</td>
                    <td>{{ $product_data_item['price'] }}$</td>
                    <td>{{ $product_data_item['c_at'] }}</td>
                    <td>{{ $product_data_item['u_at'] }}</td>
                    <td>{{ $product_data_item['status'] ? 'Khả dụng' : 'Không khả dụng' }}</td>
                    <td>
                        <button class="add btn btn-icon text-primary expand-button bg-transparent align-content-center" data-id="{{ $product_data_item['id'] }}"><i
                                class="icon-circle-plus" data-id="{{ $product_data_item['id'] }}"></i></button>
                    </td>
                    <td>
                        <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.product.edit', ['id' => $product_data_item['id']]) }}">Chỉnh sửa</a>
                    </td>
                </tr>
                <tr class="product_detail expandable-table d-none" data-id="{{ $product_data_item['id'] }}">
                    <td colspan="12">
                        <div>
                            <div class="d-flex justify-content-between">
                                <div class="cell-hilighted">
                                    <div class="d-flex mb-2">
                                        <div class="me-2 min-width-cell">
                                            <p>Thời gian tạo</p>
                                            <h6>
                                                {{ $product_data_item->c_at }}
                                            </h6>
                                        </div>
                                        <div class="min-width-cell">
                                            <p>Thời gian cập nhật</p>
                                            <h6>
                                                {{ $product_data_item->u_at }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <div class="me-2 min-width-cell">
                                            <p>Thời gian khuyến mại</p>
                                            <h6>
                                                {{ $product_data_item->s_at }}
                                            </h6>
                                        </div>
                                        <div class="min-width-cell">
                                            <p>Thời gian hết khuyến mãi</p>
                                            <h6>
                                                {{ $product_data_item->e_at }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="expanded-table-normal-cell">
                                    <div class="me-2 mb-4"><p>Giảm giá (%)</p><h6>{{ $product_data_item['discount'] }}</h6></div>
                                </div>
                                <div class="expanded-table-normal-cell">
                                    <div class="me-2 mb-4">
                                        <ul class="two-column-order-list">
                                            {!! $product_data_item['feature_list'] !!}
                                        </ul>
                                    </div>
                                </div>
                                <div class="expanded-table-normal-cell">
                                    <div class="me-2 mb-4"><p>Tên nhãn hàng</p><h6>{{ $product_data_item['brand_name'] }}</h6></div>
                                    <div class="me-2"><p>Tên slug nhãn hàng</p><h6>{{ $product_data_item['brand_slug'] }}</h6></div>
                                </div>
                                <div class="expanded-table-normal-cell">
                                    <div class="me-2 mb-4"><p>Tên loại giày</p><h6>{{ $product_data_item['category_name'] }}</h6></div>
                                    <div class="me-2"><p>Tên slug loại giày</p><h6>{{ $product_data_item['category_slug'] }}</h6></div>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
                <?php $stt++ ?>
            @endforeach
            </tbody>
        </table>

        @if($product_data instanceof Illuminate\Pagination\LengthAwarePaginator)
            {{ $product_data->onEachSide(1)->links('server::layouts.paginate', ['data_pagination' => $product_data])  }}
        @endif
    </td>
</div>
