<div class="table-responsive">
    <td colspan="12">
        <table class="table table-striped" id="product-table">
            <thead>
            <tr>
                <th>#</th>
                <th class="sortStyle unsortStyle">Tên sản phẩm</th>
                <th class="sortStyle unsortStyle">Số lượng đã bán</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1 ?>
            @foreach ($sellData as $key => $data_item)
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $data_item->name }}</td>
                    <td>{{ $data_item->scount }}</td>
                </tr>
                <?php $stt++ ?>
            @endforeach
            </tbody>
        </table>
    </td>
</div>
@if($sellData instanceof Illuminate\Pagination\LengthAwarePaginator)
    {{ $sellData->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $sellData])  }}
@endif
