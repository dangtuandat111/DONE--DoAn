<?php

namespace Packages\Server\Repository\PropertyGroup;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\Property;
use Packages\Server\Entities\Model\PropertyGroup;
use Packages\Server\Repository\Base\BaseRepository;

class PropertyGroupRepository extends BaseRepository
{
    public function getModel()
    {
        return PropertyGroup::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('property_group')->where('id', $id)->get());
    }

    public function searchPropertyGroup($params) {
        $query = PropertyGroup::
        when($params['name'] != '', function($query) use ($params){
            $query->where('property_group.name', 'like', '%' . $params['name'] . '%');
        })
        ->when($params['property_group'] > 0, function($query) use ($params) {
            $query->where('property.id_property_group', '=', $params['property_group']);
        })
        ->orderBy('id', 'DESC');

        if ($params['perPage'] > 0) {
            return $query->paginate($params['perPage'],['*'],'page',$params['page']);
        } else {
            return $query->get();
        }
    }
}
