<?php

namespace Packages\Server\Repository\Property;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\Property;
use Packages\Server\Repository\Base\BaseRepository;

class PropertyRepository extends BaseRepository
{
    public function getModel()
    {
        return Property::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('property')->where('id', $id)->get());
    }

    public function searchProperty($params) {
        $query = Property::
        when($params['property_group'] > 0, function($query) use ($params) {
            $query->where('property.id_property_group', '=', $params['property_group']);
        })
        ->orderBy('property.id', 'DESC');

        if ($params['perPage'] > 0) {
            return $query->paginate($params['perPage'],['*'],'page',$params['page']);
        } else {
            return $query->get();
        }
    }
}
