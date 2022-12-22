<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class PropertyGroup extends Model
{
    protected $table = 'property_group';
    protected $primaryKey = 'id';

    protected $fillable = ['name'];
    public $timestamps = true;
}
