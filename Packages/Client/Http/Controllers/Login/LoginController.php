<?php

namespace Packages\Client\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Packages\Client\Services\ClientService;
use Packages\Server\Http\Requests\LoginRequest;

class LoginController extends Controller {
    public $clientService;

    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }

    public function login(LoginRequest $loginRequest) {
        try {
            if( \Auth::guard('customer')->attempt(['email' => $loginRequest->get('email', 0), 'password' => $loginRequest->get('password', 0),  'status' => 1], $loginRequest->get('remember', false))) {
                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'errorMessage' => 'Đăng nhập thất bại. Vui lòng thử lại sau.'
                ]);
            }
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json([
                'status' => false,
                'errorMessage' => 'Đăng nhập thất bại. Vui lòng thử lại sau.'
            ]);
        }
    }

    public function logout() {
        DB::table('customer')->where(['id' => \Auth::guard('customer')->id()])->update([
            'remember_token' => ''
        ]);
        DB::table('sessions')->where(['user_id' => \Auth::guard('customer')->id(), 'type' => 0])->delete();
        \Auth::guard('customer')->logout();
        return response()->json([
            'status' => true,
            'redirect_url' => route('client.home.get')
        ]);
    }
}
