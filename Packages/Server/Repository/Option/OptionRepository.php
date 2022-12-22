<?php

namespace Packages\Server\Repository\Option;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\Option;
use Packages\Server\Repository\Base\BaseRepository;

class OptionRepository extends BaseRepository
{
    public function getModel()
    {
        return Option::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('option')->where('id', $id)->get());
    }

    public function searchOption($params) {
        $query = Option::
        join('option_group', 'option.id_option_group', '=', 'option_group.id')
        ->when($params['name'] != '', function($query) use ($params){
            $query->where('option.name', 'like', '%' . $params['name'] . '%');
        })
        ->when($params['option_group'] > 0, function($query) use ($params) {
            $query->where('option.id_option_group', '=', $params['option_group']);
        })
        ->select('option.*', 'option_group.name as og_name',
            'option_group.id as og_id', 'option_group.created_at as og_c_at',
            'option_group.updated_at as og_u_at', 'option_group.note as og_note',
            'option_group.status as og_status'
        )
        ->orderBy('id_option_group', 'DESC');

        if ($params['perPage'] > 0) {
            return $query->paginate($params['perPage'],['*'],'page',$params['page']);
        } else {
            return $query->get();
        }
    }
}
