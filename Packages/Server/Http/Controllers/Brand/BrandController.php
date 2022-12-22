<?php

namespace Packages\Server\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Packages\Server\Repository\Brand\BrandRepository;
use Illuminate\Support\Str;

class BrandController extends Controller {
    public const selectedNavItem = 'Brand';
    public $brand;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\brand';

    public function __construct(BrandRepository $brand)
    {
        $this->brand = $brand;
    }

    // Get brand list page
    public function getBrand() {
        $stt = 1;
        $brand_data = $this->brand->getAll();
        foreach($brand_data as $brand_data_item)  {
            $brand_data_item->stt = $stt++;
            $brand_data_item->status = $brand_data_item->status ? 'Enabled' : 'Disabled';
            $date_time = explode(" ", $brand_data_item->created_at)[0];
            $brand_data_item->c_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $brand_data_item->thumbnail = $brand_data_item->thumbnail ? $this->asset_image . 'brand/' . $brand_data_item->thumbnail : '';
        }
        return view('server::brand.brand')->with('brand_data', $brand_data)->with(['selectedNavItem' => self::selectedNavItem]);
    }

    // Post update brand status
    public function updateStatus(Request $request) {
        $brand_id = $request->get('id', 0);
        $status = $request->get('status', 1);

        try {
            if ($brand_id) {
                $this->brand->update($brand_id, ['status' => $status]);
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

    public function searchBrand(Request $request) {
        try {
            $brand_data = $this->brand->searchByName($request->get('name', ''));
            $stt = 1;
            foreach($brand_data as $brand_data_item)  {
                $brand_data_item->stt = $stt++;
                $brand_data_item->status = $brand_data_item->status ? 'Enabled' : 'Disabled';
                $date_time = explode(" ", $brand_data_item->created_at)[0];
                $brand_data_item->c_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
                $brand_data_item->thumbnail = $brand_data_item->thumbnail ? $this->asset_image . 'brand/' . $brand_data_item->thumbnail : '';
            }

            return response()->json([
                'status' => true,
                'data' => $brand_data,
                'html' => view('server::brand.brand_list')->with('brand_data', $brand_data)->render()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => '',
                'html' => '',
                'errrorMessage' => $e->getMessage()
            ]);
        }

    }

    // Create brand
    public function createBrand(Request $request) {
        if ($request->isMethod('post')) {
            // Do nothing
            $date = Carbon::now()->format('dmhis');

            $imageName = $this->imageUploadPost($request, $date);
            if (!$imageName) {
                return back()->withErrors($this->errorMessage . 'Invalid image');
            }
            $attributes = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'slug' => Str::slug($request->get('name') . '-' . $date),
                'status' => 1,
                'thumbnail' => $imageName
            ];
            $this->brand->create($attributes);
            return redirect()->route('server.brand.get');
        } else {
            return view('server::brand.create')->with(['selectedNavItem' => self::selectedNavItem]);
        }
    }

    public function editBrand(Request $request) {
        if ($request->isMethod('post')) {
            // Do nothing
            $date = Carbon::now()->format('dmhis');

            $imageName = '';
            if ($request->hasFile('img')) {
                $imageName = $this->imageUploadPost($request, $date);
            }

            $attributes = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'slug' => Str::slug($request->get('name') . '-' . $date),
                'status' => 1,
            ];

            if (!empty($imageName)) {
                $attributes['thumbnail'] = $imageName;
            }
            $brand_id = ($this->brand->getBrandBySlug($request->get('slug', '')))[0]->id;
            $this->brand->update($brand_id, $attributes);
            return redirect()->route('server.brand.get')->with(['selectedNavItem' => self::selectedNavItem])->with('success', 'Update category successfull.');
        } else {
            $slug = $request->get('slug', '');
            if (!$slug) {
                return back()->withErrors($this->errorMessage . 'Not exist brand');
            } else {
                $brand_data = ($this->brand->getBrandBySlug($slug))[0];
                $brand_data->img = $brand_data->thumbnail ? $this->asset_image . 'brand/' . $brand_data->thumbnail : '';
            }

            return view("server::brand.edit")->with(['slug' => $slug, 'brand_data' => $brand_data]);
        }
    }

    public function imageUploadPost(Request $request, $date)
    {
        try {
            $imageName = '';
            if ($request->hasFile('img')) {
                $image = $request->file('img')[0]->getClientOriginalName();
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                $imageName = $imageName . '-' . $date . '.png';
                $request->file('img')[0]->move(base_path() . $this->resouces_directory, $imageName);
                $request->file('img')[0]->move(public_path() . $this->asset_image . '\brand', $imageName);
            }

            return $imageName;
        } catch (\Exception $e) {
            logger()->error($this->errorMessage . $e->getMessage());
            return '';
        }

    }
}
