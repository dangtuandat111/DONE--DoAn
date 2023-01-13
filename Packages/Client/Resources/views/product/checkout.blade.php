@extends('client::layouts.master')

@section('title', 'Checkout page')

@section('more-css')
@endsection

@section('content')
    <!-- content-wrapper ends -->
    <div class="checkout-inner float-left w-100">
        <div class="container">
            <div class="row">
                <div class="cart-block-left col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span>Thông tin đơn hàng</span>
                    </h4>
                    <div class="list-group mb-3">
                        <?php $total = 0 ?>
                        @foreach($cart_item as $item)
                        <div class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $item->name }} x {{ $item->count }}</h6>
                            </div>
                            <span class="text-muted">{{ $item->price * $item->count }}</span>
                            <?php $total = $total + $item->price * $item->count ?>
                        </div>
                        @endforeach
                        <div class="list-group-item d-flex justify-content-between">
                            <strong>Tổng cộng:</strong>
                            <strong>{{ $total }}$</strong>
                        </div>
                            @if ($total > 0)
                                <a id="checkoutButton" class="btn btn-primary btn-lg btn-primary">Thực hiện đặt hàng</a>
                            @else
                                <a id="noneButton" class="btn btn-primary btn-lg btn-primary">Thực hiện đặt hàng</a>
                            @endif
                    </div>
                </div>
                <div class="cart-block-right col-md-8 order-md-1">
                    <h4 class="mb-3">Thông tin chi tiết đơn hàng</h4>
                    <form class="needs-validation" novalidate="">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="firstName">Tên người đặt hàng<span class="required">*</span></label>
                                <input type="text" class="form-control" id="firstName" placeholder="" required="" disabled value="{{ $customer_data->name }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username">Thông tin liên lạc<span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" class="form-control" id="customer_email" placeholder="Địa chỉ email" required="" disabled value="{{ $customer_data->email }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Địa chỉ nhận hàng<span class="required">*</span> </label>
                            <input type="text" class="form-control" id="address" placeholder="Nhập số điện thoại" required="" value="{{ $customer_data->address }}">
                        </div>

                        <div class="mb-3">
                            <label for="phone_number">Số điện thoại<span class="required">*</span> </label>
                            <input type="text" class="form-control" id="phone_number" placeholder="Nhập số điện thoại" required="" value="{{ $customer_data->phone_number }}">
                        </div>

                        <hr class="mb-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="post_checkout" value="{{ route('client.checkout.post') }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/client/assets/js/checkout.js') }}"></script>

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


