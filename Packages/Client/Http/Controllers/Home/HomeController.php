<?php

namespace Packages\Client\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Packages\Client\Services\ClientService;

class HomeController extends Controller {
    public $clientService;

    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }

    public function getHome() {
        if (\Auth::guard('customer')->check()) {
            \Packages\Client\Entities\Sessions::setCustomerType(\Auth::guard('customer')->id());
        }
        return view('client::home.home')->with($this->clientService->getViewData());
    }
}
