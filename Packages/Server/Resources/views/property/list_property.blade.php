<td colspan="12">
    <table class="table table-striped" id="property-table-{{ $property_data[0]['id_property_group'] }}">
        <thead>
        <tr>
            <th>STT</th>
            <th class="sortStyle unsortStyle">Tên thuộc tính</th>
            <th class="sortStyle unsortStyle">Giá trị</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt = 1 ?>
        @foreach ($property_data as $property_data_item)
            <tr>
                <td>{{ $stt }}</td>
                <td>{{ $property_data_item['name'] }}</td>
                <td>{{ $property_data_item['value'] }}</td>
            </tr>
            <tr class="property-table d-none"></tr>
            <?php $stt++ ?>
        @endforeach
        </tbody>
    </table>

    @if($property_data instanceof Illuminate\Pagination\LengthAwarePaginator)
        {{ $property_data->onEachSide(1)->links('server::layouts.paginate', ['data_pagination' => $property_data])  }}
    @endif
</td>
