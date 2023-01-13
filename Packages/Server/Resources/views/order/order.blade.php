@extends('server::base_layout')

@section('title', 'Order page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách đơn hàng</h4>
                        <div class="data-order-table">
                            <div class="table-responsive">
                                <td colspan="12">
                                    <table class="table table-striped" id="product-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="sortStyle unsortStyle">Mã đơn hàng</th>
                                            <th class="sortStyle unsortStyle">Tên khách hàng</th>
                                            <th class="sortStyle unsortStyle">Tổng hóa đơn</th>
                                            <th class="sortStyle unsortStyle">Thời gian tạo</th>
                                            <th class="sortStyle unsortStyle">Địa chỉ liên lạc</th>
                                            <th class="sortStyle unsortStyle">Số điện thoại liên lạc</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $stt = 1 ?>
                                        @foreach ($order_list as $key => $order)
                                            <tr data-id="{{ $order->id }}">
                                                <td>{{ $stt }}</td>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $customer_name[$key] }}</td>
                                                <td>{{ $order->total }}$</td>
                                                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ $order->phone_number }}</td>
                                            </tr>
                                            <?php $stt++ ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </div>

                        </div>

                        @if($order_list instanceof Illuminate\Pagination\LengthAwarePaginator)
                            {{ $order_list->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $order_list])  }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="orderTable" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-header flex-row-reverse ">
                            <h4 class="modal-title">
                                <div style="float:right">Chi tiết hóa đơn</div><br>
                            </h4>
                        </div>
                        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default close-button" style="text-align:right" data-dismiss="modal">Trở lại trang</button>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- input hidden -->
    <input type="hidden" id="order_detail_list" value="{{ route('server.order.detail') }}"
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/order/order.js') }}"></script>
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
