<?php

namespace App\Http\Controllers\Backend\Trash;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserTrashController extends Controller
{
    public function trash()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-user');

        $users = User::onlyTrashed()->latest('id')
        ->with(['role:id,role_name,role_slug', 'profile'])
        ->select(['id', 'role_id', 'name', 'email', 'updated_at'])->paginate(20);

            return view('admin.pages.user.trash', compact('users'));
    }

    public function restore($id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-user');

        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->restore();

        Toastr::success('User Restored Successfully 🙂');
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-user');

        $user = User::onlyTrashed()->with('profile')->where('id', $id)->first();
        if($user->profile->user_image != 'default_user.jpg'){
            $photo_location = 'uploads/users/'.$user->profile->user_image;
            unlink($photo_location);
        }
        $user->forceDelete();

        Toastr::info('User Has Been Deleted Permanently 🙂');
        return redirect()->back();
    }

}
