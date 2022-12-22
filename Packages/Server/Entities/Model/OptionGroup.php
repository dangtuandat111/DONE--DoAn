<?php

namespace Packages\Server\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    protected $table = 'option_group';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'status', 'note'];
}
