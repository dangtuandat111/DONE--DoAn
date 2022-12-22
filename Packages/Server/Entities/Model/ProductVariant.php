<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variant';
    protected $primaryKey = 'id';

    protected $fillable = ['count', 'thumbnail', 'slug', 'description', 'discount', 'start_at', 'end_at', 'status', 'id_product'];
    public $timestamps = true;
}
