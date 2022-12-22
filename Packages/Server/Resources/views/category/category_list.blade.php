<table class="table table-striped" id="sortable-table-1">
    <thead>
    <tr>
        <th>STT</th>
        <th class="sortStyle unsortStyle">Name<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Description</th>
        <th class="sortStyle unsortStyle">Created at<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Updated at<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Status</th>
        <th class="sortStyle unsortStyle">Action</th>
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
                <label class="badge badge-warning @if ($category_date_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $category_date_item->id }}">Enabled</label>
                <label class="badge badge-danger @if ($category_date_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $category_date_item->id }}">Disabled</label>
            </td>
            <td>
                <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.category.edit.get', ['slug' => $category_date_item->slug]) }}">Edit {{ $category_date_item->name }}</a>
            </td>
            <?php $stt++ ?>
        </tr>
    @endforeach
    </tbody>
</table>
