<div class="table-responsive property_group_list">
    <table class="table table-striped" id="sortable-table-1">
        <thead>
        <tr>
            <th>STT</th>
            <th class="sortStyle unsortStyle">Name group</th>
            <th class="sortStyle unsortStyle">Created at</th>
            <th class="sortStyle unsortStyle">Updated at</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt = 1 ?>
        @foreach ($property_group_data as $property_group_data_item)
            <tr>
                <td>{{ $stt }}</td>
                <td>{{ $property_group_data_item['name'] }}</td>
                <td>{{ $property_group_data_item['c_at'] }}</td>
                <td>{{ $property_group_data_item['u_at'] }}</td>
                <td class="details-control" data-id="{{ $property_group_data_item['id'] }}">
                </td>
            </tr>
            <tr class="property-table-{{ $property_group_data_item['id'] }} d-none">
            </tr>
            <?php $stt++ ?>
        @endforeach
        </tbody>
    </table>
</div>

@if($property_group_data instanceof Illuminate\Pagination\LengthAwarePaginator)
    {{ $property_group_data->onEachSide(1)->links('server::layouts.paginate', ['data_pagination' => $property_group_data])  }}
@endif

