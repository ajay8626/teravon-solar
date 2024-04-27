<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function allPermission($value='')
    {
        $permission = Permission::all();
        return view('admin.pages.permission.all_permission', compact('permission'));
    }

    public function addPermission($value='')
    {
        return view('admin.pages.permission.add_permission');
    }

    public function storePermission(Request $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Create Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.all.permission')->with($notification);
    }

    public function editPermission(Request $request, $id)
    {
        $permission = Permission::where('id',$id)->first();
        return view('admin.pages.permission.edit_permission', compact('permission'));
    }

    public function updatePermission(Request $request, $id)
    {
        $user_id = $request->id;
        $permission = Permission::findorfail($user_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.all.permission')->with($notification);
    }

    public function deletePermission($id)
    {
        $permission = Permission::findorfail($id)->delete();
        $notification = array(
            'message' => 'Permission Delete Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.all.permission')->with($notification);
    }

    public function allRoles(){
        $roles = Role::all();
        return view('admin.pages.roles.all_roles', compact('roles'));
    }

    public function addRoles(){
        return view('admin.pages.roles.add_roles');
    }

    public function storeRoles(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Role Create Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.all.roles')->with($notification);
    }

    public function editRoles(Request $request, $id)
    {
        $roles = Role::where('id',$id)->first();
        return view('admin.pages.roles.edit_roles', compact('roles'));
    }

    public function updateRoles(Request $request, $id)
    {
        $user_id = $request->id;
        $role = Role::findorfail($user_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.all.roles')->with($notification);
    }

    public function deleteRoles($id)
    {
        $role = Role::findorfail($id)->delete();
        $notification = array(
            'message' => 'Role Delete Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.all.roles')->with($notification);
    }

    public function addRolePermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.pages.rolesetup.add_role_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function rolePermissionStore(Request $request)
    {
        $data = [];
        $permissions = $request->permission;
        foreach($permissions as $key => $val){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $val;
            DB::table('role_has_permissions')->insert($data);
        } 
        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.all.roles.permission')->with($notification);
    }

    public function allRolePermission(){
        $roles = Role::all();
        return view('admin.pages.rolesetup.all_role_permission', compact('roles'));
    }

    public function editRolePermission($id){
        $role = Role::findorfail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.pages.rolesetup.edit_role_permission', compact('role', 'permissions', 'permission_groups'));

    }

    public function updateRolesPermission(Request $request, $id)
    {
        $role = Role::findorfail($id);
        $permissions = $request->permission;
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.all.roles.permission')->with($notification);
    }

    public function deleteRolePermission($id){
        $role = Role::findorfail($id);
        if(!is_null($role)){
            $role->delete();
        }
        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
