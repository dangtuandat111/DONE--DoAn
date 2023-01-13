<?php

namespace Packages\Server\Repository\Customer;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Packages\Client\Entities\Customer\Customer;
use Packages\Server\Repository\Base\BaseRepository;

class CustomerRepository extends BaseRepository
{
    public const default_password = 11111111;
    public function getModel()
    {
        return Customer::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('customer')->where('id', $id)->get());
    }

    public function countCustomer() {
        return DB::table('customer')->count();
    }

    public function searchCustomer($params) {
        $query = Customer::
        when($params['name'], function($query) use ($params){
            $query->where('name', 'like', '%' . $params['name'] . '%');
        })
        ->when($params['email'], function($query) use ($params){
            $query->where('email', 'like', '%' . $params['email'] . '%');
        })
        ->when($params['status'], function($query) use ($params){
            $query->where('status', '=', $params['status']);
        })
        ->paginate($params['perPage'] > 0 ? $params['perPage'] : 100000, ['*'],'page',$params['page']);

        return $query;
    }

    public function removeSession($user_id) {
        DB::beginTransaction();

        try {
            DB::table('sessions')->where([
                ['customer_id', $user_id],
                ['type', 0]
            ])->delete();

            DB::table('customer')->where([
                ['id', $user_id],
            ])->update([
                'remember_token' => ''
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error($e->getMessage());
            return false;
        }
        return true;
    }

    public function resetPass($user_id) {
        DB::beginTransaction();

        try {
            DB::table('sessions')->where([
                ['customer_id', $user_id],
                ['type', 0]
            ])->delete();

            DB::table('customer')->where([
                ['id', $user_id],
            ])->update([
                'password' => Hash::make(self::default_password),
                'remember_token' => ''
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error($e->getMessage());
            return false;
        }
        return true;
    }

}
