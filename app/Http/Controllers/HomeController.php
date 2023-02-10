<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('access-dashboard');

        $user_count = User::count();
        $role_count = Role::count();
        $module_count = Module::count();
        $permission_count = Permission::count();
        $users = User::with('role')->latest('id')->paginate(10000);

        return view('admin.pages.dashboard', compact(
            'user_count',
            'role_count',
            'module_count',
            'permission_count',
            'users'));
    }
}
