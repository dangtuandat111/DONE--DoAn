<?php

namespace Packages\Server\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {
    public const selectedNavItem = 'Home';

    // Get home page
    public function index() {
        \Packages\Server\Entities\Model\Sessions::setCustomerType();
        return view('server::home.home')->with(['selectedNavItem' => self::selectedNavItem]);
    }
}
