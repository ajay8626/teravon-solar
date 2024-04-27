<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\StoreImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        $roles = Role::pluck('name', 'id');
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function add()
    {
        $roles = Role::all();
        $category = DB::table('categories')->pluck('name', 'id');
        return view('admin.users.add', compact('roles', 'category'));
    }

    

    public function store(Request $request){
        $data = $request->all();

        $user_id = $request->has('id') ? $request->input('id') : '';
        $name = $request->has('name') ? $request->input('name') : '';
        $email = $request->has('email') ? $request->input('email') : '';
        $roles = $request->has('role_id') ? $request->input('role_id') : '';

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'email', 'string'],
            'email' => ['required', 'email', 'string', Rule::unique('users')->ignore(Auth::user())],
            'mobile' => ['required'],
            'password' => ['nullable', 'string', 'confirmed', 'min:8'],
        ];
        $validator = Validator::make($data, $rules);
        //$data['assign_project'] = implode(",",$data['assign_project']);
        if(!$validator->fails()){
            $update_data = [
                'name'              => $data['name'],
                'email'             => $data['email'],
                'mobile'            => $data['mobile'],
                'roles'             => $data['role_id'],
                //'assign_project'    => $data['assign_project'],
            ];


            if($request->hasFile('signature_upload')) {
                $user_image = $request->file('signature_upload');
                $fileName = date('dmyHis').'_'.$user_image->getClientOriginalName();
                $destinationPath = public_path().'/signature' ;
                $user_image->move($destinationPath,$fileName);
                $update_data['signature_upload'] = $fileName;
            }
            if(!empty($data['password'])){
                $update_data['password'] = Hash::make($data['password']);
            }
            $user = User::create(
                $update_data
            );

            if($request->role_id){
                $user->assignRole($request->role_id);
            }    
           return redirect()->route('admin.users.index')->with('success', 'User added successfully');
        }
    }

    public function edit($id){
        $users = User::find($id);
        $category = DB::table('categories')->pluck('name', 'id');
        $roles = Role::all();
        $categoryId = explode(',', $users->assign_project);
        
        return view('admin.users.edit', compact('users', 'roles', 'category', 'categoryId'));
    }

    public function updateUser(Request $request, $id){
        $data = $request->all();
        dd($data);
        $rules = [
            'name'   => ['required', 'string', 'max:255'],
            'mobile' => ['required'],
            'email'  => ['required', 'email', 'string', 'max:255', Rule::unique('users')->ignore($id)],
        
        ];
        $validator = Validator::make($data, $rules);
        
        if(!$validator->fails()){
            $update_data = [
                'name'              => $data['name'],
                'email'             => $data['email'],
                'mobile'             => $data['mobile'],
                'roles'             => $data['role_id'],
            ];

            if(!empty($data['password'])){
                $update_data['password'] = Hash::make($data['password']);
            }
            
            if($request->hasFile('signature_upload')) {
                $user_image      = $request->file('signature_upload');
                $fileName        = date('dmyHis').'_'.$user_image->getClientOriginalName();
                $destinationPath = public_path().'/signature' ;
                $user_image->move($destinationPath,$fileName);
                $update_data['signature_upload']   = $fileName;
            }else{
                //echo "<pre>"; print_r($data); exit;
                if(isset($data['signature_upload']) && $data['signature_upload'] != ""){
                    $update_data['signature_upload'] = $data['signature_upload'];
                }
            }
            $userData = User::find($id);
            $userData->update($update_data);
            
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $userData->assignRole($request->input('role_id'));
            
            return redirect()->route('admin.users.index')->with('success', 'User update successfully');
        }
    }

    public function delete($id){
        $users = User::where('id',$id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'User delete successfully');
    }

}
