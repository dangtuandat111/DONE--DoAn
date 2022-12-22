<?php

namespace Packages\Server\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Packages\Server\Repository\Admin\AdminRepository;
use Packages\Server\Repository\UserHistory\UserHistoryRepository;

class ProfileController extends Controller {
    public const selectedNavItem = 'Account';
    public $user,$user_history;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\user';

    public function __construct(AdminRepository $user, UserHistoryRepository $user_history)
    {
        $this->user = $user;
        $this->user_history = $user_history;
    }

    // Get profile page
    public function getProfile() {
        $user_history_data = $this->user_history->getById(\Auth::guard('admin')->id());
        foreach($user_history_data as $user_history_data_item) {
            $user_history_data_item->ago = (Carbon::parse($user_history_data_item->login_time))->diffForHumans(Carbon::parse($user_history_data_item->login_time));
        }
        return view('server::profile.profile')->with(['selectedNavItem' => self::selectedNavItem, 'user_history_data' => $user_history_data]);
    }

    public function updateInfo(Request $request) {
        $user_data = $this->user->getInfo(\Auth::guard('admin')->id())[0];
        $this->user->update($request->get('id'), [
            'name' => $request->get('name', $user_data->name),
            'email' => $request->get('email', $user_data->email),
            'password' => ($request->get('password', '')) ? Hash::make($request->get('password', '')) : $user_data->password,
            'phone_number' => $request->get('phone_number', $user_data->phone_number),
        ]);
        return response()->json([
            'status' => true
        ]);
    }
}
