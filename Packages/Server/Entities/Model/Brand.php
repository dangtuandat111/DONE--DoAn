<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'status', 'description', 'thumbnail', 'slug'];
}
