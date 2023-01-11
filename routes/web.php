<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\Trash\ModuleTrashController;

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
});
