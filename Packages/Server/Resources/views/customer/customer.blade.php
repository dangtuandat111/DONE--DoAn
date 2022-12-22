@extends('server::base_layout')

@section('title', 'Customer page')

@section('more-css')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer List</h4>
                        <div class="filter-area col-12 col-md-12 col-sm-12">
                            <div class="form-group col-4 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Show</label>
                                <select
                                    name="order-listing_length" aria-controls="order-listing"
                                    class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="2" selected>2</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="-1">All</option>
                                </select>
                                <label class="mb-0 pl-2">entries</label>
                            </div>

                            <div class="form-group padding-r-15">
                                <div class="input-group">
                                    <input type="text" class="form-control border-radius-15" id="search_customer_name" placeholder="Search by name" name="search">
                                </div>
                            </div>

                            <div class="form-group" style="padding-right: 1rem">
                                <div class="input-group">
                                    <input type="text" class="form-control border-radius-15" id="search_customer_email" placeholder="Search by email" name="search">
                                </div>
                            </div>

                            <div class="form-group col-2 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Status</label>
                                <select
                                    name="search_customer_status" aria-controls="customer_status"
                                    class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="0" class="pr-1">Disabled</option>
                                    <option value="1" class="pr-1" selected>Enabled</option>
                                </select>
                            </div>

                            <div class="form-group d-flex">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="data-customer-table">
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
                                                <button type="button" class="btn btn-outline-info btn-fw padding-action reset-pass" data-id="{{ $customer_data_item->id }}">Reset password</button>
                                                <button type="button" class="btn btn-outline-info btn-fw padding-action force-login" data-id="{{ $customer_data_item->id }}">Forced login</button>
                                            </td>
                                            <?php $stt++ ?>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $customer_data->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $customer_data])  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="customerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            @include('server::customer.profile')
        </div>
    </div>
    <!-- content-wrapper ends -->

    <!-- input hidden -->
    <input type="hidden" id="update_status_customer" value="{{ route("server.api.customer.update") }}">
    <input type="hidden" id="search_customer" value="{{ route("server.api.customer.search") }}">
    <input type="hidden" id="get_customer_data" value="{{ route("server.api.customer.detail") }}">
    <input type="hidden" id="reset_pass_customer" value="{{ route("server.customer.edit.reset_pass") }}">
    <input type="hidden" id="logout_customer" value="{{ route("server.customer.edit.logout") }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/customer/customer.js') }}"></script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
            @endif
            @if (Session::has('success'))
            toastr.success('{{session('success')}}');
            @endif
        });
    </script>
@endsection
