<?php

namespace Packages\Server\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        if ($request->isMethod('post')) {
            $product_params = [];
            $list_image_name = [];
            $property = [];
            $option = [];
            foreach($request->all() as $key => $item) {
                if (Str::contains($key, 'files_')) {
                    $list_image_name[] = $key;
                }
                if (Str::contains($key, 'product_variant_property_')) {
                    $property[] = $item;
                }
                if (Str::contains($key, 'product_variant_option_')) {
                    $option[] = $item;
                }
            }

            $date = Carbon::now()->format('dmhis');

            if ($request->get('product_select_create_option')) {
                // Create new one
                $product_params = [
                    'name' => $request->get('product_name', ''),
                    'slug' => Str::slug($request->get('product_name', '') . '-' . $date),
                    'description' => $request->get('product_description', ''),
                    'feature' => $request->get('product_feature', ''),
                    'price' => $request->get('product_price', 0),
                    'status' => 1,
                    'id_brand' => $request->get('id_brand' ),
                    'id_category' => $request->get('id_category' ),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $imageName = $this->imageUploadPost($request, 'product_image');
                $product_params['thumbnail'] = $imageName;

                if ($request->get('product_discount', 'false') === "on") {
                    $product_params['discount'] = $request->get('product_discount_percent', 0);
                    $product_params['start_at'] = $request->get('product_start_discount', 0);
                    $product_params['end_at'] = $request->get('product_end_discount', 0);
                }

                $product_variant_params = [
                    'slug' => Str::slug($request->get('product_name', '')),
                    'count' => $request->get('product_variant_count', 0),
                    'description' => $request->get('product_variant_description', '')
                ];
            } else {
                // Select current one
                $product_data = $this->product_service->getProductData($request->get('product_select_product'))[0];

                $product_variant_params = [
                    'slug' => Str::slug($product_data->name . '-' . $date),
                    'id_product' => $product_data->id,
                    'count' => $request->get('product_variant_count', 0),
                    'description' => $request->get('product_variant_description', ''),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }

            $thumbnail_name = $this->imageUploadPost($request, 'product_variant_image');
            if ($thumbnail_name) {
                $product_variant_params['thumbnail'] = $thumbnail_name;
            }

            if ($request->get('product_variant_discount', '')) {
                $product_variant_params['discount'] = $request->get('product_variant_discount_percent', '');
                $product_variant_params['start_at'] = $request->get('product_variant_start_discount', '');
                $product_variant_params['end_at'] = $request->get('product_variant_end_discount', '');
            }

            $imageName = [];
            foreach($list_image_name as $list_image_name_item) {
                $imageName[] = $this->imageUploadPost($request, $list_image_name_item);
            }

            if ($request->get('product_select_create_option')) {
                $this->product_service->creatNewProduct($product_params, $product_variant_params, $imageName, $property, $option);
            } else {
                $this->product_service->creatNewProductVariant($product_variant_params, $imageName, $property, $option);
            }

            return redirect()->route('server.product.get')->with('message', 'Create product success');
        } else {
            return view('server::product.create_product')->with($this->product_service->getData())->with([
                'product_data' => $this->product_service->getAllProduct(),
            ])->with($this->product_service->getExtendData());
        }
     }

    public function imageUploadPost(Request $request, $filename = 'img')
    {
        $date = Carbon::now()->format('dmhis');

        try {
            $imageName = '';
            if ($request->hasFile($filename)) {
                logger()->debug($filename);
                $image = $request->file($filename)->getClientOriginalName();
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                $imageName = $imageName . '-' . $date . '.png';
                $request->file($filename)->move(base_path() . $this->resouces_directory, $imageName);
                logger()->debug(public_path() . $this->resouces_directory);
                copy((base_path() . $this->resouces_directory    . '/').$imageName,
                    (public_path() . '/' . 'DoAnTotNghiep/server/assets/images/product/').$imageName);
            }

            return $imageName;
        } catch (\Exception $e) {
            logger()->error($this->errorMessage . $e->getMessage());
            return '';
        }
    }

    public function editProduct(Request $request) {
        if ($request->isMethod('post')) {
            $date = Carbon::now()->format('dmhis');

            $product_params = [
                'name' => $request->get('product_name', ''),
                'slug' => Str::slug($request->get('product_name', '') . '-' . $date),
                'description' => $request->get('product_description', ''),
                'feature' => $request->get('product_feature', ''),
                'price' => $request->get('product_price', 0),
                'status' => $request->get('product_status', 0),
                'id_brand' => $request->get('id_brand', 15),
                'id_category' => $request->get('id_category', 8),
            ];

            $this->product_service->productUpdate($request->get('product_id'), $product_params);
            return redirect()->route('server.product.get');
        } else {
            return view('server::product.edit_product')->with(['product_data' => $this->formatEditData($this->product_service->getProductData($request->get('id')))])
                ->with($this->product_service->getData());
        }
    }

    public function getProductVariantList(Request $request) {
        [$product_variant_data, $product_data, $product_variant_size] = $this->product_service->getAllProductVariant($request->get('id'));

        return response()->json([
            'status' => true,
            'html' => view('server::product.list_product_variant')->with([
                'product_variant_data' => $product_variant_data,
                'product_data' => $product_data,
                'product_variant_size' => $product_variant_size,
            ])->render()
        ]);
    }

    public function editProductVariant(Request $request) {
        $list_image_name = [];
        if ($request->isMethod('post')) {
            $product_variant_params = [
                'count' => $request->get('product_variant_count', 0),
                'description' => $request->get('product_variant_description', ''),
                'status' => 1,
                'discount' => 0,
            ];

            if ($request->get('product_variant_discount')) {
                $product_variant_params['discount'] =  $request->get('product_variant_discount_percent', 0);
                $product_variant_params['start_at'] =  $request->get('product_variant_start_discount', '2022-10-10');
                $product_variant_params['end_at'] =  $request->get('product_variant_end_discount', '2022-10-10');
            }

            if ($request->get('product_variant_image')) {
                $thumbnail_name = $this->imageUploadPost($request, 'product_variant_image');
                if ($thumbnail_name) {
                    $product_variant_params['thumbnail'] = $thumbnail_name;
                }
            }

            $product_variant_property = [
                [
                    'id_product_variant' => $request->get('id_product_variant'),
                    'id_property' => $request->get('product_variant_property_1'),
                ],
                [
                    'id_product_variant' => $request->get('id_product_variant'),
                    'id_property' => $request->get('product_variant_property_2'),
                ],
                [
                    'id_product_variant' => $request->get('id_product_variant'),
                    'id_property' => $request->get('product_variant_property_5'),
                ]
            ];

            $product_variant_option = [
                [
                    'id_product_variant' => $request->get('id_product_variant'),
                    'id_option' => $request->get('product_variant_option_3'),
                ],
                [
                    'id_product_variant' => $request->get('id_product_variant'),
                    'id_option' => $request->get('product_variant_option_4'),
                ]
            ];

            foreach($request->all() as $key => $item) {
                if (Str::contains($key, 'files_')) {
                    $list_image_name[] = $key;
                }
            }

            $imageName = [];
            foreach($list_image_name as $list_image_name_item) {
                $imageName[] = $this->imageUploadPost($request, $list_image_name_item);
            }

            $this->product_service->updatePV($request->get('id_product_variant'),
                $product_variant_params,
                $product_variant_property,
                $product_variant_option,
                $request->get('pv_file'),
                $imageName
            );
            return redirect()->route("server.product.get")->with('message', 'Cập nhật thành công.');
        } else {
            [$product_variant_option, $product_variant_property] = $this->product_service->getExtraPVData($request->get('id'));
            $selected_option = $product_variant_option->toArray();
            $selected_property = $product_variant_property->toArray();
            [$product_variant_data, $product_data, $product_variant_size, $product_variant_image] = $this->product_service->getDetailProductVariant($request->get('id'));

            return view('server::product.edit_product_variant')->with([
                'product_variant_data' => $product_variant_data,
                'product_data' => $product_data,
                'product_variant_size' => $product_variant_size,
                'product_variant_image' => $product_variant_image,
            ])->with($this->product_service->getExtendData())->with([
                'selected_option' => $selected_option,
                'selected_property' => $selected_property
            ]);
        }
    }

    public function formatData($product_data) {
        foreach ($product_data as $product_data_item) {
            $date_time = explode(" ", $product_data_item->created_at)[0];
            $product_data_item->c_at = explode("-", $date_time)[2] . '/' . explode("-", $date_time)[1] . '/' .explode("-", $date_time)[0];
            $date_time = explode(" ", $product_data_item->updated_at)[0];
            $product_data_item->u_at = explode("-", $date_time)[2] . '/' . explode("-", $date_time)[1] . '/' .explode("-", $date_time)[0];
            $date_time = explode(" ", $product_data_item->start_at)[0];
            $product_data_item->s_at = explode("-", $date_time)[2] . '/' . explode("-", $date_time)[1] . '/' .explode("-", $date_time)[0];
            $date_time = explode(" ", $product_data_item->end_at)[0];
            $product_data_item->e_at = explode("-", $date_time)[2] . '/' . explode("-", $date_time)[1] . '/' .explode("-", $date_time)[0];
            $product_data_item->feature_list = $product_data_item->feature;
        }
        return $product_data;
    }

    public function formatEditData($product_data) {
        foreach ($product_data as $product_data_item) {
            $date_time = explode(" ", $product_data_item->created_at)[0];
            $product_data_item->c_at = explode("-", $date_time)[0] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[2];
            $date_time = explode(" ", $product_data_item->updated_at)[0];
            $product_data_item->u_at = explode("-", $date_time)[0] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[2];
            $date_time = explode(" ", $product_data_item->start_at)[0];
            $product_data_item->s_at = explode("-", $date_time)[0] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[2];
            $date_time = explode(" ", $product_data_item->end_at)[0];
            $product_data_item->e_at = explode("-", $date_time)[0] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[2];
            $product_data_item->feature_list = $product_data_item->feature;
        }
        return $product_data;
    }
}
