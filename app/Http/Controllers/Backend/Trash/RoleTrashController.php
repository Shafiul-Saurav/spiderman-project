<?php

namespace App\Http\Controllers\Backend\Trash;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class RoleTrashController extends Controller
{
    public function trash()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-role');

        $roles = Role::onlyTrashed()->with(['permissions:id,permission_name,permission_slug'])
        ->select(['id', 'role_name', 'role_slug', 'role_note', 'is_deletable', 'updated_at'])
        ->paginate(20);

        return view('admin.pages.role.trash', compact('roles'));
    }

    public function restore($role_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-role');

        $role = Role::onlyTrashed()->where('role_slug', $role_slug)->first();
        $role->restore();

        Toastr::success('Role Restored Successfully 🙂');
        return redirect()->back();
    }

    public function forceDelete($role_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-role');

        $role = Role::onlyTrashed()->where('role_slug', $role_slug)->first();
        $role->forceDelete();

        Toastr::success('Role Deleted Permanently 🙂');
        return redirect()->back();
    }
}
