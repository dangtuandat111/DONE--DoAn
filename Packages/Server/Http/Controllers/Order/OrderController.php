<?php

namespace Packages\Server\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\Server\Services\OrderService\OrderService;

class OrderController extends Controller {
    public const selectedNavItem = 'Order';
    public $order;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\order';
    public $perPage = 10;
    public $order_service;

    public function __construct(
        OrderService $orderService
    )
    {
        $this->order_service = $orderService;
    }

    public function getOrder() {
        [$order_list, $customer_name] = $this->order_service->getOrder();
        return view("server::order.order")->with(['order_list' => $order_list])
            ->with(['customer_name' => $customer_name])
            ->with(['selectedNavItem' => self::selectedNavItem]);
    }

    public function getOrderList(Request $request) {
        [$order_detail_list, $product_name] = $this->order_service->getOrderList($request->get('id'), $request->get('page'));
//dd($this->order_service->getOrderList($request->get('id'), $request->get('page')));
        return response()->json([
            'status' => true,
            'html' => view('server::order.order_list')->with(['order_detail_list' => $order_detail_list])
                        ->with(['product_name' => $product_name])->render()
        ]);
    }
}
