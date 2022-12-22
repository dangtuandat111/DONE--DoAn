@extends('server::base_layout')

@section('title', 'Create option group page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create new Category</h4>
                        <div class="forms-sample" data-route="{{ route('server.api.option.group.create') }}">
                            <div class="form-group">
                                <label for="optionGroupName">Option group name</label>
                                <input type="text" class="form-control" id="optionGroupName" name="optionGroupName" placeholder="Option group name" required oninvalid="this.setCustomValidity('Messsage Error: Please enter valid option group name')">
                            </div>
                            <div class="form-group">
                                <label for="optionGroupStatus">Option group status</label>
                                <select name="optionGroupStatus" id="optionGroupStatus" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="0">Disabled</option>
                                    <option value="1" selected>Enabled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="optionGroupUnit">Option unit</label>
                                <input class="form-control" id="optionGroupUnit" name="optionGroupUnit" placeholder="Option group unit">
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit mr-2">Submit</button>
                            <a class="btn btn-light button-cancel" href="{{ route('server.option.get') }}"><span>Cancel</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/option/create_option_group.js') }}"></script>
@endsection
