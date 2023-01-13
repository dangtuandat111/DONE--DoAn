<?php

namespace Packages\Server\Services\ProductService;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\Product;
use Packages\Server\Repository\Brand\BrandRepository;
use Packages\Server\Repository\Category\CategoryRepository;
use Packages\Server\Repository\Option\OptionRepository;
use Packages\Server\Repository\OptionGroup\OptionGroupRepository;
use Packages\Server\Repository\Product\ProductRepository;
use Packages\Server\Repository\Product\ProductVariantRepository;
use Packages\Server\Repository\Property\PropertyRepository;
use Packages\Server\Repository\PropertyGroup\PropertyGroupRepository;

class ProductService {
    public const selectedNavItem = 'Product';
    public $product, $productVariant, $brand, $category, $property, $option, $propertyGroup, $optionGroup;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        BrandRepository $brandRepository,
        PropertyGroupRepository $propertyGroupRepository,
        CategoryRepository $categoryRepository,
        OptionGroupRepository $optionGroupRepository,
        OptionRepository $optionRepository,
        PropertyRepository $propertyRepository
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

    public function getData() {
        return [
            'selectedNavItem' => self::selectedNavItem,
            'brand_data' => $this->brand->getAll(),
            'category_data' => $this->category->getAll(),
        ];
    }

    public function getProductData($id) {
        return $this->product->getInfo($id);
    }

    public function getExtendData() {
        return [
            'property_group_data' => $this->propertyGroup->getAll(),
            'property_data' => $this->property->getAll(),
            'option_group_data' => $this->optionGroup->getAll(),
            'option_data' => $this->option->getAll(),
        ];
    }

    public function getAllProduct() {
        return $this->product->getAll();
    }

    public function getAllProductVariant($id) {
        $product_data = $this->productVariant->getInfoByProduct($id);

        $product_variant_size = [];
        foreach ($product_data as $product_data_item) {
            $product_variant_size[] = DB::table('product_variant_property')
                ->join('property', 'property.id', '=', 'product_variant_property.id_property')
                ->where([
                    ['property.id_property_group', '=', 5],
                    ['product_variant_property.id_product_variant', '=', $product_data_item->id],
                ])
                ->get('value')[0];
        }

        return [$this->productVariant->getInfoByProduct($id), $this->product->getInfo($id), $product_variant_size];
    }

    public function getDetailProductVariant($id) {
        $product_variant_data = $this->productVariant->getInfo($id);

        $product_variant_size = [];
        $product_variant_image = [];
        foreach ($product_variant_data as $product_data_item) {
            $product_variant_size[] = DB::table('product_variant_property')
                ->join('property', 'property.id', '=', 'product_variant_property.id_property')
                ->where([
                    ['property.id_property_group', '=', 5],
                    ['product_variant_property.id_product_variant', '=', $product_data_item->id],
                ])
                ->get('value')[0];
        }
        $product_variant_image[] = DB::table('product_variant_image')
            ->where([
                ['product_variant_image.id_product_variant', '=', $product_variant_data[0]->id],
            ])
            ->get(['name', 'id']);

        return [$this->productVariant->getInfo($id), $this->product->getInfo($product_variant_data[0]->id_product), $product_variant_size, $product_variant_image[0]];
    }

    public function getExtraPVData($id) {
        $product_variant_option = DB::table('product_variant_option')->where('id_product_variant', $id)->get('id_option');
        $product_variant_property = DB::table('product_variant_property')->where('id_product_variant', $id)->get('id_property');
        return [$product_variant_option, $product_variant_property];
    }

    public function updatePV($id,
        $product_variant_params,
        $product_variant_property,
        $product_variant_option,
        $pv_file,
        $imageName
    ) {
        DB::beginTransaction();

        try {
            DB::table('product_variant')->where('id', '=', $id)->update($product_variant_params);

            DB::table('product_variant_property')->where("id_product_variant", '=', $id)->delete();

            foreach ($product_variant_property as $p_item) {
                DB::table('product_variant_property')->insert($p_item);
            }

            DB::table('product_variant_option')->where("id_product_variant", '=', $id)->delete();

            foreach ($product_variant_option as $o_item) {
                DB::table('product_variant_option')->insert($o_item);
            }

            if ($pv_file) {
                DB::table('product_variant_image')->where('id_product_variant','=', $id)
                    ->whereNotIn("id", $pv_file)->delete();
            }

            foreach ($imageName as $image) {
                DB::table('product_variant_image')->insert([
                    'id_product_variant' => $id,
                    'name' => $image,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error($e->getMessage());
            return false;
        }
        return true;
    }

    public function creatNewProduct($product_params, $product_variant_params, $imageName, $property, $option) {
        DB::beginTransaction();

        try {
            $product_id = DB::table('product')->insertGetId($product_params);

            $product_variant_params['id_product'] = $product_id;
            $product_variant_id = DB::table('product_variant')->insertGetId($product_variant_params);

            foreach ($imageName as $imgName) {
                DB::table('product_variant_image')->insert([
                    'id_product_variant' => $product_variant_id,
                    'name' => $imgName
                ]);
            }

            foreach($property as $property_item) {
                DB::table('product_variant_property')->insert([
                    'id_product_variant' => $product_variant_id,
                    'id_property' => $property_item
                ]);
            }

            foreach($option as $option_item) {
                DB::table('product_variant_option')->insert([
                    'id_product_variant' => $product_variant_id,
                    'id_option' => $option_item,
                    'status' => 1
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error($e->getMessage());
            return false;
        }
        return true;
    }

    public function creatNewProductVariant($product_variant_params, $imageName, $property, $option) {
        DB::beginTransaction();

        try {
            $product_variant_id = DB::table('product_variant')->insertGetId($product_variant_params);

            foreach ($imageName as $imgName) {
                DB::table('product_variant_image')->insert([
                    'id_product_variant' => $product_variant_id,
                    'name' => $imgName
                ]);
            }

            foreach($property as $property_item) {
                DB::table('product_variant_property')->insert([
                    'id_product_variant' => $product_variant_id,
                    'id_property' => $property_item
                ]);
            }

            foreach($option as $option_item) {
                DB::table('product_variant_option')->insert([
                    'id_product_variant' => $product_variant_id,
                    'id_option' => $option_item,
                    'status' => 1
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error($e->getMessage());
            return false;
        }
        return true;
    }

    public function productUpdate($id, $attribute) {
        $this->product->update($id, $attribute);
        return true;
    }

    public function searchProduct($request) {
        $query = Product::
        join('brand', 'brand.id', '=', 'product.id_brand')
        ->join('category', 'category.id', '=', 'product.id_category')
        ->when($request->get('search_brand_group') > 0, function($query) use ($request) {
            $query->where('product.id_brand', '=', $request->get('search_brand_group'));
        })
        ->select('product.*', 'brand.name as brand_name', 'category.name as category_name',
        'category.slug as category_slug', 'brand.slug as brand_slug'
        )
        ->orderBy('product.id', 'DESC');

        if ($request->get('perPage') > 0) {
            return $query->paginate($request->get('perPage',['*'],'page',$request->get('perPage')));
        } else {
            return $query->get();
        }
    }

}
