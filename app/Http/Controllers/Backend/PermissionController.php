<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PermissionStoreUpdateRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-permission');

        $permissions = Permission::with(['module:id,module_name,module_slug'])->latest('id')
        ->select(['id', 'module_id','permission_name', 'permission_slug', 'updated_at'])->paginate(20);

        return view('admin.pages.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-permission');

        $modules = Module::select(['id', 'module_name'])->get();
        return view('admin.pages.permission.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreUpdateRequest $request)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-permission');

        Permission::create([
            'module_id' => $request->module_id,
            'permission_name' => $request->permission_name,
            'permission_slug' => Str::slug($request->permission_name),
        ]);

        Toastr::success('Permission Created Successfully!');
        return redirect()->route('permission.index');
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
    public function edit($permission_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-permission');

        $modules = Module::select(['id', 'module_name'])->get();
        $permission = Permission::where('permission_slug', $permission_slug)->first();

        return view('admin.pages.permission.edit', compact('permission', 'modules'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionStoreUpdateRequest $request, $permission_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-permission');

        $permission = Permission::where('permission_slug', $permission_slug)->first();
        $permission->update([
            'module_id' => $request->module_id,
            'permission_name' => $request->permission_name,
            'permission_slug' => Str::slug($request->permission_name),
        ]);

        Toastr::success('Permission Updated Successfully!');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($permission_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-permission');

        $permission = Permission::where('permission_slug', $permission_slug)->first();
        $permission->delete();

        Toastr::success('Permission Deleted Successfully!');
        return redirect()->route('permission.index');
    }
}
