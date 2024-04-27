<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralCheckPoints;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

class GeneralCheckPointsController extends Controller
{
    

    public function index()
    {
        $general_check_points = DB::table('general_check_points')->get();
        $frequency = GeneralCheckPoints::FREQUENCY;
        $status = GeneralCheckPoints::STATUS;
        $categories = DB::table('categories')->pluck('name', 'id');
        $subCategories = DB::table('sub_categories')->pluck('sub_category_name', 'id');
        return view('admin.general-check-points.index', compact('general_check_points', 'categories', 'subCategories','frequency', 'status'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add()
    {
        $frequency = GeneralCheckPoints::FREQUENCY;
        $status = GeneralCheckPoints::STATUS;
        $categories = DB::table('categories')->get();
        return view('admin.general-check-points.add', compact('frequency', 'status', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'check_points_question' => 'required',
            'frequency' => 'required',
        ]);
        $requestData = $request->all();
        GeneralCheckPoints::create($requestData);
        return redirect()->route('admin.general-check-points.index')->with('success', 'Questions added successfully');

    }

    public function edit($id) {
        $frequency = GeneralCheckPoints::FREQUENCY;
        $status = GeneralCheckPoints::STATUS;
        $generalCheckPoints = DB::table('general_check_points')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        $subCategories = DB::table('sub_categories')->pluck('sub_category_name', 'id');

        return view('admin.general-check-points.edit', compact('generalCheckPoints', 'status', 'frequency', 'categories', 'subCategories'));
    }

    public function updateCheckPoints(Request $request, $id) {
        $request->validate([
            'check_points_question' => 'required',
            'frequency' => 'required',
        ]);
        $requestData = $request->all();
        
        $categoryData = DB::table('general_check_points')->where('id', $id)->update(['category_id' => $requestData['category_id'], 'sub_category_id'=> $requestData['sub_category_id'], 'sr_no'=> $requestData['sr_no'], 'check_points_question'=> $requestData['check_points_question'], 'frequency'=> $requestData['frequency'], 'updated_at' => now()]);
        
        return redirect()->route('admin.general-check-points.index')->with('success', 'Category update successfully');
    }

    public function delete($id){
        DB::table('general_check_points')->where('id', $id)->delete();
        return redirect()->back()->with('success','Category Deleted!');
    }

    public function getSubCategoryAjax(){
        //echo "<pre>"; print_r(); exit;
        if($_POST['cat_id'] > 0){
            $parent_id = $_POST['cat_id'];
            $subcategories = DB::table('sub_categories')->where('category_id', $parent_id)->pluck('sub_category_name', 'id');
            return response()->json([
                'subcategories' => $subcategories
            ]);
        }
    }

}
