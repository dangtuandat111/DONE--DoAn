<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Sessions extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';

    protected $fillable = ['type'];

    public function setCustomerType() {
        $session_id = Session::getId();
        DB::table('sessions')->where('id', $session_id)->update([
            'type' => 1
        ]);
    }
}
