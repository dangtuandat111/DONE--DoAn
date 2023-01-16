<?php

namespace Packages\Server\Repository\Brand;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\Brand;
use Packages\Server\Repository\Base\BaseRepository;

class BrandRepository extends BaseRepository
{
    public function getModel()
    {
        return Brand::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('brand')->where('id', $id)->get());
    }

    public function getALlEnabled()
    {
        return (DB::table('brand')->where('status', 1)->get());
    }

    public function countBrand() {
        return DB::table('brand')->count();
    }

    public function getBrandBySlug($slug) {
        return DB::table('brand')->where('slug' , $slug)->get();
    }

    public function searchByName($name) {
        if ($name) {
            return DB::table('brand')->where('name', 'like', '%' . $name . '%')->get();
        } else {
            return $this->getAll();
        }
    }
}
