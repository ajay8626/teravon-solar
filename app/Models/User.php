<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'roles',
        'password',
        'signature_upload',
        'assign_project',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const IMG_PATH = "app/public/users/";
    const IMG_URL = "storage/users/";

    const ROLES = [1 =>'Admin', 2 =>'Project Head', 3 => 'Maintenance Engineer'];


    public static function getPermissionGroups(){
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    }

    public static function getPermissionByGroupName($group_name){
        $permissions = DB::table('permissions')
                        ->select('name', 'id')
                        ->where('group_name',  $group_name)
                        ->get();
        return $permissions;
    }

    public static function roleHasPermission( $role, $permissions){
        $hasPermission = true;
        foreach($permissions as $permission){
            if( !$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
            }
            //echo "<pre>"; var_dump($hasPermission); exit;
            return $hasPermission;
        }
    }

    public function getRole(){
        $roles = $this->belongsToMany('roles','role_id');
        return $roles;
    }
}
