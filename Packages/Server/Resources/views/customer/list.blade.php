<div class="table-responsive customer_list">
    <table class="table table-striped" id="sortable-table-1">
        <thead>
        <tr>
            <th>#</th>
            <th class="sortStyle unsortStyle">Tên người dùng<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Địa chỉ email<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Thời gian tạo<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Thời gian cập nhật<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Tình trạng</th>
            <th class="sortStyle unsortStyle">Hành động thêm</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt = 1 ?>
        @foreach ($customer_data as $customer_data_item)
            <tr data-id="{{ $customer_data_item->id }}">
                <td>{{ $stt }}</td>
                <td>{{ $customer_data_item->name }}</td>
                <td>{{ $customer_data_item->email }}</td>
                <td>{{ $customer_data_item->c_at }}</td>
                <td>{{ $customer_data_item->u_at }}</td>
                <td>
                    <label class="badge badge-warning @if ($customer_data_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $customer_data_item->id }}">Khả dụng</label>
                    <label class="badge badge-danger @if ($customer_data_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $customer_data_item->id }}">Không khả dụng</label>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-fw padding-action reset-pass" data-id="{{ $customer_data_item->id }}">Cập nhật mật khẩu</button>
                    <button type="button" class="btn btn-outline-info btn-fw padding-action force-login" data-id="{{ $customer_data_item->id }}">Bắt buộc đăng nhập lại</button>
                </td>
                <?php $stt++ ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $customer_data->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $customer_data])  }}
