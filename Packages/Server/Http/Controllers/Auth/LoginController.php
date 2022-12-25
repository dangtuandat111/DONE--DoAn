<?php

namespace Packages\Server\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Packages\Server\Entities\Model\UserHistory;
use Packages\Server\Http\Requests\LoginRequest;
use Packages\Server\Services\Auth\LoginService;

class LoginController extends Controller {

    // Get login page
    public function getLogin() {
        return view('server::auth.login');
    }

    // Excute login
    public function postLogin(LoginRequest $loginRequest, LoginService $loginService) {
        try {
            if( \Auth::guard('admin')->attempt(['email' => $loginRequest->get('email', 0), 'password' => $loginRequest->get('password', 0),  'status' => 1], $loginRequest->get('remember', false))) {
                UserHistory::create([
                    'user_id' => \Auth::guard('admin')->id()
                ]);
                return redirect()->route('server.home.get');
            } else {
                return back()->withErrors('Message Error: Login unsuccessful. Please try again later.')->withInput();
            }
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return back()->withErrors('Message Error: Login unsuccessful. Please try again later.')->withInput();
        }
    }

    public function logout() {
        DB::table('user')->where(['id' => \Auth::guard('admin')->id()])->update([
            'remember_token' => ''
        ]);
        DB::table('sessions')->where(['user_id' => \Auth::guard('admin')->id(), 'type' => 1])->delete();
        \Auth::guard('admin')->logout();
        return redirect()->route('server.login.get');
    }
}
