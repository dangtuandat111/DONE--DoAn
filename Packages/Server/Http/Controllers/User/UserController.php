<?php

namespace Packages\Server\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Packages\Server\Repository\Admin\AdminRepository;
use Packages\Server\Repository\UserHistory\UserHistoryRepository;

class UserController extends Controller {
    public const selectedNavItem = 'Account';
    public $user,$user_history;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\user';
    public $perPage = 2;

    public function __construct(AdminRepository $user, UserHistoryRepository $user_history)
    {
        $this->user = $user;
        $this->user_history = $user_history;
    }

    public function getAccount() {
        $user_data = $this->user->where([['status', '!=' , 2]])->paginate($this->perPage);
        $user_data = $this->formatData($user_data);

        return view('server::user.user')->with(['user_data' => $user_data])->with(['selectedNavItem' => self::selectedNavItem]);
    }

    public function updateStatus(Request $request) {
        $user_id = $request->get('id', 0);
        $status = $request->get('status', 1);

        try {
            if ($user_id) {
                $this->user->update($user_id, ['status' => $status]);
                return response()->json([
                    'status' =>  $this->success_status,
                ]);
            } else {
                return response()->json([
                    'status' =>  $this->error_status,
                    'errorMessage' => 'Cập nhật thông tin người dùng thành công.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => $this->error_status,
                'errorMessage' => 'Có lỗi bất ngờ xảy ra.'
            ]);
        }
    }

    public function createAccount(Request $request) {
        if ($request->isMethod('post')) {
            $result = $this->user->checkRole(\Auth::guard('admin')->id())[0];
            if (!$result != 1) {
                return back()->with('error', 'Tài khoản không có quyền');
            }

            // Do nothing
            $date = Carbon::now()->format('dmhis');

            $attributes = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'status' => 1,
                'role' => 0
            ];
            $this->user->create($attributes);
            return redirect()->route('server.account.get');
        } else {
            return view('server::user.create')->with(['selectedNavItem' => self::selectedNavItem]);
        }
    }

    public function searchAccount(Request $request) {
        $params = [
            'perPage' => $request->get('perPage', $this->perPage),
            'name' => $request->get('name', ''),
        ];

        $user_data = $this->user->searchAccount($params);

        $user_data = $this->formatData($user_data);

        return response()->json([
            'status' => true,
            'data' => $user_data,
            'html' => view('server::user.list')->with('user_data', $user_data)->render()
        ]);
    }

    public function updateRole(Request $request) {
        $params = [
            'id' => $request->get('id', -1),
            'role' => $request->get('role', 0)
        ];

        $result = $this->user->updateRole($params);

        return response()->json([
            'status' => $result
        ]);
    }

    public function formatData($user_data) {
        $stt = 1;
        foreach($user_data as $user_data_item)  {
            $user_data_item->stt = $stt++;
            if ($user_data_item->id == \Auth::guard('admin')->id()) {
                $user_data_item->current_account = true;
            } else {
                $user_data_item->current_account = false;
            }

            $user_data_item->status = $user_data_item->status ? 'Enabled' : 'Disabled';
            $date_time = explode(" ", $user_data_item->created_at)[0];
            $user_data_item->c_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $date_time = explode(" ", $user_data_item->updated_at)[0];
            $user_data_item->u_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $user_data_item->img = $user_data_item->avatar !== 'admin_default.png'? $this->asset_image . 'user/' . $user_data_item->avatar : '';
        }
        return $user_data;
    }
}
