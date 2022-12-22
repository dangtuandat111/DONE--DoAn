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
                        <h4 class="card-title">Create new Option</h4>
                        <div class="forms-sample" data-route="{{ route('server.api.option.create') }}">
                            <div class="form-group">
                                <label for="optionName">Option name</label>
                                <input type="text" class="form-control" id="optionName" name="optionName" placeholder="Option name" required oninvalid="this.setCustomValidity('Messsage Error: Please enter valid option name')">
                            </div>
                            <div class="form-group">
                                <label for="optionGroupSelect">Option group</label>
                                <select name="optionGroupSelect" id="optionGroupSelect" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="-1" selected disabled hidden>Choose option group</option>
                                    @foreach($optionGroup as $optionGroupItem)
                                        <option value="{{ $optionGroupItem->id }}">{{ $optionGroupItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="optionValue">Option value</label>
                                <input type="text" class="form-control" id="optionValue" name="optionValue" placeholder="Option value" required oninvalid="this.setCustomValidity('Messsage Error: Please enter valid option value')">
                            </div>
                            <div class="form-group">
                                <label for="optionBonus">Option bonus cost</label>
                                <input type="number" class="form-control" id="optionBonus" name="optionBonus" placeholder="Option value" required>
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
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/option/create_option.js') }}"></script>
@endsection
