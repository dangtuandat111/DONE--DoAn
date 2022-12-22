@extends('server::base_layout')

@section('title', 'Edit category page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Category</h4>
                        <form class="forms-sample" method="post" action="{{ route('server.category.edit.post') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Brand name" value="{{ $category_data->name }}" required oninvalid="this.setCustomValidity('Messsage Error: Please enter valid category name')">
                            </div>
                            <input type="hidden" name="slug" value="{{ $slug }}">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"> {{ $category_data->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a class="btn btn-light" href="{{ route('server.category.get') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/category/category.js') }}"></script>
@endsection
