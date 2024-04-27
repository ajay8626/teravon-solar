<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect(\route('login'));
});

Auth::routes();


Route::middleware(['auth'])->prefix('admin')->group(function (){

    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::view('about', 'about')->name('about');

    // Permissions
    Route::get('/all/permission', [App\Http\Controllers\Admin\RoleController::class, 'allPermission'])->name('admin.all.permission');
    Route::get('/add/permission', [App\Http\Controllers\Admin\RoleController::class, 'addPermission'])->name('admin.add.permission');
    Route::post('/store/permission', [App\Http\Controllers\Admin\RoleController::class, 'storePermission'])->name('admin.store.permission');
    Route::get('/edit/permission/{id?}', [\App\Http\Controllers\Admin\RoleController::class, 'editPermission'])->name('admin.edit.permission');
    Route::post('/update/permission/{id?}', [App\Http\Controllers\Admin\RoleController::class, 'updatePermission'])->name('admin.update.permission');
    Route::get('/delete/permission/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'deletePermission'])->name('admin.delete.permission');

    //Roles
    Route::get('/all/roles', [App\Http\Controllers\Admin\RoleController::class, 'allRoles'])->name('admin.all.roles');
    Route::get('/add/roles', [App\Http\Controllers\Admin\RoleController::class, 'addRoles'])->name('admin.add.roles');
    Route::post('/store/roles', [App\Http\Controllers\Admin\RoleController::class, 'storeRoles'])->name('admin.store.roles');
    Route::get('/edit/roles/{id?}', [\App\Http\Controllers\Admin\RoleController::class, 'editRoles'])->name('admin.edit.roles');
    Route::post('/update/roles/{id?}', [App\Http\Controllers\Admin\RoleController::class, 'updateRoles'])->name('admin.update.roles');
    Route::get('/delete/roles/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'deleteRoles'])->name('admin.delete.roles');
    
    Route::get('/add/roles/permission', [App\Http\Controllers\Admin\RoleController::class, 'addRolePermission'])->name('admin.add.roles.permission');
    Route::post('/roles/permission/store', [App\Http\Controllers\Admin\RoleController::class, 'rolePermissionStore'])->name('admin.roles.permission.store');
    Route::get('/all/roles/permission', [App\Http\Controllers\Admin\RoleController::class, 'allRolePermission'])->name('admin.all.roles.permission');
    Route::get('/edit/roles/permission/{id}', [App\Http\Controllers\Admin\RoleController::class, 'editRolePermission'])->name('admin.edit.roles.permission');
    Route::post('/update/roles/permission/{id?}', [App\Http\Controllers\Admin\RoleController::class, 'updateRolesPermission'])->name('admin.update.roles.permission');
    Route::get('/delete/roles/permission/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'deleteRolePermission'])->name('admin.delete.roles.permission');



    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');


    //Category
    Route::get('categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/add', [App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('admin.categories.add');
    Route::post('categories/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/edit/{id?}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categories/update/{id?}', [App\Http\Controllers\Admin\CategoryController::class, 'updateCategory'])->name('admin.categories.update');
    Route::get('categories/delete/{id?}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.categories.delete');
    
    //SubCategory
    Route::get('sub-categories', [App\Http\Controllers\Admin\SubCategoryController::class, 'index'])->name('admin.sub-categories.index');
    Route::get('sub-categories/add', [App\Http\Controllers\Admin\SubCategoryController::class, 'add'])->name('admin.sub-categories.add');
    Route::post('sub-categories/store', [App\Http\Controllers\Admin\SubCategoryController::class, 'store'])->name('admin.sub-categories.store');
    Route::get('sub-categories/edit/{id?}', [App\Http\Controllers\Admin\SubCategoryController::class, 'edit'])->name('admin.sub-categories.edit');
    Route::post('sub-categories/update/{id?}', [App\Http\Controllers\Admin\SubCategoryController::class, 'updateCategory'])->name('admin.sub-categories.update');
    Route::get('sub-categories/delete/{id?}', [App\Http\Controllers\Admin\SubCategoryController::class, 'delete'])->name('admin.sub-categories.delete');

    //Questions
    Route::get('general-check-points', [App\Http\Controllers\Admin\GeneralCheckPointsController::class, 'index'])->name('admin.general-check-points.index');
    Route::get('general-check-points/add', [App\Http\Controllers\Admin\GeneralCheckPointsController::class, 'add'])->name('admin.general-check-points.add');
    Route::post('general-check-points/store', [App\Http\Controllers\Admin\GeneralCheckPointsController::class, 'store'])->name('admin.general-check-points.store');
    Route::get('general-check-points/edit/{id?}', [App\Http\Controllers\Admin\GeneralCheckPointsController::class, 'edit'])->name('admin.general-check-points.edit');
    Route::post('general-check-points/update/{id?}', [App\Http\Controllers\Admin\GeneralCheckPointsController::class, 'updateCheckPoints'])->name('admin.general-check-points.update');
    Route::get('general-check-points/delete/{id?}', [App\Http\Controllers\Admin\GeneralCheckPointsController::class, 'delete'])->name('admin.general-check-points.delete');
    Route::post('general-check-points/getSubCategoryAjax', [App\Http\Controllers\Admin\GeneralCheckPointsController::class, 'getSubCategoryAjax'])->name('admin.general-check-points.getSubCategoryAjax');

    // Projects
    Route::get('project_details', [\App\Http\Controllers\Admin\ProjectDetailsController::class, 'index'])->name('admin.project_details.index');
    Route::get('project_details/add', [App\Http\Controllers\Admin\ProjectDetailsController::class, 'add'])->name('admin.project_details.add');
    Route::post('project_details/store', [App\Http\Controllers\Admin\ProjectDetailsController::class, 'store'])->name('admin.project_details.store');
    Route::get('project_details/edit/{id?}', [\App\Http\Controllers\Admin\ProjectDetailsController::class, 'edit'])->name('admin.project_details.edit');
    Route::post('project_details/update/{id?}', [App\Http\Controllers\Admin\ProjectDetailsController::class, 'updateProjectDetails'])->name('admin.project_details.update');
    Route::get('project_details/delete/{id}', [\App\Http\Controllers\Admin\ProjectDetailsController::class, 'delete'])->name('admin.project_details.delete');

    // Projects
    Route::get('projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('projects/add', [App\Http\Controllers\Admin\ProjectController::class, 'add'])->name('admin.projects.add');
    Route::post('projects/store', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('projects/edit/{id?}', [\App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::post('projects/update/{id?}', [App\Http\Controllers\Admin\ProjectController::class, 'updateProject'])->name('admin.projects.update');
    Route::get('projects/delete/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'delete'])->name('admin.projects.delete');

    //user
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/add', [App\Http\Controllers\UserController::class, 'add'])->name('admin.users.add');
    Route::post('users/store', [App\Http\Controllers\UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/edit/{id?}', [\App\Http\Controllers\UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('users/update/{id?}', [App\Http\Controllers\UserController::class, 'updateUser'])->name('admin.users.update');
    Route::get('users/delete/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('admin.users.delete');

    //Duration
    Route::get('durations', [App\Http\Controllers\Admin\DurationController::class, 'index'])->name('admin.durations.index');
    Route::get('durations/add', [App\Http\Controllers\Admin\DurationController::class, 'add'])->name('admin.durations.add');
    Route::post('durations/store', [App\Http\Controllers\Admin\DurationController::class, 'store'])->name('admin.durations.store');
    Route::get('durations/edit/{id?}', [App\Http\Controllers\Admin\DurationController::class, 'edit'])->name('admin.durations.edit');
    Route::post('durations/update/{id?}', [App\Http\Controllers\Admin\DurationController::class, 'updateDuration'])->name('admin.durations.update');
    Route::get('durations/delete/{id?}', [App\Http\Controllers\Admin\DurationController::class, 'delete'])->name('admin.durations.delete');
});
