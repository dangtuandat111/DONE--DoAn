<?php

namespace Packages\Client\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Packages\Client\Services\ClientService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller {
    public $clientService;
    public $resouces_directory = '\Packages\Client\Resources\assets\images';


    public function __construct(
        ClientService $clientService
    )
    {
        $this->clientService = $clientService;
    }

    public function getProfile() {
        $customer = ($this->clientService->getCustomerData(\Auth::guard('customer')->id()))[0];
        return view('client::profile.profile')->with($this->clientService->getViewData())->with(['customer_data' => $customer]);
    }

    public function updateProfile(Request $request) {
        $customer_id = \Auth::guard('customer')->id();
        $params = [
            'name' => $request->get('name'),
            'phone_number'=> $request->get('phone_number'),
            'description'=> $request->get('description'),
            'gender'=> $request->get('gender'),
            'address'=> $request->get('address'),
        ];

        $this->clientService->updateProfile($customer_id, $params);
        return response()->json([
            'status' => true,
        ]);
    }

    public function sendMailUpdate(Request $request) {
        $customer_email = \DB::table('customer')->where('id','=', \Auth::guard('customer')->id())->get('email')[0];
        $code = substr(md5(time()), 0, 6);
        DB::table('customer')->where('id','=', \Auth::guard('customer')->id())->update([
            'otp' => $code
        ]);

        Mail::send('client::mail.change_password', array('code' => $code), function($message) use ($customer_email) {
            $message->to($customer_email->email, 'Dumpskin')->subject('Xác nhận thay đổi mật khẩu');
        });

        return response()->json([
            'status' => true
        ]);
    }

    public function updatePassword(Request $request) {
        $isExist = DB::table('customer')->where('id','=', \Auth::guard('customer')->id())->where('otp', '=', $request->otp)->exists();

        if ($isExist) {
            DB::table('customer')->where('id','=', \Auth::guard('customer')->id())->update([
                'otp' => '',
                'password' =>  bcrypt($request->pass)
            ]);
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function updateAvatar(Request $request) {
        $avatar = $this->imageUploadPost($request, 'avatar_image');
        if ($avatar) {
            DB::table("customer")->where('id','=', \Auth::guard('customer')->id())->update([
                'avatar' => $avatar
            ]);
            return redirect()->route('client.profile');
        } else {
            return back()->with('error', 'Cập nhật ảnh đại diện không thành công.');
        }
    }

    public function imageUploadPost(Request $request, $filename = 'img')
    {
        $date = Carbon::now()->format('dmhis');

        try {
            $imageName = '';
            if ($request->hasFile($filename)) {
                $image = $request->file($filename)->getClientOriginalName();
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                $imageName = $imageName . '-' . $date . '.png';
                $request->file($filename)->move(base_path() . $this->resouces_directory, $imageName);
                copy((base_path() . $this->resouces_directory    . '/').$imageName,
                    (public_path() . '/' . 'DoAnTotNghiep/client/assets/images/').$imageName);
            }

            return $imageName;
        } catch (\Exception $e) {
            logger()->error($this->errorMessage . $e->getMessage());
            return '';
        }
    }
}
