<div class="table-responsive account_list">
    <table class="table table-striped" id="sortable-table-1">
        <thead>
        <tr>
            <th class="pr-0">STT</th>
            <th class="sortStyle unsortStyle">Name<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Image</th>
            <th class="sortStyle unsortStyle pr-0">Email<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Phone number<i class="ti-angle-down"></i></th>
            <th class="sortStyle unsortStyle">Status</th>
            <th class="sortStyle unsortStyle">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt = 1 ?>
        @foreach ($user_data as $user_data_item)
            <tr>
                <td class="pr-0">{{ $stt }}</td>
                <td>{{ $user_data_item->name }}</td>
                <td class="py-1 image">
                    <img src="@if ($user_data_item->img) {{ asset($user_data_item->img) }} @else {{ asset('DoAnTotNghiep/server/assets/images/admin_default.png') }} @endif" alt="image">
                </td>
                <td class="pr-0">{{ $user_data_item->email }}</td>
                <td class="mw-100px wrap-content">{{ $user_data_item->phone_number }}</td>
                <td>
                    <label class="badge badge-warning @if ($user_data_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $user_data_item->id }}">Enabled</label>
                    <label class="badge badge-danger @if ($user_data_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $user_data_item->id }}">Disabled</label>
                </td>
                <td>
                    <label class="badge badge-info @if ($user_data_item->role == 1) disabled @endif update_admin_role" data-id="{{ $user_data_item->id }}">
                        @if ($user_data_item->role == 0)
                            Employee / Promote
                        @else
                            Admin
                        @endif
                    </label>
                </td>
                <?php $stt++ ?>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $user_data->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $user_data])  }}

