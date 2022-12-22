<?php

namespace Packages\Server\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Packages\Server\Repository\Category\CategoryRepository;

class CategoryController extends Controller {
    public const selectedNavItem = 'Category';
    public $category;
    public $resouces_directory = '\Packages\Server\Resources\assets\images\category';

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    // Get category list page
    public function getCategory() {
        $stt = 1;
        $category_date = $this->category->getAll();
        foreach($category_date as $category_date_item)  {
            $category_date_item->stt = $stt++;
            $category_date_item->status = $category_date_item->status ? 'Enabled' : 'Disabled';
            $date_time = explode(" ", $category_date_item->created_at)[0];
            $category_date_item->c_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            $date_time = explode(" ", $category_date_item->updated_at)[0];
            $category_date_item->u_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
        }
        return view('server::category.category')->with('category_date', $category_date)->with(['selectedNavItem' => self::selectedNavItem]);
    }

    // Post update category status
    public function updateStatus(Request $request) {
        $category_id = $request->get('id', 0);
        $status = $request->get('status', 1);

        try {
            if ($category_id) {
                $this->category->update($category_id, ['status' => $status]);
                return response()->json([
                    'status' =>  $this->success_status,
                ]);
            } else {
                return response()->json([
                    'status' =>  $this->error_status,
                    'errorMessage' => 'Failed on update category info.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => $this->error_status,
                'errorMessage' => $e->getMessage()
            ]);
        }
    }

    public function searchCategory(Request $request) {
        try {
            $category_data = $this->category->searchByName($request->get('name', ''));
            $stt = 1;
            foreach($category_data as $category_date_item)  {
                $category_date_item->stt = $stt++;
                $category_date_item->status = $category_date_item->status ? 'Enabled' : 'Disabled';
                $date_time = explode(" ", $category_date_item->created_at)[0];
                $category_date_item->c_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
                $date_time = explode(" ", $category_date_item->updated_at)[0];
                $category_date_item->u_at = explode("-", $date_time)[2] . '-' . explode("-", $date_time)[1] . '-' .explode("-", $date_time)[0];
            }

            return response()->json([
                'status' => true,
                'data' => $category_data,
                'html' => view('server::category.category_list')->with('category_data', $category_data)->render()
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
    public function createCategory(Request $request) {
        if ($request->isMethod('post')) {
            // Do nothing
            $date = Carbon::now()->format('dmhis');

            $attributes = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'slug' => Str::slug($request->get('name') . '-' . $date),
                'status' => 1,
            ];
            $this->category->create($attributes);
                return redirect()->route('server.category.get')->with('success', 'Create category successfull.');
        } else {
            return view('server::category.create')->with(['selectedNavItem' => self::selectedNavItem]);
        }
    }

    public function editCategory(Request $request) {
        if ($request->isMethod('post')) {
            // Do nothing
            $attributes = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'status' => 1,
            ];
            $category_id = ($this->category->getCategoryBySlug($request->get('slug')))[0]->id;
            $this->category->update($category_id, $attributes);
            return redirect()->route('server.category.get')->with(['selectedNavItem' => self::selectedNavItem])->with('success', 'Update category successfull.');
        } else {
            $slug = $request->get('slug', '');
            if (!$slug) {
                return back()->withErrors($this->errorMessage . 'Not exist category');
            } else {
                $category_data = ($this->category->getCategoryBySlug($slug))[0];
            }

            return view("server::category.edit")->with(['slug' => $slug, 'category_data' => $category_data])->with(['selectedNavItem' => self::selectedNavItem]);
        }
    }
}
