<div class="table-responsive option_list">
    <table class="table table-striped" id="sortable-table-1">
        <thead>
        <tr>
            <th>#</th>
            <th class="sortStyle unsortStyle">Tên nhóm</th>
            <th class="sortStyle unsortStyle">Mã tùy chọn</th>
            <th class="sortStyle unsortStyle">Thời gian tạo</th>
            <th class="sortStyle unsortStyle">Thời gian cập nhật</th>
            <th class="sortStyle unsortStyle">Hành động thêm</th>
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
                    <button type="button" class="btn btn-outline-info btn-fw padding-action edit-option-group" data-id="{{ $option_data_item[0]['og_id'] }}" data-toggle="modal" data-target="#edit-option-group">Chỉnh sửa nhóm tùy chọn</button>
                    <label class="badge badge-warning @if ($option_data_item[0]['status'] !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_option_group_enabled" data-id="{{ $option_data_item[0]['og_id'] }}">Khả dụng</label>
                    <label class="badge badge-danger @if ($option_data_item[0]['status'] == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_option_group_disabled" data-id="{{ $option_data_item[0]['og_id'] }}">Không khả dụng</label>
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
                            <th class="sortStyle unsortStyle">Mã tùy chọn</th>
                            <th class="sortStyle unsortStyle">Tên tùy chọn</th>
                            <th class="sortStyle unsortStyle">Giá trị</th>
                            <th class="sortStyle unsortStyle">Giá tiền thêm</th>
                            <th class="sortStyle unsortStyle">Hành động thêm</th>
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
                                    Thêm
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-fw padding-action edit-option" data-id="{{ $option_data_item_item['id'] }}" data-name="{{ $option_data_item_item['name'] }}" data-value="{{ $option_data_item_item['value'] }}" data-bonus="{{ $option_data_item_item['bonus'] }}" data-toggle="modal" data-target="#edit-option">Chỉnh sửa tùy chọn</button>
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

