<?php

namespace Packages\Server\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Packages\Server\Entities\Admin\Admin;
use Packages\Server\Http\Requests\SignupRequest;
use Packages\Server\Services\Auth\SignupService;

class SignupController extends Controller
{

    // Get signup page
    public function getSignup()
    {
        return view('server::auth.signup');
    }

    // Excute signup
    public function signup(SignupRequest $signupRequest, SignupService $signupService)
    {
        $signupRequest->safe()->only(['name', 'email', 'password']);

        $admin_data = Admin::create([
            'name' => $signupRequest->get('user_name', 'Default name'),
            'email' => $signupRequest->get('email'),
            'password' => bcrypt($signupRequest->get('password', '111111')),
        ]);

        (Auth::guard('admin')->loginUsingId($admin_data->id));
        return redirect()->route('server.home.get');
    }

}
