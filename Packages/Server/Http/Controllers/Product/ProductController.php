<?php

namespace Packages\Server\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Packages\Server\Services\ProductService\ProductService;

class ProductController extends Controller {
    public const selectedNavItem = 'Product';
    public $product_service;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\product';
    public $perPage = 10;

    public function __construct(
        ProductService $product_service
    )
    {
        $this->product_service = $product_service;
    }

    public function getProduct() {
        return view('server::product.product')->with($this->product_service->getData());
    }

    public function searchProduct(Request $request) {
        $product_data = $this->formatData($this->product_service->searchProduct($request));
        return response()->json([
            'status' => true,
            'data' => $product_data,
            'html' => view('server::product.product_list')->with([
                'product_data' => $product_data,
            ])->render()
        ]);
    }

     public function createProduct(Request $request) {

     }

    public function formatData($product_data) {
        foreach ($product_data as $product_data_item) {
            $date_time = explode(" ", $product_data_item->created_at)[0];
            $product_data_item->c_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $date_time = explode(" ", $product_data_item->updated_at)[0];
            $product_data_item->u_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $date_time = explode(" ", $product_data_item->start_at)[0];
            $product_data_item->s_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $date_time = explode(" ", $product_data_item->end_at)[0];
            $product_data_item->e_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $product_data_item->img = $product_data_item->thumbnail ? $this->asset_image . 'product/' . $product_data_item->thumbnail : '';
            $product_data_item->feature_list = explode('/', $product_data_item->feature);
        }
        return $product_data;
    }
}
