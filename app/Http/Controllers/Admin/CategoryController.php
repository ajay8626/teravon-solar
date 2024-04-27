<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    

    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('admin.category.index', ['categories' => $categories])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $requestData = $request->all();
        Category::create($requestData);
        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully');

    }

    public function edit($id) {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.add', compact('category'));
    }

    public function updateCategory(Request $request, $id) {
        $request->validate([
            'name' => 'required',
        ]);
        $requestData = $request->all();
        $categoryData = DB::table('categories')->where('id', $id)->update(['name' => $requestData['name'], 'updated_at' => now()]);
        
        return redirect()->route('admin.categories.index')->with('success', 'Category update successfully');
    }

    public function delete($id){
        DB::table('categories')->where('id', $id)->delete();
        DB::table('sub_categories')->where('category_id', $id)->delete();
        return redirect()->back()->with('success','Category Deleted!');
    }


    public function addSubCategory(){
        
    }

}
