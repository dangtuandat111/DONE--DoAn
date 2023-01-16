<?php

namespace Packages\Client\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Packages\Server\Repository\Brand\BrandRepository;
use Packages\Server\Repository\Category\CategoryRepository;
use Packages\Server\Repository\Customer\CustomerRepository;
use Packages\Server\Repository\Option\OptionRepository;
use Packages\Server\Repository\OptionGroup\OptionGroupRepository;
use Packages\Server\Repository\Product\ProductRepository;
use Packages\Server\Repository\Product\ProductVariantRepository;
use Packages\Server\Repository\Property\PropertyRepository;
use Packages\Server\Repository\PropertyGroup\PropertyGroupRepository;

class ClientService
{
    public $product, $productVariant, $brand, $category, $property, $option, $propertyGroup, $optionGroup;
    public $total = 0;

    public function __construct(
        ProductRepository        $productRepository,
        ProductVariantRepository $productVariantRepository,
        BrandRepository          $brandRepository,
        PropertyGroupRepository  $propertyGroupRepository,
        CategoryRepository       $categoryRepository,
        OptionGroupRepository    $optionGroupRepository,
        OptionRepository         $optionRepository,
        PropertyRepository       $propertyRepository
    )
    {
        $this->product = $productRepository;
        $this->productVariant = $productVariantRepository;
        $this->brand = $brandRepository;
        $this->propertyGroup = $propertyGroupRepository;
        $this->category = $categoryRepository;
        $this->optionGroup = $optionGroupRepository;
        $this->property = $propertyRepository;
        $this->option = $optionRepository;
    }

    public function getViewData()
    {
        return [
            'brand_data' => $this->brand->getAll(),
            'category_data' => $this->category->getAll(),
            'property_data' => $this->property->getAll(),
            'product_data' => $this->product->getAll(),
        ];
    }

    public function getSearchResult($params)
    {
        if ($params['id_category'] && $params['id_category'] > 0) {
            $product_data = DB::table("product_variant")
                ->join('product', 'product.id', '=', 'product_variant.id_product')
                ->where('product.id_category', '=', $params['id_category']) //
                ->where('product.name', 'like', '%' . $params['name'] . '%')
                ->select('product_variant.*')
                ->orderBy('created_at', 'DESC');

            if ($params['perPage'] > 0) {
                $product_data = $product_data->paginate($params['perPage'],['*'],'page',$params['page']);
            } else {
                $product_data = $product_data->get();
            }

            if ($product_data->isEmpty()) {
                return [];
            }

            foreach ($product_data as $item) {
                $data = DB::table('product')->where('id', '=', $item->id_product)->get(['price', 'name'])[0];
                $item->price = $data->price;
                $item->name = $data->name;
                $product_property_result = DB::select(DB::raw(
                    '
                    select name, value,
                           (select property_group.name from property_group where p.id_property_group = property_group.id) as property_group_name
                    from product_variant_property
                    join property p on product_variant_property.id_property = p.id
                    where id_product_variant = ' . $item->id
                ));
                foreach($product_property_result as $product_property_result_item) {
                    if ($product_property_result_item->property_group_name == 'Màu sắc' ) {
                        $item->color = $product_property_result_item->name;
                    } else if ($product_property_result_item->property_group_name == 'Kích cỡ') {
                        $item->size = $product_property_result_item->value;
                    } else if ($product_property_result_item->property_group_name == 'Độ rộng') {
                        $item->width = $product_property_result_item->value;
                    }
                }
            }
            return $product_data;
        }
        if ($params['id_brand'] && $params['id_brand'] > 0) {
            $product_data = DB::table("product_variant")
                ->join('product', 'product.id', '=', 'product_variant.id_product')
                ->where([
                    ['product.id_brand', '=', $params['id_brand']],
                    ['product.name', 'like', '%' . $params['name'] . '%']
                ]) //
                ->select('product_variant.*')
                ->orderBy('created_at', 'DESC');

            if ($params['perPage'] > 0) {
                $product_data = $product_data->paginate($params['perPage'],['*'],'page',$params['page']);
            } else {
                $product_data = $product_data->get();
            }

            if ($product_data->isEmpty()) {
                return [];
            }

            foreach ($product_data as $item) {
                $data = DB::table('product')->where('id', '=', $item->id_product)->get(['price', 'name'])[0];
                $item->price = $data->price;
                $item->name = $data->name;
                $product_property_result = DB::select(DB::raw(
                    '
                    select name, value,
                           (select property_group.name from property_group where p.id_property_group = property_group.id) as property_group_name
                    from product_variant_property
                    join property p on product_variant_property.id_property = p.id
                    where id_product_variant = ' . $item->id
                ));
                foreach($product_property_result as $product_property_result_item) {
                    if ($product_property_result_item->property_group_name == 'Màu sắc' ) {
                        $item->color = $product_property_result_item->name;
                    } else if ($product_property_result_item->property_group_name == 'Kích cỡ') {
                        $item->size = $product_property_result_item->value;
                    } else if ($product_property_result_item->property_group_name == 'Độ rộng') {
                        $item->width = $product_property_result_item->value;
                    }
                }
            }
            return $product_data;
        }
        if ($params['id_color'] && $params['id_color'] > 0) {
            $list_pvp = ((DB::table('product_variant_property')->where(['id_property' => $params['id_color']])->get('id_product_variant')));
            $result = [];
            foreach($list_pvp as $list_pvp_item) {
                $result[] = $list_pvp_item->id_product_variant;
            }
            $product_data = DB::table("product_variant")
                ->join('product', 'product.id', '=', 'product_variant.id_product')
                ->where([
                    ['product.name', 'like', '%' . $params['name'] . '%']
                ])
                ->whereIn('product_variant.id', $result)//
                ->select('product_variant.*')
                ->orderBy('created_at', 'DESC');

            if ($params['perPage'] > 0) {
                $product_data = $product_data->paginate($params['perPage'],['*'],'page',$params['page']);
            } else {
                $product_data = $product_data->get();
            }

            if ($product_data->isEmpty()) {
                return [];
            }

            foreach ($product_data as $item) {
                $data = DB::table('product')->where('id', '=', $item->id_product)->get(['price', 'name'])[0];
                $item->price = $data->price;
                $item->name = $data->name;
                $product_property_result = DB::select(DB::raw(
                    '
                    select name, value,
                           (select property_group.name from property_group where p.id_property_group = property_group.id) as property_group_name
                    from product_variant_property
                    join property p on product_variant_property.id_property = p.id
                    where id_product_variant = ' . $item->id
                ));
                foreach($product_property_result as $product_property_result_item) {
                    if ($product_property_result_item->property_group_name == 'Màu sắc' ) {
                        $item->color = $product_property_result_item->name;
                    } else if ($product_property_result_item->property_group_name == 'Kích cỡ') {
                        $item->size = $product_property_result_item->value;
                    } else if ($product_property_result_item->property_group_name == 'Độ rộng') {
                        $item->width = $product_property_result_item->value;
                    }
                }
            }
            return $product_data;
        }
        $product_data = DB::table("product_variant")
            ->join('product', 'product.id', '=', 'product_variant.id_product')
            ->where('product.name', 'like', '%' . $params['name'] . '%')
            ->select('product_variant.*')
            ->orderBy('created_at', 'DESC');

        if ($params['perPage'] > 0) {
            $product_data = $product_data->paginate($params['perPage'],['*'],'page',$params['page']);
        } else {
            $product_data = $product_data->get();
        }

        if ($product_data->isEmpty()) {
            return [];
        }

        foreach ($product_data as $item) {
            $data = DB::table('product')->where('id', '=', $item->id_product)->get(['price', 'name'])[0];
            $item->price = $data->price;
            $item->name = $data->name;
            $product_property_result = DB::select(DB::raw(
                '
                select name, value,
                       (select property_group.name from property_group where p.id_property_group = property_group.id) as property_group_name
                from product_variant_property
                join property p on product_variant_property.id_property = p.id
                where id_product_variant = ' . $item->id
            ));

            foreach($product_property_result as $product_property_result_item) {
                if ($product_property_result_item->property_group_name == 'Màu sắc' ) {
                    $item->color = $product_property_result_item->name;
                } else if ($product_property_result_item->property_group_name == 'Kích cỡ') {
                    $item->size = $product_property_result_item->value;
                } else if ($product_property_result_item->property_group_name == 'Độ rộng') {
                    $item->width = $product_property_result_item->value;
                } else {
                    $item->other[] = $product_property_result_item->value;
                }
            }
        }
        return $product_data;
    }

    public function getNewSearchResult($params) {
        $product_data = DB::table("product");

        if ($params['id_category'] && $params['id_category'] > 0) {
            $product_data->where('product.id_category', '=', $params['id_category']); //
        }
        if ($params['id_brand'] && $params['id_brand'] > 0) {
            $product_data->where('product.id_brand', '=', $params['id_brand']); //
        }
        if (($params['id_color'] && $params['id_color'] > 0)) {
            $subquery = (array) DB::table('product_variant')
                ->join('product_variant_property', 'product_variant.id', '=', 'product_variant_property.id_product_variant')
                ->where('id_property', '=', $params['id_color'])
                ->groupBy('product_variant.id_product')
                ->get('product_variant.id_product');

            $id_prod_list_array = [];
            foreach ($subquery as $key => $id_prod_list) {
                foreach($id_prod_list as $id_prod) {
                    $id_prod_list_array[] = $id_prod->id_product;
                }
                break;
            }
            $product_data->whereIn('id', $id_prod_list_array);
        }

        $product_data->where('product.name', 'like', '%' . $params['name'] . '%');

        $product_data = $product_data
            ->select('product.*')
            ->orderBy('created_at', 'DESC');

        if ($params['perPage'] > 0) {
            $product_data = $product_data->paginate($params['perPage'],['*'],'page',$params['page']);
        } else {
            $product_data = $product_data->get();
        }

        return $product_data;
    }

    public function getProductVariantData($param) {
        if (!$param) {
            return [];
        }
        $product_variant_data = $this->productVariant->where(['slug' => $param])->get()[0];
        if (empty($product_variant_data)) {
            return [];
        }

        $product_data = $this->product->where([['id', '=', $product_variant_data->id_product]])->get()[0];
        $product_variant_data->name = $product_data->name;
        $product_variant_data->feature = $product_data->feature;
        $product_variant_data->description = $product_variant_data->description ?? $product_data->description ;

        if (!$product_variant_data->discount || !$product_variant_data->end_at <= Carbon::now()) {
            if ($product_data->discount && $product_data->end_at > Carbon::now()) {
                $product_variant_data->discount = $product_data->discount;
                $product_variant_data->start_at = $product_data->start_at;
                $product_variant_data->end_at = $product_data->end_at;
            } else {
                $product_variant_data->discount = 0;
            }
        }
        $product_variant_data->price = $product_data->price;

        $product_image = DB::table('product_variant_image')->where('id_product_variant','=', $product_variant_data->id)->get('name');

        $image=[];
        foreach($product_image as $img) {
            $image[] = $img;
        }
        $product_variant_data->image = $image;

        $product_property_result = DB::select(DB::raw(
            '
                select name, value,
                       (select property_group.name from property_group where p.id_property_group = property_group.id) as property_group_name
                from product_variant_property
                join property p on product_variant_property.id_property = p.id
                where id_product_variant = ' . $product_variant_data->id
        ));
        $other = [];
        foreach($product_property_result as $product_property_result_item) {
            if ($product_property_result_item->property_group_name == 'Màu sắc' ) {
                $product_variant_data['color'] = $product_property_result_item->name;
            } else if ($product_property_result_item->property_group_name == 'Kích cỡ') {
                $product_variant_data['size'] = $product_property_result_item->value;
            } else if ($product_property_result_item->property_group_name == 'Độ rộng') {
                $product_variant_data['width'] = $product_property_result_item->value;
            } else if ($product_property_result_item->property_group_name !== ''){
                $other[$product_property_result_item->name] = $product_property_result_item->value;
            }
        }
        $product_variant_data['other'] = $other;

        $product_option_result = DB::select(DB::raw(
            '
                select name, value, bonus,
                       (select option_group.name from option_group where option_group.id = o.id_option_group) as option_group_name,
                       (select option_group.id from option_group where option_group.id = o.id_option_group) as option_group_id
                from product_variant_option
                join option o on product_variant_option.id_option = o.id
                where id_product_variant = ' . $product_variant_data->id
        ));

        foreach($product_option_result as $product_option_result_item) {
            if ($product_option_result_item->option_group_name == 'Insole Height') {
                $product_variant_data['insole_height']= $product_option_result_item->value;
            } else if ($product_option_result_item->option_group_name == 'Shoelace Color') {
                $product_variant_data['shoelace_color'] = $product_option_result_item->value;
            }
        }
        return $product_variant_data;
    }

    public function getNewProductVariantData($param) {
        if (!$param) {
            return [];
        }
        $product_data = $this->product->where(['slug' => $param])->get()[0];

        if (empty($product_data)) {
            return [];
        }
        $product_list_size = [];
        $product_list_color = [];
        $product_list_width = [];

        $product_variant_data = $this->productVariant->where([['id_product', '=', $product_data->id]])->get();

        foreach($product_variant_data as $product_variant_data_item) {
            $product_image = DB::table('product_variant_image')->where('id_product_variant','=', $product_variant_data_item->id)->get('name');

            $product_variant_data_item->pv_description = $product_variant_data_item->description;
            $product_variant_data_item->description = $product_data->description ?? $product_variant_data_item->description ;
//            dd($product_variant_data_item->end_at);

            $temp_date = Carbon::parse($product_variant_data_item->end_at);

            if (!$product_variant_data_item->discount || !$temp_date->gt(Carbon::now())) {
                $prod_temp_date = Carbon::parse($product_data->end_at);
                if ($product_data->discount && $prod_temp_date->gt(Carbon::now())) {
                    $product_variant_data_item->discount = $product_data->discount;
                    $product_variant_data_item->start_at = $product_data->start_at;
                    $product_variant_data_item->end_at = $product_data->end_at;
                } else {
                    $product_variant_data_item->discount = 0;
                }
            }
//dd($product_variant_data_item);
            $image=[];
            foreach($product_image as $img) {
                $image[] = $img;
            }
            $product_variant_data_item->image = $image;

            $product_variant_property_result = DB::select(DB::raw(
                '
                select name, value,
                       (select property_group.name from property_group where p.id_property_group = property_group.id) as property_group_name
                from product_variant_property
                join property p on product_variant_property.id_property = p.id
                where id_product_variant = ' . $product_variant_data_item->id
            ));

            $other = [];
            foreach($product_variant_property_result as $product_property_result_item) {
                if ($product_property_result_item->property_group_name == 'Màu sắc' ) {
                    $product_variant_data_item['color'] = $product_property_result_item->name;
                    if (!in_array($product_property_result_item->name, $product_list_color)) {
                        $product_list_color[] = $product_property_result_item->name;
                    }
                } else if ($product_property_result_item->property_group_name == 'Kích cỡ') {
                    $product_variant_data_item['size'] = $product_property_result_item->value;
                    if (!in_array($product_property_result_item->value, $product_list_size)) {
                        $product_list_size[] = $product_property_result_item->value;
                    }
                } else if ($product_property_result_item->property_group_name == 'Độ rộng') {
                    $product_variant_data_item['width'] = $product_property_result_item->value;
                    if (!in_array($product_property_result_item->value, $product_list_width)) {
                        $product_list_width[] = $product_property_result_item->value;
                    }
                } else if ($product_property_result_item->property_group_name !== ''){
                    $other[$product_property_result_item->name] = $product_property_result_item->value;
                }
            }
            $product_variant_data_item['other'] = $other;

            $product_variant_option_result = DB::select(DB::raw(
                '
                select name, value, bonus,
                       (select option_group.name from option_group where option_group.id = o.id_option_group) as option_group_name,
                       (select option_group.id from option_group where option_group.id = o.id_option_group) as option_group_id
                from product_variant_option
                join option o on product_variant_option.id_option = o.id
                where id_product_variant = ' . $product_variant_data_item->id
            ));

            $insole_height = [];
            $shoelace_color = [];
            $index = 0;
            foreach($product_variant_option_result as $product_option_result_item) {
                if ($product_option_result_item->name == 'Insole height option') {
                    $insole_height[] = ['value' => $product_option_result_item->value, 'bonus' => $product_option_result_item->bonus];
                } else if ($product_option_result_item->name == 'Shoelace color') {
                    $shoelace_color[] = ['value' => $product_option_result_item->value, 'bonus' => $product_option_result_item->bonus];
                }
                $index++;
            }
            $product_variant_data_item['insole_height'] = $insole_height;
            $product_variant_data_item['shoelace_color'] = $shoelace_color;
        }

        $product_data->list_size = $product_list_size;
        $product_data->list_color = $product_list_color;
        $product_data->list_width = $product_list_width;
        return [$product_data, $product_variant_data];
    }

    public function getCart($customer_id) {
        $cart_item = DB::table('cart_item')->where('id_customer', '=', $customer_id)->where('status', '=', 1)->get();

        foreach($cart_item as $item) {
            $product_variant_data = DB::table('product_variant')->where('id','=', $item->id_product_variant)->get()[0];
            $product_cur_data = DB::table('product')->where('id','=', $product_variant_data->id_product)->get()[0];
            $item->totalCount = $product_variant_data->count;
            $item->img = $product_variant_data->thumbnail;
            if ($product_variant_data->thumbnail == '' || $product_variant_data->thumbnail == 'product_default.png') {
                $item->img = $product_cur_data->thumbnail;
            }
            $item->slug = $product_variant_data->slug;
            $item->id_product_variant = $product_variant_data->id;

            $product_data = (DB::table('product')->where("id", $product_variant_data->id_product)->get()[0]);
            $item->name = $product_data->name;
            $item->price = $product_data->price;

            if (!$product_variant_data->discount || !$product_variant_data->end_at <= Carbon::now()) {
                if ($product_data->discount && $product_data->end_at > Carbon::now()) {
                    $product_variant_data->discount = $product_data->discount;
                    $product_variant_data->start_at = $product_data->start_at;
                    $product_variant_data->end_at = $product_data->end_at;
                } else {
                    $product_variant_data->discount = 0;
                }
            }

            $item->price = $product_data->price * (100 - $product_variant_data->discount) / 100;
            if ($item->note) {
                $ih_bonus =  0;
                $sc_bonus =  0;
                $ih = explode("SC", $item->note)[0];
                $ih = explode("IH", $ih)[1];
                $ih = explode("|", $ih);
                if ($ih[0] > 0) {
                    $ih_bonus = $ih[1];
                }
                $sc = explode("SC", $item->note)[1];
                $sc = explode("|", $sc);
                if ($sc[0]) {
                    $sc_bonus = $sc[1];
                }
//                dd($sc_bonus);
                $item->price += $ih_bonus + $sc_bonus;
            }

            $this->total = $this->total + $item->price * $item->count;
            $item->total = $this->total;

            $product_property = DB::table("property")
                ->join('product_variant_property', 'property.id', '=', 'product_variant_property.id_property')
                ->join('property_group', 'property.id_property_group', '=', 'property_group.id')
                ->where('id_product_variant', '=', $product_variant_data->id)
                ->get(['property.id_property_group as id_pg', 'property.name as pn', 'property.value as pv']);

            foreach($product_property as $pp) {
                if ($pp->id_pg == 1) {
                    $item->color = $pp->pn;
                }
                else if ($pp->id_pg == 2) {
                    $item->width = $pp->pv;
                }
                else if ($pp->id_pg == 5) {
                    $item->size = $pp->pv;
                }
            }
        }

        return ($cart_item);
    }

    public function addCart($customer_id, $id, $count, $note) {
        try {
            $data = DB::table('cart_item')->where([
                ['id_customer', '=', $customer_id],
                ['id_product_variant', '=', $id],
                ['status', '=', 1]
            ])->exists();

            if ($data) {
                DB::table('cart_item')
                ->where([
                    ['id_customer', '=', $customer_id],
                    ['id_product_variant', '=', $id],
                ])
                ->update([
                    'count' => $count,
                    'note' => $note
                ]);
            } else {
                DB::table('cart_item')
                ->insert([
                    'id_customer' =>  $customer_id,
                    'id_product_variant' => $id,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'count' => $count,
                    'note' => $note
                ]);
            }
            return true;
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return 'Something error!!!';
        }

    }

    public function updateCart($customer_id, $id, $count) {
        $data = DB::table('cart_item')->where([
            ['id_customer', '=', $customer_id],
            ['id_product_variant', '=', $id],
        ])->exists();

        if ($data) {
            DB::table('cart_item')
                ->where([
                    ['id_customer', '=', $customer_id],
                    ['id_product_variant', '=', $id],
                ])
                ->update([
                    'count' => $count
                ]);
            return true;
        } else {
            return 'Cart item is not exist.';
        }
    }

    public function deleteCart($customer_id, $id) {
        DB::table('cart_item')
            ->where([
                ['id_customer', '=', $customer_id],
                ['id_product_variant', '=', $id],
            ])
            ->update([
                'status' => 0
            ]);
    }

    public function getCustomerData($id) {
        return (DB::table('customer')->where('id', '=', $id))->get();
    }

    public function updateProfile($id, $params) {
        DB::table('customer')->where('id', '=', $id)->update($params);
        return true;
    }

    public function addOrder($params, $customer_id)
    {
        $ih_count = 0;
        $sc_count = 0;
        $cart_item = $this->getCart($customer_id);
        foreach ($cart_item as $item) {
            if ($item->count <= $item->totalCount) {
                if ($item->note) {
                    $ih_bonus =  0;
                    $sc_bonus =  0;
                    $ih = explode("SC", $item->note)[0];
                    $ih = explode("IH", $ih)[1];
                    $ih = explode("|", $ih);
                    if ($ih[0] > 0) {
                        $ih_count = $ih[0];
                    }
                    $sc = explode("SC", $item->note)[1];
                    $sc = explode("|", $sc);
                    if ($sc[0]) {
                        $sc_count = $sc[0];
                    }
                }
                continue;
            } else {
                return 'Lỗi: số lượng hàng trong kho không đủ: ' . $item->name;
            }

        }

        DB::beginTransaction();

        try {
            $order_id = DB::table('order')->insertGetId([
                'id_customer' => $customer_id,
                'total' => $this->total,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => 1,
                'address' => $params['address'],
                'phone_number' => $params['phone_number'],
                'note' => 'IH' . $ih_count . '|SC' . $sc_count
            ]);

            foreach ($cart_item as $item) {
                DB::table('order_detail')->insert([
                    'id_product_variant' => $item->id_product_variant,
                    'id_order' => $order_id,
                    'count' => $item->count,
                    'price' => $item->price
                ]);
                DB::commit();

                DB::table('cart_item')->where([
                    ['id', '=', $item->id]
                ])->update([
                    'status' => 0
                ]);

                $count = DB::table('product_variant')->where([
                    ['id', '=', $item->id_product_variant]
                ])->get('count')[0]->count;

                DB::table('product_variant')->where([
                    ['id', '=', $item->id_product_variant]
                ])->update([
                    'count' => $count - 1
                ]);

            }
            return true;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error($e->getMessage());
            return false;
        }
        return false;
    }
}
