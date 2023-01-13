<?php

namespace Packages\Server\Repository\Admin;

use Illuminate\Support\Facades\DB;
use Packages\Server\Repository\Base\BaseRepository;
use Packages\Server\Entities\Model\Admin;

class AdminRepository extends BaseRepository
{
    public function getModel()
    {
        return \Packages\Server\Entities\Model\Admin::class;
    }

    public function checkRole($id) {
        return (DB::table('user')->where('id', $id)->get('role'));
    }

    public function getInfo($id)
    {
        return (DB::table('user')->where('id', $id)->get());
    }

    public function searchAccount($params) {
        $query = DB::table('user')
        ->when($params['name'], function($query) use ($params){
            $query->where('name', 'like', '%' . $params['name'] . '%');
        })
        ->paginate($params['perPage'] > 0 ? $params['perPage'] : 100000);
        return $query;
    }
    public function updateRole($params) {
        try {
            DB::table('user')->where('id', $params['id'])->update([
                'role' => $params['role']
            ]);
            return true;
        } catch (\Exception $e) {
            logger()->error('MESSAGE_ERROR: ' . $e->getMessage());
            return false;
        }
    }
}
