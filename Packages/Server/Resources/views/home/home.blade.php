@extends('server::base_layout')

@section('title', 'Home page')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome {{ $admin_data->name }}</h3>
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white" type="button">
                                    <i class="mdi mdi-calendar"></i> Today: {{ date("F j, Y") }}
                                </button>
                                {{--                                <div class="dropdown-menu dropdown-menu-right .dropdown-toggle id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"" aria-labelledby="dropdownMenuDate2" >--}}
                                {{--                                    <a class="dropdown-item" href="#">January - March</a>--}}
                                {{--                                    <a class="dropdown-item" href="#">March - June</a>--}}
                                {{--                                    <a class="dropdown-item" href="#">June - August</a>--}}
                                {{--                                    <a class="dropdown-item" href="#">August - November</a>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('more-js')
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
