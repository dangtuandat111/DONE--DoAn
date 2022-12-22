<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'phone_number', 'email', 'description', 'gender', 'address', 'avatar', 'status'];
}
