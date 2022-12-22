<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'description', 'price', 'discount', 'start_at', 'end_at', 'thumbnail', 'status', 'id_brand', 'id_category'];
    public $timestamps = true;
}
