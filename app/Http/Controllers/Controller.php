<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $asset_image = 'DoAnTotNghiep/server/assets/images/';
    public $errorMessage = 'Message Error: ';
    public $success_status = 1;
    public $error_status = 0;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
