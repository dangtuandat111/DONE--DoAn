<?php

namespace Packages\Server\Http\Controllers\Option;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Packages\Server\Repository\Option\OptionRepository;
use Packages\Server\Repository\OptionGroup\OptionGroupRepository;

class OptionController extends Controller {
    public const selectedNavItem = 'Product';
    public $option, $optionGroup;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\option';
    public $perPage = 10;

    public function __construct(OptionRepository $option, OptionGroupRepository $optionGroup)
    {
        $this->option = $option;
        $this->optionGroup = $optionGroup;
    }

    public function getOption() {
        $option_group = $this->optionGroup->getAll();
        return view('server::option.option')->with([
            'option_group' => $option_group
        ])->with(['selectedNavItem' => self::selectedNavItem]);
    }

    public function searchOption(Request $request) {
        $params = [
            'perPage' => $request->get('perPage', -1),
            'option_group' => $request->get('option_group', -1),
            'name' => $request->get('name', ''),
            'page' => $request->get('page', 1)
        ];

        [$option_extra_data, $option_data] = $this->formatData($this->option->searchOption($params));

        return response()->json([
            'status' => true,
            'data' => $option_data,
            'html' => view('server::option.list')
                ->with(['option_data' => $option_data, 'option_extra_data' => $option_extra_data])->render()
        ]);
    }

    public function createOption(Request $request) {
        if ($request->isMethod('post')) {
            $name = $request->get('name', '');
            $id_option_group = $request->get('option_group');
            $value = $request->get('option_value', '');
            $bonus = $request->get('option_bonus', 0);

            if (empty($name) || empty($id_option_group) || empty($value) || $bonus == null) {
                return response()->json([
                    'status' => false,
                    'errorMessage' => $this->errorMessage . 'All fields are required.'
                ]);
            }

            $is_group_exist = $this->optionGroup->where([
                'id' => $id_option_group
            ])->exists();
            if (!$is_group_exist) {
                return response()->json([
                    'status' => false,
                    'errorMessage' => $this->errorMessage . 'Option group is not valid.'
                ]);
            }

            $this->option->create([
                'name' => $name,
                'id_option_group' => $id_option_group,
                'value' => $value,
                'bonus' => $bonus,
            ]);
            return response()->json([
                'status' => true,
            ]);
        } else {
            $optionGroup = $this->optionGroup->where([
                'status' => 1
            ])->get();
            return view('server::option.create_option')->with([
                'selectedNavItem' => self::selectedNavItem,
                'optionGroup' => $optionGroup,
            ]);
        }
    }

    public function createOptionGroup(Request $request) {
        if ($request->isMethod('post')) {
            if (!$request->get('name') || ($request->get('status') != 0 && $request->get('status') != 1)) {
                return response()->json([
                   'status' => false,
                   'errorMessage' => $this->errorMessage . 'Option group name and option status are needed.'
                ]);
            }
            if ($request->get('note')) {
                $this->optionGroup->create([
                    'name' => $request->get('name'),
                    'status' => $request->get('status', 1),
                    'note' => $request->get('note', ''),
                ]);
            } else {
                $this->optionGroup->create([
                    'name' => $request->get('name'),
                    'status' => $request->get('status', 1),
                ]);
            }

            return response()->json([
                'status' => true,
            ]);
        } else {
            return view('server::option.create_option_group')->with([
                'selectedNavItem' => self::selectedNavItem,
            ]);
        }
    }

    public function updateOptionGroup(Request $request) {
        $this->optionGroup->update($request->get('id',-1), [
            'name' => $request->get('name',-1)
        ]);

        return response()->json([
            'status' => true
        ]);
    }

    public function updateOptionGroupStatus(Request $request) {
        $option_group_id = $request->get('id', 0);
        $status = $request->get('status', 1);

        try {
            if ($option_group_id) {
                $this->optionGroup->update($option_group_id, ['status' => $status]);
                return response()->json([
                    'status' =>  $this->success_status,
                ]);
            } else {
                return response()->json([
                    'status' =>  $this->error_status,
                    'errorMessage' => 'Failed on update brand info.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => $this->error_status,
                'errorMessage' => $e->getMessage()
            ]);
        }
    }

    public function updateOtion(Request $request) {
        $this->optionGroup->update($request->get('id',-1), [
            'name' => $request->get('name',-1)
        ]);

        return response()->json([
            'status' => true
        ]);
    }

    public function formatData($option_data) {
        $more_option_data = [];
        foreach($option_data as $option_data_item) {
            $return_option_data_item['id'] = $option_data_item->id;
            $return_option_data_item['name'] = $option_data_item->name;
            $return_option_data_item['value'] = $option_data_item->value;
            $return_option_data_item['bonus'] = $option_data_item->bonus;
            $return_option_data_item['og_id'] = $option_data_item->og_id;
            $return_option_data_item['og_name'] = $option_data_item->og_name;
            $return_option_data_item['og_note'] = $option_data_item->og_note;
            $return_option_data_item['status'] = $option_data_item->og_status ? 'Enabled' : 'Disabled';
            $date_time = explode(" ", $option_data_item->og_c_at)[0];
            $return_option_data_item['c_at'] = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $date_time = explode(" ", $option_data_item->og_u_at)[0];
            $return_option_data_item['u_at'] = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];

            if (isset($more_option_data['og_' . $option_data_item->og_id])) {
                $length = count($more_option_data['og_' . $option_data_item->og_id]);
                $more_option_data['og_' . $option_data_item->og_id][$length] = $return_option_data_item;
            } else {
                $more_option_data['og_' . $option_data_item->og_id][0] = $return_option_data_item;
            }
        }
        return [$more_option_data, $option_data];
    }
}
