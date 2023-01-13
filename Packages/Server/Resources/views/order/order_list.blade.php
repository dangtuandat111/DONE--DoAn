

<div class="table-responsive">
    <td colspan="12">
        <table class="table table-striped" id="product-table">
            <thead>
            <tr>
                <th>#</th>
                <th class="sortStyle unsortStyle">Mã đơn hàng</th>
                <th class="sortStyle unsortStyle">Tên sản phẩm</th>
                <th class="sortStyle unsortStyle px-1">Số lượng</th>
                <th class="sortStyle unsortStyle">Giá tiền</th>
                <th class="sortStyle unsortStyle">Tổng</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1 ?>
            @foreach ($order_detail_list as $key => $order_detail_list_item)
                <tr data-id="{{ $order_detail_list_item->id }}">
                    <td style="width: 10px;">{{ $stt }}</td>
                    <td style="width: 20px;">{{ $order_detail_list_item->id_order }}</td>
                    <td>{{ $product_name[$key] }}</td>
                    <td class="px-1" style="width: 10px;">{{ $order_detail_list_item->count }}</td>
                    <td>{{ $order_detail_list_item->price }}</td>
                    <td>{{ $order_detail_list_item->count *  $order_detail_list_item->price}}</td>
                </tr>
                <?php $stt++ ?>
            @endforeach
            </tbody>
        </table>

        @if($order_detail_list instanceof Illuminate\Pagination\LengthAwarePaginator)
            {{ $order_detail_list->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $order_detail_list])  }}
        @endif
    </td>
</div>
