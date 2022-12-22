@extends('server::base_layout')

@section('title', 'Create brand page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create new User</h4>
                        <form class="forms-sample" method="post" action="{{ route('server.account.create.post') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">User name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="User name" required oninvalid="this.setCustomValidity('Messsage Error: Please enter valid user name')">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" required maxlength="8">
                            </div>
                            <div class="form-group">
                                <label for="status">Role</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="0">Enabled</option>
                                    <option value="1">Disabled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role" name="role" class="form-control">
                                    <option value="0">Employee</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a class="btn btn-light" href="{{ route('server.account.get') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/user/user.js') }}"></script>
    <script src="{{ asset('DoAnTotNghiep/server/js/file-upload.js') }}"></script>

    "></script>
@endsection
