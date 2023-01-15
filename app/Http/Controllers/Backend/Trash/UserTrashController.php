<?php

namespace App\Http\Controllers\Backend\Trash;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class UserTrashController extends Controller
{
    public function trash()
    {
        $users = User::onlyTrashed()->latest('id')
        ->with(['role:id,role_name,role_slug'])
        ->select(['id', 'role_id', 'name', 'email', 'updated_at'])->paginate(20);

        return view('admin.pages.user.trash', compact('users'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->restore();

        Toastr::success('User Restored Successfully 🙂');
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->forceDelete();

        Toastr::info('User Deleted Permanently 🙂');
        return redirect()->back();
    }

}
