<?php

namespace Packages\Client\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

    public function getHome() {
        return view('client::home.home');
    }
}
