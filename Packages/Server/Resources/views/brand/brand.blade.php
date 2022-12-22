@extends('server::base_layout')

@section('title', 'Brand page')

@section('more-css')
{{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Brand List</h4>
                        <div class="new-action float-right" style="padding-top: 13px; margin-bottom: 1.5rem;">
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.brand.create.get') }}">Create new brand</a>
                        </div>
                        <div class="form-group float-right" style="padding-right: 1rem">
                            <div class="input-group">
                                <input type="text" class="form-control border-radius-15" id="search_brand_name" placeholder="Search by name" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive brand_list">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->

    <!-- input hidden -->
    <input type="hidden" id="update_status_brand" value="{{ route("server.api.branch.update") }}">
    <input type="hidden" id="search_brand" value="{{ route("server.api.branch.search") }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/brand/brand.js') }}"></script>
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
