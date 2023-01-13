@extends('client::layouts.master')

@section('title', 'Cart page')

@section('more-css')
@endsection

@section('content')
    <ol class="breadcrumb parallax justify-content-center"
        data-source-url="{{ asset('DoAnTotNghiep/client/img/banner/parallax.jpg') }}"
        style="background-image: url({{ asset('DoAnTotNghiep/client/img/banner/parallax.jpg') }}); background-position: 50% 47.957%;">
    </ol>
    <!-- content-wrapper ends -->
    <div class="cart-area table-area pt-110 pb-95 float-left w-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 float-left cart-wrapper">
                    <div class="table-responsive">
                        <table class="table product-table text-center">
                            <thead>
                            <tr>
                                <th class="table-remove text-capitalize">Loại bỏ</th>
                                <th class="table-image text-capitalize">Hình ảnh</th>
                                <th class="table-p-name text-capitalize">Tên sản phẩm</th>
                                <th class="table-p-price text-capitalize">Giá cả</th>
                                <th class="table-p-price text-capitalize">Thông tin</th>
                                <th class="table-p-qty text-capitalize">Số lượng</th>
                                <th class="table-total text-capitalize">Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0 ?>
                            @foreach($cart_item as $item)
                            <tr data-id="{{ $item->id_product_variant }}">
                                <td class="table-remove" data-toggle="modal" data-target="#deleteModal"><button><i class="material-icons">delete</i></button></td>
                                <td class="table-image">
                                    <a href="{{ route('client.product.detail', ['product-slug' => $item->slug]) }}">
                                        <img src="{{ asset('DoAnTotNghiep/server/assets/images/product/' . $item->img) }}" alt="">
                                    </a>
                                </td>
                                <td class="table-p-name text-capitalize">
                                    <a href="{{ route('client.product.detail', ['product-slug' => $item->slug]) }}">
                                        {{ $item->name }}
                                    </a>
                                </td>
                                <td class="table-p-price"><p>{{ $item->price }}</p></td>
                                <td class="table-p-price"><p>{{ $item->color . '/' . $item->size . '/' . $item->width }}</p></td>
                                <td class="table-p-qty"><input value="{{ $item->count }}" name="cart-qty" type="number" step="1" min="1"></td>
                                <td class="table-total"><p>{{ $item->price * $item->count }}</p></td>
                            </tr>
                            <tr>
                                <?php $total = $item->total ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-total-wrapper d-flex justify-content-end pt-60 col-md-12 col-sm-12 col-lg-4 float-left  align-items-center">
                    <div class="table-total-content">
                        <h2 class="pb-20 border-0">Tổng giỏ hàng</h2>
                        <div class="table-total-amount">
                            <div class="single-total-content tt-total d-flex justify-content-between float-left w-100">
                                <strong>Tổng tiền</strong>
                                <span class="c-total-price">{{ $total }}</span>
                            </div>
                            <a href="@if ($total > 0) {{ route('client.checkout') }} @endif" class="btn btn-primary float-left w-100 text-center">Thực hiện thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm khỏi giỏ hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn thực sự muốn xóa sản phẩm khỏi giỏ hàng
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-save" onclick="$('#deleteModal').modal('hide');">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
    <!-- input hidden -->
    <input type="hidden" id="update_cart" value="{{ route('client.cart.update') }}">
    <input type="hidden" id="delete_cart" value="{{ route('client.cart.delete') }}">
    <input type="hidden" id="post_checkout" value="{{ route('client.checkout.post') }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/client/assets/js/cart.js') }}"></script>

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
