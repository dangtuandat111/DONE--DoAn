<?php

namespace Packages\Server\Repository\Product;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\ProductVariant;
use Packages\Server\Repository\Base\BaseRepository;

class ProductVariantRepository extends BaseRepository
{
    public function getModel()
    {
        return ProductVariant::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('product_variant')->where('id', $id)->get());
    }
}
