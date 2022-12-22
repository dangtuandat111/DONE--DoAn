@extends('server::base_layout')

@section('title', 'Customer page')

@section('more-css')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <img
                                        src="@if (isset($admin_data) && isset($admin_data->avatar)) {{ asset($admin_data->avatar) }} @else {{ asset('DoAnTotNghiep/server/assets/images/admin_default.png') }} @endif"
                                        alt="profile" class="img-lg rounded-circle mb-3">
                                    <div class="mb-3">
                                        <h3></h3>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted">{{ $admin_data->name }}</h5>
                                        </div>
                                    </div>
                                    <p class="w-75 mx-auto mb-3">
                                        @if (isset($admin_data) && isset($admin_data->role) && $admin_data->role == 1)
                                            This account has admin permissions
                                        @else
                                            This account has employee permissions
                                        @endif
                                    </p>
                                </div>
                                <div class="py-4">
                                    <p class="clearfix">
                                        <span class="float-left">Status</span>
                                        <span class="float-right text-muted">Enabled</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Phone
                                        </span>
                                        <span class="float-right text-muted">{{ $admin_data->phone_number }}</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Email
                                        </span>
                                        <span class="float-right text-muted">{{ $admin_data->email }}</span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                        Created at
                                        </span>
                                        <span class="float-right text-muted">
                                            <span>{{ $admin_data->created_at }}</span>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Updated at
                                        </span>
                                        <span class="float-right text-muted">
                                            <span>{{ $admin_data->updated_at }}</span>
                                        </span>
                                    </p>
                                </div>
                                <button class="btn btn-primary btn-block mb-2">Change avatar</button>
                            </div>
                            <div class="col-lg-8">
                                <div class="mt-4 py-2 border-top border-bottom" role="tablist">
                                    <ul class="nav nav-tabs profile-navbar">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="nav-history-tab" data-target="#nav-history">
                                                <i class="ti-user"></i>
                                                History
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="nav-profile-tab" data-target="#nav-profile">
                                                <i class="ti-calendar"></i>
                                                Edit Profile
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <div class="tab-pane fade show active" id="nav-history" >
                                        @foreach($user_history_data as $user_history_data_item)
                                            <div class="d-flex align-items-start profile-feed-item">
                                                <div class="ms-4">
                                                    <h6>
                                                        <small class="ms-4 text-muted">
                                                            <i class="ti-time me-1"></i> {{ $user_history_data_item->ago }}
                                                        </small>
                                                    </h6>
                                                    <p>
                                                        <strong>{{ $admin_data->name }}</strong> is logged in
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="col-12 col-sm-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Profile</h4>
                                                    <p class="card-description">
                                                        Edit Profile
                                                    </p>
                                                    <form id="editProfileForm" class="forms-sample" method="post">
                                                        @csrf
                                                        <input type="hidden" class="form-control" id="user_id" value="{{ $admin_data->id }}">
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="name" placeholder="Username" value="{{ $admin_data->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                            <div class="col-sm-9">
                                                                <input type="email" class="form-control" id="email" placeholder="Email" value="{{ $admin_data->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="phone_number" class="col-sm-3 col-form-label">Mobile</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="phone_number" placeholder="Phone number" value="{{ $admin_data->phone_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" class="form-control" id="password" placeholder="Password" maxlength="8">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="password_confirm" class="col-sm-3 col-form-label">Re Password</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" class="form-control" id="password_confirm" placeholder="Password Confirm" maxlength="8">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary me-2">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- input hidden -->
    <input type="hidden" id="update_profile" value="{{ route('server.api.profile.update') }}">
@endsection


@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/profiler/profiler.js') }}"></script>
    <script>
        $(document).ready(function () {
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
