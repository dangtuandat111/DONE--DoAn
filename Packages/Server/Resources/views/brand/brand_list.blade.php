<table class="table table-striped" id="sortable-table-1">
    <thead>
    <tr>
        <th>STT</th>
        {{--                                    <th>Name</th>--}}
        <th class="sortStyle unsortStyle">Tên nhãn hàng<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Ảnh</th>
        <th class="sortStyle unsortStyle">Thông tin mô tả</th>
        <th class="sortStyle unsortStyle">Thời gian tạo<i class="ti-angle-down"></i></th>
        <th class="sortStyle unsortStyle">Tình trạng</th>
        <th class="sortStyle unsortStyle">Hành động thêm</th>
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
                <label class="badge badge-warning @if ($brand_data_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $brand_data_item->id }}">Khả dụng</label>
                <label class="badge badge-danger @if ($brand_data_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $brand_data_item->id }}">Không khả dụng</label>
            </td>
            <td>
                <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.brand.edit.get', ['slug' => $brand_data_item->slug]) }}">Chỉnh sửa {{ $brand_data_item->name }}</a>
            </td>
            <?php $stt++ ?>
        </tr>
    @endforeach
    </tbody>
</table>
