@extends('server::base_layout')

@section('title', 'Option page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Option List</h4>
                        <div class="new-action float-right" style="padding-top: 13px; margin-bottom: 1.5rem;">
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.option.create.get') }}">Create new Option</a>
                            <a type="button" class="btn btn-outline-info btn-fw padding-action" href="{{ route('server.option.group.create.get') }}">Create new Option Group</a>
                        </div>
                        <div class="filter-area col-12 col-md-12 col-sm-12 pl-0">
                            <div class="form-group col-4 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Show</label>
                                <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="2">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="-1" selected>All</option>
                                </select>
                                <label class="mb-0 pl-2">entries</label>
                            </div>

                            <div class="form-group col-4 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Select option group</label>
                                <select name="filter_search_group" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    @foreach($option_group as $option_group_item)
                                        <option value="{{ $option_group_item->id }}">{{ $option_group_item->name }}</option>
                                    @endforeach
                                    <option value="-1" selected>All</option>
                                </select>
                            </div>

                            <div class="form-group padding-r-15">
                                <div class="input-group">
                                    <input type="text" class="form-control border-radius-15" id="search_option_value" placeholder="Search by option value" name="search">
                                </div>
                            </div>

                            <div class="form-group d-flex">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="data-option-table">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("server::option.edit_option_group")
    @include("server::option.edit_option")
    <!-- content-wrapper ends -->

    <!-- input hidden -->
    <input type="hidden" id="search_option" value="{{ route("server.api.option.search") }}">
    <input type="hidden" id="update_option_group" value="{{ route("server.api.option.group.update") }}">
    <input type="hidden" id="update_status_option_group" value="{{ route("server.api.option.group.status") }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/option/option.js') }}"></script>
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
