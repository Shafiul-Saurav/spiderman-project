<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\Trash\ModuleTrashController;
use App\Http\Controllers\Backend\Trash\PermissionTrashController;
use App\Http\Controllers\Backend\Trash\RoleTrashController;
use App\Http\Controllers\Backend\Trash\UserTrashController;
use App\Http\Controllers\Backend\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth'])->group(function(){
    //Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Module Route
    Route::get('module/trash', [ModuleTrashController::class, 'trash'])
    ->name('module.trash');
    Route::get('module/{module_slug}/restore', [ModuleTrashController::class, 'restore'])
    ->name('module.restore');
    Route::delete('module/{module_slug}/forcedelete', [ModuleTrashController::class, 'forceDelete'])
    ->name('module.forcedelete');
    Route::resource('module', ModuleController::class);

    //Permission Route
    Route::get('permission/trash', [PermissionTrashController::class, 'trash'])
    ->name('permission.trash');
    Route::get('permission/{permission_slug}/restore', [PermissionTrashController::class, 'restore'])
    ->name('permission.restore');
    Route::delete('permission/{permission_slug}/forcedelete', [PermissionTrashController::class, 'forceDelete'])
    ->name('permission.forcedelete');
    Route::resource('permission', PermissionController::class);

    //Role Route
    Route::get('role/trash', [RoleTrashController::class, 'trash'])
    ->name('role.trash');
    Route::get('role/{role_slug}/restore', [RoleTrashController::class, 'restore'])
    ->name('role.restore');
    Route::delete('role/{role_slug}/forcedelete', [RoleTrashController::class, 'forceDelete'])
    ->name('role.forcedelete');
    Route::resource('role', RoleController::class);

    //User Route
    Route::get('users/trash', [UserTrashController::class, 'trash'])
    ->name('users.trash');
    Route::get('users/{id}/restore', [UserTrashController::class, 'restore'])
    ->name('users.restore');
    Route::delete('users/{id}/forcedelete', [UserTrashController::class, 'forceDelete'])
    ->name('users.forcedelete');
    Route::resource('users', UserController::class);
});
