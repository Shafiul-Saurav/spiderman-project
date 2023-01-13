<?php

namespace App\Http\Controllers\Backend\Trash;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class RoleTrashController extends Controller
{
    public function trash()
    {
        $roles = Role::onlyTrashed()->with(['permissions:id,permission_name,permission_slug'])
        ->select(['id', 'role_name', 'role_slug', 'role_note', 'is_deletable', 'updated_at'])
        ->paginate(20);

        return view('admin.pages.role.trash', compact('roles'));
    }

    public function restore($role_slug)
    {
        $role = Role::onlyTrashed()->where('role_slug', $role_slug)->first();
        $role->restore();

        Toastr::success('Role Restored Successfully 🙂');
        return redirect()->back();
    }

    public function forceDelete($role_slug)
    {
        $role = Role::onlyTrashed()->where('role_slug', $role_slug)->first();
        $role->forceDelete();

        Toastr::success('Role Deleted Permanently 🙂');
        return redirect()->back();
    }
}
