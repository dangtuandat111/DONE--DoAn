

<div class="table-responsive">
    <td colspan="12">
        <table class="table table-striped" id="product-table">
            <thead>
            <tr>
                <th>STT</th>
                <th class="sortStyle unsortStyle">Product name</th>
                <th class="sortStyle unsortStyle">Count</th>
                <th class="sortStyle unsortStyle">Thumbnail</th>
                <th class="sortStyle unsortStyle">Updated at</th>
                <th class="sortStyle unsortStyle">Created at</th>
                <th class="sortStyle unsortStyle">Size</th>
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
                        <img src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $product_variant_data_item->thumbnail) }}"
                    </td>
                    <td>{{ $product_variant_data_item->updated_at }}</td>
                    <td>{{ $product_variant_data_item->created_at }}</td>
                    <td>{{ $product_variant_size[$stt - 1]->value }}</td>
{{--                    <td>--}}
{{--                        <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.product.variant.edit', ['id' => $product_variant_data_item->id]) }}">Edit</a>--}}
{{--                    </td>--}}
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
