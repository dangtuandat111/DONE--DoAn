<?php

namespace Packages\Client\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\Client\Services\ClientService;

class CartController extends Controller {
    public $clientService;

    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }

    public function getCart() {
        $customer_id = \Auth::guard('customer')->id();
        $cart_item = $this->clientService->getCart($customer_id);

        return view('client::cart.cart')->with(['cart_item' => $cart_item])->with($this->clientService->getViewData());
    }

    public function addCart(Request $request) {
        $customer_id = \Auth::guard('customer')->id();

        if (!$request->get('id')) {
            return response()->json([
                'status' => false,
                'errorMessage' => 'Sản phẩm này hiện không tồn tại.',
            ]);
        }

        if (!$request->get('quantity')) {
            return response()->json([
                'status' => false,
                'errorMessage' => 'Số lượng không phù hợp'
            ]);
        }

        $note = '';
        if ($request->get('ih', -1)) {
            $note = $note . 'IH' . $request->get('ih', -1) . '|' . $request->get('ih_bonus', 0) ;
        }
        if ($request->get('sc', -1)) {
            $note = $note . 'SC' . $request->get('sc', -1) . '|' . $request->get('sc_bonus', 0) ;
        }

        $result = $this->clientService->addCart($customer_id, $request->get('id'), $request->get('quantity'), $note);

        if ($result == true) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errorMessage' => 'Có lỗi bất ngờ xảy ra.'
            ]);
        }
    }

    public function updateCart(Request $request) {
        if ($request->get('count') > 0) {
            $result = $this->clientService->updateCart(\Auth::guard('customer')->id(), $request->get('id'), $request->get('count'));

            if ($result == true) {
                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'errorMessage' => 'Có lỗi bất ngờ xảy ra.'
                ]);
            }
        } else {
            return response()->json([
               'status' => false,
               'errorMessage' => 'Số lượng không phù hợp.'
            ]);
        }
    }

    public function deleteCart(Request $request) {
        $this->clientService->deleteCart(\Auth::guard('customer')->id(), $request->get('id'));
        return response()->json([
            'status' => true
        ]);
    }


}
