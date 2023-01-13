<?php

namespace Packages\Client\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\Client\Services\ClientService;

class SearchProductController extends Controller {
    public $clientService;


    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }

    public function productDetail(Request $request) {
        if ($request->isMethod('post')) {

        } else {
            \Packages\Client\Entities\Sessions::setCustomerType(\Auth::guard('customer')->id());
            [$product_data, $product_variant_data] = ($this->clientService->getNewProductVariantData($request->get('product-slug')));
            return view('client::product.product_detail')->with($this->clientService->getViewData())->with([
                'product_variant_data' => $product_variant_data,
                'product_data' => $product_data
            ]);
        }
    }

    public function search(Request $request) {
        $params = [
            'perPage' => $request->get('perPage', 6),
            'page' => $request->get('page', 1),
            'id_category' => $request->get('id_category', -1),
            'id_brand' => $request->get('id_brand', -1),
            'id_size' => $request->get('id_size', -1),
            'id_color' => $request->get('id_color', -2),
            'name' => $request->get('product_name', ''),
        ];

        return response()->json([
            'status' => true,
            'html' => view('client::home.search_result')->with(['product_data' => $this->clientService->getNewSearchResult($params)])->render(),
        ]);
    }
}
