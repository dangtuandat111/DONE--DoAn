<div class="table-responsive customer_list">
    <table class="table table-striped" id="sortable-table-1">
        <thead>
        <tr>
            <th>STT</th>
            <th class="sortStyle unsortStyle">Name<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Email<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Created at<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Updated at<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Status</th>
            <th class="sortStyle unsortStyle">Action</th>
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
                    <label class="badge badge-warning @if ($customer_data_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $customer_data_item->id }}">Enabled</label>
                    <label class="badge badge-danger @if ($customer_data_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $customer_data_item->id }}">Disabled</label>
                </td>
                <td>
                    <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.customer.edit.reset_pass', ['id' => $customer_data_item->id]) }}">Reset password</a>
                    <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.customer.edit.logout', ['id' => $customer_data_item->id]) }}">Forced login</a>
                </td>
                <?php $stt++ ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $customer_data->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $customer_data])  }}
