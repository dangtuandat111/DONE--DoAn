<?php

namespace Packages\Client\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\Client\Services\ClientService;

class CheckoutController extends Controller {
    public $clientService;

    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }
    public function checkout(Request $request) {
        if ($request->isMethod('post')) {
            $params = [
                'address' => $request->get('address'),
                'phone_number' => $request->get('phone_number')
            ];

            $result = $this->clientService->addOrder($params, \Auth::guard('customer')->id());
            if ($result === true) {
                return response()->json([
                    'status' => true
                ]);
            } else if(str_contains($result, 'Lỗi')) {
                return response()->json([
                    'status' => false,
                    'errorMessage' => 'Số lượng còn lại không đủ'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'errorMessage' => 'Lỗi: Có lỗi bất ngờ xảy ra.'
                ]);
            }
        } else {
            $customer_id = \Auth::guard('customer')->id();
            $customer_data = ($this->clientService->getCustomerData(\Auth::guard('customer')->id()))[0];
            $cart_item = $this->clientService->getCart($customer_id);

            return view('client::product.checkout')->with($this->clientService->getViewData())
                ->with(['cart_item' => $cart_item])->with(['customer_data' => $customer_data]);
        }
    }
}

