<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Duration;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    

    public function index()
    {
        $projects = Project::all();
        $users = User::pluck('name', 'id');
        $categories = DB::table('categories')->pluck('name', 'id');
        $subCategories = DB::table('sub_categories')->pluck('sub_category_name', 'id');
        return view('admin.projects.index', compact('projects', 'users', 'categories', 'subCategories'));
    }

    public function add()
    {
        $users = User::pluck('name', 'id');
        $categories = DB::table('categories')->pluck('name', 'id');
        $subCategories = DB::table('sub_categories')->pluck('sub_category_name', 'id');
        return view('admin.projects.add', compact('users', 'categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_of_client' => 'required',
        ]);
        $requestData = $request->all();
        $permission = Project::create([
            'name_of_client'            => $request->name_of_client,
            'address'                   => $request->address,
            'capacity_ac'               => $request->capacity_ac,
            'capacity_dc'               => $request->capacity_dc,
            'project_commissioned_on'   => $request->project_commissioned_on,
            'no_of_panels'              => $request->no_of_panels,
            'watt_peak'                 => $request->watt_peak,
            'category'                  => $request->category,
            'subcategory'               => $request->subcategory,
            'project_head'              => $request->project_head,
            'maintenance_engg'          => $request->maintenance_engg,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.projects.index')->with('success', 'Project added successfully');

    }

    public function edit($id) {
        $project = Project::findorfail($id);
        $users = User::pluck('name', 'id');
        $categories = DB::table('categories')->pluck('name', 'id');
        $subCategories = DB::table('sub_categories')->pluck('sub_category_name', 'id');
        return view('admin.projects.edit', compact('project', 'users', 'categories', 'subCategories'));
    }

    public function updateProject(Request $request, $id) {
        $request->validate([
            'name_of_client' => 'required',
        ]);
        $requestData = $request->all();
        $permission = Project::findorfail($id)->update([
            'name_of_client'            => $request->name_of_client,
            'address'                   => $request->address,
            'capacity_ac'               => $request->capacity_ac,
            'capacity_dc'               => $request->capacity_dc,
            'project_commissioned_on'   => $request->project_commissioned_on,
            'no_of_panels'              => $request->no_of_panels,
            'watt_peak'                 => $request->watt_peak,
            'category'                  => $request->category,
            'subcategory'               => $request->subcategory,
            'project_head'              => $request->project_head,
            'maintenance_engg'          => $request->maintenance_engg,
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.projects.index')->with('success', 'Project update successfully');
    }

    public function delete($id){
        Project::find($id)->delete();
        return redirect()->back()->with('success','Project Deleted!');
    }

    protected function categorySubCategory(){
        $name['category'] = DB::table('categories')->pluck('name', 'id');
        $name['subCategories'] = DB::table('sub_categories')->pluck('sub_category_name', 'id');
        return $name;
    }

}
