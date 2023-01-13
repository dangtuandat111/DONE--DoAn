@extends('server::base_layout')

@section('title', 'Account page')

@section('more-css')
{{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách tài khoản</h4>
                        <div class="new-action float-right" style="padding-top: 13px; margin-bottom: 1.5rem;">
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.account.create.get') }}">Thêm tài khoản mới</a>
                        </div>
                        <div class="form-group float-right" style="padding-right: 1rem">
                            <div class="input-group">
                                <input type="text" class="form-control border-radius-15" id="search_account_name" placeholder="Tìm kiếm theo tên" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-4 padding-r-15 d-flex align-items-center">
                            <label class="mb-0 pr-2">Hiển thị</label>
                            <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                <option value="2" selected="">2</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="-1">Tất cả</option>
                            </select>
                            <label class="mb-0 pl-2"> / trang</label>
                        </div>
                        <div class=""
                        <div class="table-responsive account_list">
                            <table class="table table-striped" id="sortable-table-1">
                                <thead>
                                <tr>
                                    <th class="pr-0">#</th>
                                    <th class="sortStyle unsortStyle">Tên tài khoản<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle unsortStyle">Ảnh đại diện</th>
                                    <th class="sortStyle unsortStyle pr-0">Địa chỉ email<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle unsortStyle">Số điện thoại<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle unsortStyle">Tình trạng</th>
                                    <th class="sortStyle unsortStyle">Hành động thêm</th>
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
                                            <button class="badge badge-warning border-0 @if ($user_data_item->status !== 'Enabled') btn btn-light btn-rounded disabled @endif update_status_enabled" data-id="{{ $user_data_item->id }}">Khả dụng</button>
                                            <button class="badge badge-danger border-0 @if ($user_data_item->status == 'Enabled') btn btn-light btn-rounded disabled @endif update_status_disabled" data-id="{{ $user_data_item->id }}">Không khả dụng</button>
                                        </td>
                                        <td>
                                            <button class="badge badge-info btn btn-primary border-0 @if ($user_data_item->role == 1) disabled @endif update_admin_role" data-id="{{ $user_data_item->id }}" data-toggle="modal" data-target="#js-panel">
                                                @if ($user_data_item->role == 0)
                                                    Nhân viên / Cấp quyền
                                                @else
                                                    Admin
                                                @endif
                                            </button>
                                        </td>
                                        <?php $stt++ ?>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $user_data->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $user_data])  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <div class="confirm-popup">
        <!-- Modal -->
        <div class="modal fade" id="js-panel" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title f-20px">Confirm Upgrade User</h5>
                    </div>
                    <div class="modal-body">
                        Could you let me know if you are sure to upgrade this user's role?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary confirm-save" data-id="-1">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- input hidden -->
    <input type="hidden" id="update_status_account" value="{{ route("server.api.user.update") }}">
    <input type="hidden" id="search_account" value="{{ route("server.api.user.search") }}">
    <input type="hidden" id="upgrade_account" value="{{ route("server.api.user.upgrade") }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/user/user.js') }}"></script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
            @endif
        });
    </script>
@endsection
