<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'avatar', 'email', 'phone_number', 'status', 'role'];
}
