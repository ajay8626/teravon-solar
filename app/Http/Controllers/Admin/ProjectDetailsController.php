<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Projects;
use Illuminate\Support\Facades\DB;

class ProjectDetailsController extends Controller
{
    

    public function index()
    {
        $project_details = DB::table('project_details')->get();
        $categorieName = DB::table('categories')->pluck('name', 'id');
        $subCategoryName = DB::table('sub_categories')->pluck('sub_category_name', 'id');
        
        return view('admin.project_details.index', compact( 'project_details', 'categorieName', 'subCategoryName'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add()
    {
        $categorieName = DB::table('categories')->pluck('name', 'id');
        $sub_categories = DB::table('sub_categories')->get();

        return view('admin.project_details.add', compact( 'sub_categories', 'categorieName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['project_date'] = date("Y-m-d", strtotime($requestData['project_date']));
        $requestData['categories_id'] = implode(",",$requestData['categories_id']);
        $requestData['subcategories_id'] = implode(",",$requestData['subcategories_id']);
        //Projects::create($requestData);
        return redirect()->route('admin.project_details.index')->with('success', 'Category added successfully');

    }

    public function edit($id) {
        $project_details = DB::table('project_details')->where('id', $id)->first();
        $categorieName = DB::table('categories')->pluck('name', 'id');
        $sub_categories = DB::table('sub_categories')->get();
        $categoryId = explode(',', $project_details->categories_id);
        $subcategoriesId = explode(',', $project_details->subcategories_id);
        return view('admin.project_details.add', compact('project_details', 'categorieName', 'sub_categories', 'categoryId', 'subcategoriesId'));
    }

    public function updateProjectDetails(Request $request, $id) {
        $request->validate([
            'company_name' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['project_date'] = date("Y-m-d", strtotime($requestData['project_date']));
        $requestData['categories_id'] = implode(",",$requestData['categories_id']);
        $requestData['subcategories_id'] = implode(",",$requestData['subcategories_id']);
        $projectData = DB::table('project_details')->where('id', $id)->update([
            'company_name'      => $requestData['company_name'],
            'address'           => $requestData['address'],
            'capacity'          => $requestData['capacity'],
            'project_date'      => $requestData['project_date'],
            'categories_id'     => $requestData['categories_id'],
            'subcategories_id'  => $requestData['subcategories_id'],
            'updated_at' => now()]);
        
        return redirect()->route('admin.project_details.index')->with('success', 'Project update successfully');
    }

    public function delete($id){
        DB::table('project_details')->where('id', $id)->delete();
        return redirect()->back()->with('success','Project Deleted!');
    }


}
