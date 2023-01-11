<?php

namespace App\Http\Controllers\Backend\Trash;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PermissionTrashController extends Controller
{
    public function trash()
    {
        $permissions = Permission::onlyTrashed()->with(['module:id,module_name,module_slug'])->latest('id')
        ->select(['id', 'module_id','permission_name', 'permission_slug', 'updated_at'])->paginate(20);

        return view('admin.pages.permission.trash', compact('permissions'));
    }

    public function restore($permission_slug)
    {
        $permission = Permission::onlyTrashed()->where('permission_slug', $permission_slug)->first();
        $permission->restore();

        Toastr::success('Permission Restored Successfully!');
        return redirect()->back();
    }

    public function forceDelete($permission_slug)
    {
        $permission = Permission::onlyTrashed()->where('permission_slug', $permission_slug)->first();
        $permission->forceDelete();

        Toastr::info('Permission Deleted Permanently!');
        return redirect()->back();
    }
}
