<?php

namespace Packages\Server\Repository\UserHistory;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\UserHistory;
use Packages\Server\Repository\Base\BaseRepository;

class UserHistoryRepository extends BaseRepository
{
    public function getModel()
    {
        return UserHistory::class;
    }

    public function getById($user_id) {
        return DB::table('user_history')->where('user_id', $user_id)->orderBy('login_time', 'DESC')->limit(10)->get();
    }
}
