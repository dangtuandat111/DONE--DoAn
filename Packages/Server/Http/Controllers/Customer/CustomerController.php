<?php

namespace Packages\Server\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\Server\Repository\Customer\CustomerRepository;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller {
    public const selectedNavItem = 'Customer';
    public $customer;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\customer';
    public $perPage = 2;

    public function __construct(CustomerRepository $customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer(Request $request) {
        $customer_data = $this->customer->where([['status', '!=' , 2]])->paginate($this->perPage);

        $customer_data = $this->formatData($customer_data);

        return view('server::customer.customer')->with('customer_data', $customer_data)->with(['selectedNavItem' => self::selectedNavItem]);
    }

    public function searchCustomer(Request $request)  {
        $params = [
            'perPage' => $request->get('perPage', $this->perPage),
            'name' => $request->get('name', ''),
            'email' => $request->get('email', ''),
            'status' => $request->get('status', ''),
            'page' => $request->get('page', ''),
        ];
        $customer_data = $this->customer->searchCustomer($params);

        $customer_data = $this->formatData($customer_data);

        return response()->json([
            'status' => true,
            'data' => $customer_data,
            'html' => view('server::customer.list')->with('customer_data', $customer_data)->render()
        ]);
    }

    public function updateStatus(Request $request) {
        $customer_id = $request->get('id', 0);
        $status = $request->get('status', 1);

        try {
            if ($customer_id) {
                $this->customer->update($customer_id, ['status' => $status]);
                return response()->json([
                    'status' =>  $this->success_status,
                ]);
            } else {
                return response()->json([
                    'status' =>  $this->error_status,
                    'errorMessage' => 'Cập nhật thông tin không thành công.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => $this->error_status,
                'errorMessage' => 'Có lỗi bất ngờ xảy ra.'
            ]);
        }
    }

    public function getDetail(Request $request) {
        try {
            $customer_data = $this->customer->getInfo($request->get('id', -1));
            return response()->json([
                'status' => true,
                'data' => $this->formatData($customer_data),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => '',
                'errorMessage' => 'Có lỗi bất ngờ xảy ra.'
            ]);
        }
    }

    public function resetPass(Request $request) {
        $result = $this->customer->resetPass($request->get('id', '-1'));

        if ($result) {
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errorMessage' => $this->errorMessage . 'Bắt buộc đăng nhập lại không thành công'
            ]);
        }
    }

    public function forceLogin (Request $request) {
        $result = $this->customer->removeSession($request->get('id', '-1'));

        if ($result) {
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errorMessage' => $this->errorMessage . 'Bắt buộc đăng nhập lại không thành công.'
            ]);
        }
    }

    public function formatData($customer_data) {
        $stt = 1;
        foreach($customer_data as $customer_data_item)  {
            $customer_data_item->stt = $stt++;
            $customer_data_item->status = $customer_data_item->status ? 'Enabled' : 'Disabled';
            $date_time = explode(" ", $customer_data_item->created_at)[0];
            $customer_data_item->c_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $date_time = explode(" ", $customer_data_item->updated_at)[0];
            $customer_data_item->u_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $customer_data_item->img = $customer_data_item->avatar ? $this->asset_image . 'customer/' . $customer_data_item->avatar : '';
        }
        return $customer_data;
    }
}
