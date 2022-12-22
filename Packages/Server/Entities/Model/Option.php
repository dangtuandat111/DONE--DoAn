<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'value', 'id_option_group', 'bonus'];
    public $timestamps = false;
}
