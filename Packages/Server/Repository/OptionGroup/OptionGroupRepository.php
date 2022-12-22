<?php

namespace Packages\Server\Repository\OptionGroup;

use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\OptionGroup;
use Packages\Server\Repository\Base\BaseRepository;

class OptionGroupRepository extends BaseRepository
{
    public function getModel()
    {
        return OptionGroup::class;
    }

    /**
     * @param int $id
     */
    public function getInfo(int $id)
    {
        return (DB::table('option_group')->where('id', $id)->get());
    }
}
