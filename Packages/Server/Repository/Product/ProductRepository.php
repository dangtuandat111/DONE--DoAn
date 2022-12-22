<?php

namespace Packages\Server\Repository\Product;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\Product;
use Packages\Server\Repository\Base\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function getModel()
    {
        return Product::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('product')->where('id', $id)->get());
    }
}
