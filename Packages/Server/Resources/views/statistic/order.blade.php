@extends('server::base_layout')

@section('title', 'Statistic page')

@section('more-css')
    {{--    <link rel="stylesheet" href="{{ asset('DoAnTotNghiep/server/style.css') }}">--}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thống kê doanh thu theo sản phẩm</h4>
                        <div class="filter-area col-12 col-md-12 col-sm-12 pl-0">
                            <div class="form-group col-4 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Hiển thị</label>
                                <select id="perPage" name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="1">1</option>
                                    <option value="2" selected>2</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                </select>
                                <label class="mb-0 pl-2"> / trang</label>
                            </div>

                            <div class="form-group col-3 padding-r-15 d-flex align-items-center">
                                <select id="month" name="search_month" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled="" selected="">Chọn tháng</option>
                                    <option value="1">Tháng 1</option>
                                    <option value="2">Tháng 2</option>
                                    <option value="3">Tháng 3</option>
                                    <option value="4">Tháng 4</option>
                                    <option value="5">Tháng 5</option>
                                    <option value="6">Tháng 6</option>
                                    <option value="7">Tháng 7</option>
                                    <option value="8">Tháng 8</option>
                                    <option value="9">Tháng 9</option>
                                    <option value="10">Tháng 10</option>
                                    <option value="11">Tháng 11</option>
                                    <option value="12">Tháng 12</option>
                                </select>
                            </div>

                            <div class="form-group col-3 padding-r-15 d-flex align-items-center">
                                <select id="year" name="search_year" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled="" selected="">Chọn năm</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>

                            <div class="form-group d-flex">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearch">Lọc</button>
                                </div>

                                <div class="input-group-append ml-3">
                                    <form method="post" action="{{ route('server.export.doanhthu') }}" class="h-100">
                                        @csrf
                                        <input type="hidden" name="month" id="export_month">
                                        <input type="hidden" name="year" id="export_year">
                                        <button class="btn btn-sm btn-primary px-4 h-100" type="submit" id="exportDoanhThu" style="background: white; color:#4B49AC">Xuất file</button>
                                    </form>
                                </div>
                                <div class="d-none route-export" data-route="{{ route('server.export.doanhthu') }}"></div>
                            </div>
                        </div>
                        <div class="data-order-table">
                            <div class="table-responsive">
                                <td colspan="12">
                                    <table class="table table-striped" id="product-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="sortStyle unsortStyle">Tên sản phẩm</th>
                                            <th class="sortStyle unsortStyle">Doanh thu</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $stt = 1 ?>
                                        @foreach ($data_list as $key => $data)
                                            <tr>
                                                <td>{{ $stt }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->nsum }}</td>
                                            </tr>
                                            <?php $stt++ ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </div>
                            @if($data_list instanceof Illuminate\Pagination\LengthAwarePaginator)
                                {{ $data_list->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $data_list])  }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="container mychart">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thống kê tỉ lệ sản phẩm bán</h4>
                        <div class="filter-area col-12 col-md-12 col-sm-12 pl-0">
                            <div class="form-group col-4 padding-r-15 d-flex align-items-center">
                                <label class="mb-0 pr-2">Hiển thị</label>
                                <select id="perPageSell" name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="1" >1</option>
                                    <option value="2" selected>2</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                </select>
                                <label class="mb-0 pl-2"> / trang</label>
                            </div>

                            <div class="form-group col-3 padding-r-15 d-flex align-items-center">
                                <select id="monthSell" name="search_month" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled="" selected="">Chọn tháng</option>
                                    <option value="1">Tháng 1</option>
                                    <option value="2">Tháng 2</option>
                                    <option value="3">Tháng 3</option>
                                    <option value="4">Tháng 4</option>
                                    <option value="5">Tháng 5</option>
                                    <option value="6">Tháng 6</option>
                                    <option value="7">Tháng 7</option>
                                    <option value="8">Tháng 8</option>
                                    <option value="9">Tháng 9</option>
                                    <option value="10">Tháng 10</option>
                                    <option value="11">Tháng 11</option>
                                    <option value="12">Tháng 12</option>
                                </select>
                            </div>

                            <div class="form-group col-3 padding-r-15 d-flex align-items-center">
                                <select id="yearSell" name="search_year" aria-controls="order-listing" class="custom-select custom-select-sm form-control h-100 border-radius-15">
                                    <option value="" disabled="" selected="">Chọn năm</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>

                            <div class="form-group d-flex">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" id="buttonSearchSell">Lọc</button>
                                </div>
                            </div>
                        </div>
                        <div class="data-count-sell-table">
                            <div class="table-responsive">
                                <td colspan="12">
                                    <table class="table table-striped" id="product-table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="sortStyle unsortStyle">Tên sản phẩm</th>
                                            <th class="sortStyle unsortStyle">Số lượng đã bán</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $stt = 1 ?>
                                        @foreach ($sellData as $key => $data_item)
                                            <tr>
                                                <td>{{ $stt }}</td>
                                                <td>{{ $data_item->name }}</td>
                                                <td>{{ $data_item->scount }}</td>
                                            </tr>
                                            <?php $stt++ ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </div>
                            @if($sellData instanceof Illuminate\Pagination\LengthAwarePaginator)
                                {{ $sellData->onEachSide(2)->links('server::layouts.paginate', ['data_pagination' => $sellData])  }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="container count-sell-chart">
                            <canvas id="countSellChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="container count-chart">
                            <canvas id="countChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- input hidden -->
    <input type="hidden" id="order_post" value="{{ route('server.statistic.order') }}">
    <input type="hidden" id="order_post_chart" value="{{ route('server.statistic.chart.post') }}">
    <input type="hidden" id="order_post_sell_chart" value="{{ route('server.statistic.sell.chart.post') }}">
    <input type="hidden" id="order_post_sell" value="{{ route('server.statistic.sell.post') }}">
    <input type="hidden" id="order_post_count_chart" value="{{ route('server.statistic.chart.count.post') }}">
@endsection

@section('more-js')
    <script src="{{ asset('DoAnTotNghiep/server/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('DoAnTotNghiep/server/assets/js/statistic.js') }}"></script>

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
