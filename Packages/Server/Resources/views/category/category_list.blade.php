<table class="table table-striped" id="sortable-table-1">
    <thead>
    <tr>
        <th>#</th>
        <th class="sortStyle unsortStyle">Tên loại giày<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Mô tả</th>
        <th class="sortStyle unsortStyle">Thời gian tạo<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Thời gian cập nhật<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Tình trạng</th>
        <th class="sortStyle unsortStyle">Hành động thêm</th>
    </tr>
    </thead>
    <tbody>
    <?php $stt = 1 ?>
    @foreach ($category_data as $category_date_item)
        <tr>
            <td>{{ $stt }}</td>
            <td>{{ $category_date_item->name }}</td>
            <td class="mw-100px wrap-content">{{ $category_date_item->description }}</td>
            <td>{{ $category_date_item->c_at }}</td>
            <td>{{ $category_date_item->u_at }}</td>
            <td>
                <label class="badge badge-warning @if ($category_date_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $category_date_item->id }}">Khả dụng</label>
                <label class="badge badge-danger @if ($category_date_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $category_date_item->id }}">Không khả dụng</label>
            </td>
            <td>
                <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.category.edit.get', ['slug' => $category_date_item->slug]) }}">Chỉnh sửa {{ $category_date_item->name }}</a>
            </td>
            <?php $stt++ ?>
        </tr>
    @endforeach
    </tbody>
</table>
