<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'property';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'value', 'id_property_group'];
    public $timestamps = false;
}
