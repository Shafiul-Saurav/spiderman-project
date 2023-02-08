<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\BackupController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\Trash\PageTrashController;
use App\Http\Controllers\Backend\Trash\RoleTrashController;
use App\Http\Controllers\Backend\Trash\UserTrashController;
use App\Http\Controllers\Backend\Trash\ModuleTrashController;
use App\Http\Controllers\Backend\Trash\PermissionTrashController;
use App\Http\Controllers\Frontend\FrontendController;

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

Route::get('page/{page_slug}', [FrontendController::class, 'index']);

Auth::routes();

//Socialite Login Routes
Route::group(['as' => 'login.', 'prefix' => 'login'], function() {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])
    ->name('provider.callback');
});


//Axios Call
Route::get('get-districts/{division_id}', [ProfileController::class, 'getDistrict']);
Route::get('get-upazilas/{district_id}', [ProfileController::class, 'getUpazila']);
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
    //Ajax Call Active
    Route::get('check/user/is_active/{user_id}', [UserController::class, 'checkActive'])
    ->name('user.is_active.ajax');
    Route::resource('users', UserController::class);

    //Profile Route
    Route::get('update/password', [ProfileController::class, 'getUpdatePassword'])
    ->name('getupdate.password');
    Route::post('update/password', [ProfileController::class, 'updatePassword'])
    ->name('postupdate.password');
    Route::resource('profile', ProfileController::class);

    //Page Route
    //Ajax Call Active
    Route::get('page/trash', [PageTrashController::class, 'trash'])
    ->name('page.trash');
    Route::get('page/{page_slug}/restore', [PageTrashController::class, 'restore'])
    ->name('page.restore');
    Route::delete('page/{page_slug}/forcedelete', [PageTrashController::class, 'forceDelete'])
    ->name('page.forcedelete');
    Route::get('check/page/is_active/{page_id}', [PageController::class, 'checkActive'])
    ->name('page.is_active.ajax');
    Route::resource('page', PageController::class);

    //Backup Route
    Route::get('/backup/download/{file_name}', [BackupController::class, 'download'])
    ->name('backup.download');
    Route::resource('backup', BackupController::class)->only(['index', 'store', 'destroy']);

    //System Setting Management Routes
    Route::group(['as' => 'settings.', 'prefix' => 'settings'], function() {
        //General Setting Route
        Route::get('general', [SettingController::class, 'general'])->name('general');
        Route::post('general', [SettingController::class, 'generalUpdate'])->name('general.update');

        //Apperance Setting Route
        Route::get('apperance', [SettingController::class, 'apperance'])->name('apperance');
        Route::post('apperance', [SettingController::class, 'apperanceUpdate'])->name('apperance.update');

        //Mail Setting Route
        Route::get('mail', [SettingController::class, 'mailView'])->name('mail');
        Route::post('mail', [SettingController::class, 'mailUpdate'])->name('mail.update');
    });
});
