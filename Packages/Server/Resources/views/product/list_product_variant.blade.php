

<div class="table-responsive">
    <td colspan="12">
        <table class="table table-striped" id="product-table">
            <thead>
            <tr>
                <th>#</th>
                <th class="sortStyle unsortStyle">Tên biến thể sản phẩm</th>
                <th class="sortStyle unsortStyle">Số lượng</th>
                <th class="sortStyle unsortStyle">Ảnh</th>
                <th class="sortStyle unsortStyle">Thời gian cập nhật</th>
                <th class="sortStyle unsortStyle">Thời gian tọa</th>
                <th class="sortStyle unsortStyle">Kích cỡ</th>
                <th class="sortStyle unsortStyle">Hành động thêm</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1 ?>
            @foreach ($product_variant_data as $product_variant_data_item)
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $product_data[0]->name }}</td>
                    <td>{{ $product_variant_data_item->count }}</td>
                    <td>
                        @if ($product_variant_data_item->thumbnail || $product_variant_data_item->thumbnail == 'product_default.png')
                            <img src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $product_data[0]->thumbnail) }}">
                        @else
                            <img src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $product_variant_data_item->thumbnail) }}">
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($product_variant_data_item->updated_at)->format('d-m-Y')}}</td>
                    <td>{{ \Carbon\Carbon::parse($product_variant_data_item->created_at)->format('d-m-Y')}}</td>
                    <td>{{ $product_variant_size[$stt - 1]->value }}</td>
                    <td>
                        <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.product.variant.edit', ['id' => $product_variant_data_item->id]) }}">Chỉnh sửa</a>
                    </td>
                </tr>
                <?php $stt++ ?>
            @endforeach
            </tbody>
        </table>

        @if($product_variant_data instanceof Illuminate\Pagination\LengthAwarePaginator)
            {{ $product_variant_data->onEachSide(1)->links('server::layouts.paginate', ['data_pagination' => $product_variant_data])  }}
        @endif
    </td>
</div>
