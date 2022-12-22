<table class="table table-striped" id="sortable-table-1">
    <thead>
    <tr>
        <th>STT</th>
        {{--                                    <th>Name</th>--}}
        <th class="sortStyle unsortStyle">Name<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Image</th>
        <th class="sortStyle unsortStyle">Description</th>
        <th class="sortStyle unsortStyle">Create at<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Status</th>
        <th class="sortStyle unsortStyle">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php $stt = 1 ?>
    @foreach ($brand_data as $brand_data_item)
        <tr>
            <td>{{ $stt }}</td>
            <td>{{ $brand_data_item->name }}</td>
            <td class="py-1 image">
                <img class="@if (!$brand_data_item->thumbnail) d-none @endif" src="{{ asset($brand_data_item->thumbnail) }}" alt="image">
            </td>
            <td class="mw-100px wrap-content">{{ $brand_data_item->description }}</td>
            <td>{{ $brand_data_item->c_at }}</td>
            <td>
                <label class="badge badge-warning @if ($brand_data_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $brand_data_item->id }}">Enabled</label>
                <label class="badge badge-danger @if ($brand_data_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $brand_data_item->id }}">Disabled</label>
            </td>
            <td>
                <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.brand.edit.get', ['slug' => $brand_data_item->slug]) }}">Edit {{ $brand_data_item->name }}</a>
            </td>
            <?php $stt++ ?>
        </tr>
    @endforeach
    </tbody>
</table>
