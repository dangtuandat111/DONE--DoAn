<?php

namespace Packages\Client\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Packages\Client\Entities\Customer\Customer;
use Packages\Client\Http\Requests\SignupRequest;
use Packages\Client\Services\ClientService;
use Packages\Server\Http\Requests\LoginRequest;

class SignupController extends Controller {
    public $clientService;

    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }

// Excute signup
    public function signup(SignupRequest $signupRequest)
    {
        $signupRequest->safe()->only(['name', 'email', 'password']);

        $customer_data = Customer::create([
            'name' => $signupRequest->get('user_name', 'Default name'),
            'email' => $signupRequest->get('email'),
            'password' => bcrypt($signupRequest->get('password', '111111')),
        ]);

        (Auth::guard('customer')->loginUsingId($customer_data->id));
        return response()->json([
           'status' => true
        ]);
    }
}
