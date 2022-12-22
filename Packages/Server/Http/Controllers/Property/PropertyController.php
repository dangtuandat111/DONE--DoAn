<?php

namespace Packages\Server\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Packages\Server\Repository\Property\PropertyRepository;
use Packages\Server\Repository\PropertyGroup\PropertyGroupRepository;

class PropertyController extends Controller {
    public const selectedNavItem = 'Product';
    public $property, $propertyGroup;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\property';
    public $perPage = 10;

    public function __construct(PropertyRepository $property, PropertyGroupRepository $propertyGroup)
    {
        $this->property = $property;
        $this->propertyGroup = $propertyGroup;
    }

    public function getProperty(Request $request) {
        if ($request->isMethod('post')) {

        } else {
            $property_group_data = $this->propertyGroup->getAll();
            return view('server::property.index')->with([
                'selectedNavItem' => self::selectedNavItem,
                'property_group_data' => $property_group_data
            ]);
        }
    }

    public function searchPropertyGroup(Request $request) {
        $params = [
            'perPage' => $request->get('perPage', -1),
            'property_group' => $request->get('property_group', -1),
            'name' => $request->get('name', ''),
            'page' => $request->get('page', 1)
        ];

        $property_data = $this->formatData($this->propertyGroup->searchPropertyGroup($params));

        return response()->json([
            'status' => true,
            'data' => $property_data,
            'html' => view('server::property.list_property_group')->with([
                'property_group_data' => $property_data
            ])->render()
        ]);
    }

    public function searchProperty(Request $request) {
        $params = [
            'perPage' => $request->get('perPage', -1),
            'property_group' => $request->get('property_group', -1),
            'page' => $request->get('page', 1)
        ];

        $property_data = $this->property->searchProperty($params);

        return response()->json([
            'status' => true,
            'data' => $property_data,
            'html' => view('server::property.list_property')->with([
                'property_data' => $property_data
            ])->render()
        ]);
    }

    function createProperty(Request $request) {
        if ($request->isMethod('post')) {
            if (!$request->get('property_value')) {
                return response()->json([
                    'status' => false,
                    'errorMessage' => $this->errorMessage . 'Property value is needed.'
                ]);
            }
            if (!$request->get('property_group')) {
                return response()->json([
                    'status' => false,
                    'errorMessage' => $this->errorMessage . 'Property group is needed.'
                ]);
            }
            $is_group_exist = $this->propertyGroup->where([
                'id' => $request->get('property_group')
            ])->exists();
            if (!$is_group_exist) {
                return response()->json([
                    'status' => false,
                    'errorMessage' => $this->errorMessage . 'Property group is not valid.'
                ]);
            }
            $this->property->create([
                'name' => $request->get('name'),
                'value' => $request->get('property_value'),
                'id_property_group' => $request->get('property_group')
            ]);

            return response()->json([
                'status' => true,
            ]);
        } else {
            return view('server::property.create')->with([
                'selectedNavItem' => self::selectedNavItem,
                'property_group' => $this->propertyGroup->getAll()
            ]);
        }
    }

    function createPropertyGroup(Request $request) {
        if ($request->isMethod('post')) {
            if (!$request->get('name')) {
                return response()->json([
                    'status' => false,
                    'errorMessage' => $this->errorMessage . 'Property name is needed.'
                ]);
            }
            $this->propertyGroup->create([
                'name' => $request->get('name'),
            ]);

            return response()->json([
                'status' => true,
            ]);
        } else {
            return view('server::property.create_group')->with([
                'selectedNavItem' => self::selectedNavItem,
            ]);
        }
    }

    public function formatData($property_data) {
        foreach($property_data as $property_data_item) {
            $date_time = explode(" ", $property_data_item->created_at)[0];
            $property_data_item->c_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $date_time = explode(" ", $property_data_item->updated_at)[0];
            $property_data_item->u_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
        }
        return $property_data;
    }
}
