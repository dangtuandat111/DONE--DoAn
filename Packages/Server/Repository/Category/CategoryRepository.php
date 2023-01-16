<?php

namespace Packages\Server\Repository\Category;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\Category;
use Packages\Server\Repository\Base\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function getModel()
    {
        return Category::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('category')->where('id', $id)->get());
    }

    public function countCategory() {
        return DB::table('category')->count();
    }

    public function getALlEnabled()
    {
        return (DB::table('category')->where('status', 1)->get());
    }

    public function getCategoryBySlug($slug) {
        return DB::table('category')->where('slug' , $slug)->get();
    }

    public function searchByName($name) {
        if ($name) {
            return DB::table('category')->where('name', 'like', '%' . $name . '%')->get();
        } else {
            return $this->getAll();
        }
    }
}
