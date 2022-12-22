<div class="table-responsive option_list">
    <table class="table table-striped" id="sortable-table-1">
        <thead>
        <tr>
            <th>STT</th>
            <th class="sortStyle unsortStyle">Name group</th>
            <th class="sortStyle unsortStyle">Id option</th>
            <th class="sortStyle unsortStyle">Created at</th>
            <th class="sortStyle unsortStyle">Updated at</th>
            <th class="sortStyle unsortStyle">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt = 1 ?>
        @foreach ($option_extra_data as $option_data_item)
            <tr>
                <td>{{ $stt }}</td>
                <td class="og_name">{{ $option_data_item[0]['og_name'] }}</td>
                <td>{{ $option_data_item[0]['og_id'] }}</td>
                <td>{{ $option_data_item[0]['c_at'] }}</td>
                <td>{{ $option_data_item[0]['u_at'] }}</td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-fw padding-action edit-option-group" data-id="{{ $option_data_item[0]['og_id'] }}" data-toggle="modal" data-target="#edit-option-group">Edit option group</button>
                    <label class="badge badge-warning @if ($option_data_item[0]['status'] !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_option_group_enabled" data-id="{{ $option_data_item[0]['og_id'] }}">Enabled</label>
                    <label class="badge badge-danger @if ($option_data_item[0]['status'] == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_option_group_disabled" data-id="{{ $option_data_item[0]['og_id'] }}">Disabled</label>
                </td>
                <td class="details-control" data-element-id="#{{ 'option_data_item_class_table-' . $stt }}">
                </td>
            </tr>
            <tr class="d-none" id="{{ 'option_data_item_class_table-' . $stt }}">
                <td colspan="12">
                    <table class="table table-striped" id="sortable-table-{{ $stt + 1 }}">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th class="sortStyle unsortStyle">Id option</th>
                            <th class="sortStyle unsortStyle">Name option</th>
                            <th class="sortStyle unsortStyle">Option value</th>
                            <th class="sortStyle unsortStyle">Bonus cost</th>
                            <th class="sortStyle unsortStyle">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $stt2 = 1 ?>
                        @foreach ($option_data_item as $option_data_item_item)
                            <tr>
                                <td>{{ $stt2 }}</td>
                                <td>{{ $option_data_item_item['id']}}</td>
                                <td class="option_name">{{ $option_data_item_item['name'] }}</td>
                                <td class="option_value">{{ $option_data_item_item['value']  }}</td>{{ ' ' . $option_data_item_item['og_note'] }}
                                <td class="option_bonus">{{ $option_data_item_item['bonus'] }}</td>
                                <td class="d-none">
                                    blah
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-fw padding-action edit-option" data-id="{{ $option_data_item_item['id'] }}" data-name="{{ $option_data_item_item['name'] }}" data-value="{{ $option_data_item_item['value'] }}" data-bonus="{{ $option_data_item_item['bonus'] }}" data-toggle="modal" data-target="#edit-option">Edit option</button>
                                </td>
                                <?php $stt2++ ?>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <?php $stt++ ?>
        @endforeach
        </tbody>
    </table>
</div>

@if($option_data instanceof Illuminate\Pagination\LengthAwarePaginator)
    {{ $option_data->onEachSide(1)->links('server::layouts.paginate', ['data_pagination' => $option_data])  }}
@endif

