<div class="table-responsive">
    <td colspan="12">
        <table class="table table-striped" id="product-table">
            <thead>
            <tr>
                <th>#</th>
                <th class="sortStyle unsortStyle">Tên sản phẩm</th>
                <th class="sortStyle unsortStyle">Doanh thu</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1 ?>
            @foreach ($data_list as $key => $data)
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->nsum }}</td>
                </tr>
                <?php $stt++ ?>
            @endforeach
            </tbody>
        </table>
    </td>
</div>
@if($data_list instanceof Illuminate\Pagination\LengthAwarePaginator)
    {{ $data_list->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $data_list])  }}
@endif
