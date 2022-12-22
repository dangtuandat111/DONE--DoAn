<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    protected $table = 'user_history';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'login_time'];
    public $timestamps = false;
}
