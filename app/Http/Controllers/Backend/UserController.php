<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-user');

        $users = User::latest('id')
        ->with(['role:id,role_name,role_slug', 'profile'])
        ->select(['id', 'role_id', 'name', 'email', 'is_active', 'updated_at'])->paginate(20);

        // return $users;
        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-user');

        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();
        return view('admin.pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-user');

        // dd($request->all());
        User::updateOrCreate([
            'role_id' => $request->role_id,
            'name' => ucwords($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Toastr::success('User Created Successfully 🙂');
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-user');

        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();
        $user = User::where('id', $id)->first();

        if ($user->email != 'shafi@gmail.com'){
            return view('admin.pages.user.edit', compact('roles', 'user'));
        } else {
            Toastr::error("You Have No Permission To Perform This Action 😞!!");
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-user');

        // dd($request->all(), $id);
        $user = User::where('id', $id)->first();
        $user->update([
            'role_id' => $request->role_id,
            'name' => ucwords($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Toastr::success('User Updated Successfully 🙂');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-user');

        $user = User::where('id', $id)->first();

        if ($user->email != 'shafi@gmail.com'){
            $user->delete();

            Toastr::success('User Deleted Successfully 🙂');
            return redirect()->route('users.index');
        }else {
            Toastr::error("Admin Cannot be Deleted 😡!!");
            return redirect()->route('users.index');
        }
    }

    public function checkActive($user_id)
    {
        $user = User::find($user_id);
        //toggle the is-active
        if($user->is_active == 1){
            $user->is_active = 0;
        }else{
            $user->is_active = 1;
        }

        $user->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Update'
        ]);
    }
}
