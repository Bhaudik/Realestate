<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\UserController;
use App\Models\PropertyType;
use Illuminate\Foundation\Auth\User;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// admin group midlleware
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});

// admin group midlleware

Route::middleware('auth', 'role:agent')->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});

Route::get('admin/login', [AdminController::class, 'AdminLogin'])
    ->name('admin.login');

//property all route
Route::middleware('auth', 'role:admin')->group(function () {
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'AllType')->name('all.type');
        Route::get('/add/type', 'AddType')->name('add.type');
        Route::post('/store/type', 'storeType')->name('store.type');
        Route::get('/edit/type/{id}', 'editType')->name('edit.type');
        Route::get('/delete/type/{id}', 'deleteType')->name('delete.type');
        Route::post('/update/type', 'updateType')->name('update.type');
    });

    //Amenities all Route

    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
        Route::get('/add/amenities', 'AddAmenities')->name('add.amenities');
        Route::post('/store/amenities', 'storeAmenities')->name('store.amenities');
        Route::get('/edit/amenities/{id}', 'editAmenities')->name('edit.amenities');
        Route::get('/delete/amenities/{id}', 'deleteAmenities')->name('delete.amenities');
        Route::post('/update/amenities', 'updateAmenities')->name('update.amenities');
    });

    // All Permission Route

    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');

        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'storePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'editPermission')->name('edit.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
        Route::post('/update/permission', 'updatePermission')->name('update.permission');

        // Export route
        Route::get('/export/permissions', 'exportPermissions')->name('export.permissions');

        // Import route
        Route::get('/import/permissions', 'importPermissionsView')->name('import.permissions.view');
        Route::post('/import/permissions', 'importPermissions')->name('import.permissions');

        // All ROles Route

        Route::get('/all/roles', 'AllRoles')->name('all.roles');

        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'storeRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'editRoles')->name('edit.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
        Route::post('/update/roles', 'updateRoles')->name('update.roles');

        // add role permistion 

        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('roles.permission.store');
        Route::get('all/role/permission', 'allRolePermission')->name('all.roles.permission');
        Route::get('admin/role/edit/{id}', 'AdminEditRole')->name('admin.edit.permission');
        Route::post('admin/role/updates/{id}', 'AdminRolesUpdates')->name('admin.roles.updates');
        Route::get('admin/role/delete/{id}', 'AdminRolesDelete')->name('admin.roles.delete');
    });
});



// Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
