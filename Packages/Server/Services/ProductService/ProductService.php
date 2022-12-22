<?php

namespace Packages\Server\Services\ProductService;

use Packages\Server\Entities\Model\Product;
use Packages\Server\Repository\Brand\BrandRepository;
use Packages\Server\Repository\Category\CategoryRepository;
use Packages\Server\Repository\OptionGroup\OptionGroupRepository;
use Packages\Server\Repository\Product\ProductRepository;
use Packages\Server\Repository\Product\ProductVariantRepository;
use Packages\Server\Repository\PropertyGroup\PropertyGroupRepository;

class ProductService {
    public const selectedNavItem = 'Product';
    public $product, $productVariant, $brand, $category, $property, $option;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        BrandRepository $brandRepository,
        PropertyGroupRepository $propertyGroupRepository,
        CategoryRepository $categoryRepository,
        OptionGroupRepository $optionGroupRepository
    )
    {
        $this->product = $productRepository;
        $this->productVariant = $productVariantRepository;
        $this->brand = $brandRepository;
        $this->property = $propertyGroupRepository;
        $this->category = $categoryRepository;
        $this->option = $optionGroupRepository;
    }

    public function getData() {
        return [
            'selectedNavItem' => self::selectedNavItem,
            'brand_data' => $this->brand->getAll(),
            'category_data' => $this->category->getAll(),
        ];
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
