<?php

namespace App\Http\Controllers\Backend\Trash;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class ModuleTrashController extends Controller
{
    public function trash()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-module');

        $modules = Module::onlyTrashed()->latest('id')
        ->select(['id', 'module_name', 'module_slug', 'updated_at'])
        ->paginate(20);

        return view('admin.pages.module.trash', compact('modules'));
    }

    public function restore($module_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-module');

        $module = Module::onlyTrashed()->where('module_slug', $module_slug)->first();
        $module->restore();

        Toastr::success('Module Restored Successfully!');
        return redirect()->back();
    }

    public function forceDelete($module_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-module');

        $module = Module::onlyTrashed()->where('module_slug', $module_slug)->first();
        $module->forceDelete();

        Toastr::info('Module deleted Permanently!');
        return redirect()->back();
    }
}
