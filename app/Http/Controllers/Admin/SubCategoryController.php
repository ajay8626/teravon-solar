<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    

    public function index()
    {
        $category = DB::table('categories')->pluck('name', 'id');
        $categories = DB::table('sub_categories')->get();
        return view('admin.sub-category.index', ['categories' => $categories, 'category' => $category])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add()
    {
        $categories = DB::table('categories')->get();
        $sub_categories = DB::table('sub_categories')->get();
        return view('admin.sub-category.add',['categories' => $categories, 'sub_categories' => $sub_categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required',
        ]);
        $requestData = $request->all();
        SubCategory::create($requestData);
        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub category added successfully');

    }

    public function edit($id) {
        $categories = DB::table('categories')->get();
        $sub_categories = DB::table('sub_categories')->where('id', $id)->first();
        return view('admin.sub-category.edit', compact('sub_categories', 'categories'));
    }

    public function updateCategory(Request $request, $id) {
        $request->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required',
        ]);
        $requestData = $request->all();
        $categoryData = DB::table('sub_categories')->where('id', $id)->update(['category_id' => $requestData['category_id'],'sub_category_name' => $requestData['sub_category_name'], 'updated_at' => now()]);
        
        return redirect()->route('admin.sub-categories.index')->with('success', 'Category update successfully');
    }

    public function delete($id){
        DB::table('sub_categories')->where('id', $id)->delete();
        return redirect()->back()->with('success','Category Deleted!');
    }

}
