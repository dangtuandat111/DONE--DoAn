<?php

namespace Packages\Server\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Packages\Server\Services\OrderService\OrderService;
use Packages\Server\Services\Statistic\Statistic;

class StatisticController extends Controller
{
    public const selectedNavItem = 'Statistic';
    public $perPage = 2;
    public $statistic;
    public $order_service;

    public function __construct(
        OrderService $orderService,
        Statistic $statisticService
    )
    {
        $this->order_service = $orderService;
        $this->statistic_service = $statisticService;
    }

    public function getOrder(Request $request)
    {
        if ($request->get('month') && $request->get('month') != null) {
            $month = $request->get('month');
        } else {
            $month = 12;
        }

        if ($request->get('year') && $request->get('year') != null) {
            $year = $request->get('year');
        } else {
            $year = 2022;
        }
        $data = $this->statistic_service->getData(
            $request->get('page', 1),
            $request->get('perPage', 2),
            $month,
            $year);

        $sellData = $this->statistic_service->getSellCount(
            $request->get('page', 1),
            $request->get('perPage', 2),
            $month,
            $year);

        return view("server::statistic.order")->with(['data_list' => $data])
            ->with(['sellData' => $sellData]);
    }

    public function postOrder(Request $request) {
        if ($request->get('month') && $request->get('month') != null) {
            $month = $request->get('month');
        } else {
            $month = 12;
        }

        if ($request->get('year') && $request->get('year') != null) {
            $year = $request->get('year');
        } else {
            $year = 2022;
        }

        $data = $this->statistic_service->getData(
            $request->get('page', 1),
            $request->get('perPage', 2),
            $month,
            $year);

        return response()->json([
            'status' => true,
            'data' => $data,
            'html' => view('server::statistic.order_list')->with(['data_list' => $data])->render()
        ]);
    }

    public function postSell(Request $request) {
        if ($request->get('month') && $request->get('month') != null) {
            $month = $request->get('month');
        } else {
            $month = 12;
        }

        if ($request->get('year') && $request->get('year') != null) {
            $year = $request->get('year');
        } else {
            $year = 2022;
        }

        $sellData = $this->statistic_service->getSellCount(
            $request->get('page', 1),
            $request->get('perPage', 2),
            $month,
            $year);

        return response()->json([
            'status' => true,
            'data' => $sellData,
            'html' => view('server::statistic.shell_list')->with(['sellData' => $sellData])->render()
        ]);
    }

    public function getChartOrder(Request $request) {
        if ($request->get('month') && $request->get('month') != null) {
            $month = $request->get('month');
        } else {
            $month = 12;
        }

        if ($request->get('year') && $request->get('year') != null) {
            $year = $request->get('year');
        } else {
            $year = 2022;
        }

        [$pv_name, $total] = $this->statistic_service->getSellData(
            $month,
            $year
        );

        if (empty($pv_name) || empty($total)) {
            return response()->json([
                'status' => false,
            ]);
        }

        return response()->json([
            'status' => true,
            'pv_name' => $pv_name,
            'total' => $total
        ]);
    }

    public function getCountChart() {
        [$pname, $pcount] = $this->statistic_service->getCountProd();

        if (empty($pname) || empty($pcount)) {
            return response()->json([
                'status' => false,
            ]);
        }

        return response()->json([
            'status' => true,
            'pv_name' => $pname,
            'total' => $pcount
        ]);
    }

    public function postSellChart() {
        [$pname, $pcount] = $this->statistic_service->getSellChart();

        if (empty($pname) || empty($pcount)) {
            return response()->json([
                'status' => false,
            ]);
        }

        return response()->json([
            'status' => true,
            'pname' => $pname,
            'count' => $pcount
        ]);
    }
}
