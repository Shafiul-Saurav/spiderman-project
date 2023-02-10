<?php

namespace App\Http\Controllers\Backend;

use App\Models\Profile;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfilePasswordChangeRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('profile-update');
        $divisions = Division::select(['id', 'name'])->get();
        // dd($divisions);
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('admin.pages.profile.update_profile', compact('divisions', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.profile.update_profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileUpdateRequest $request)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('profile-update');
        // dd($request->all());
        $profile = $request->all();
        $profile['user_id'] = Auth::id();

        $existing_profile = Profile::where('user_id', Auth::id())->first();
        if ($existing_profile) {
            $existing_profile->update($profile);

        } else {
            $profile = Profile::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);
        $this->image_upload($request, $profile->id);
        }
        Toastr::success('Profile Updated Successfully!');
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('profile-update');
        // dd($request->all());
        $profile = Profile::where('id', $id)->first();
        // return $profile;
        $profile['user_id'] = Auth::id();
            $profile->update([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);

        $this->image_upload($request, $profile->id);
        Toastr::success('Profile Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUpdatePassword()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('password-update');
        return view('admin.pages.profile.update_password');
    }

    public function updatePassword(ProfilePasswordChangeRequest $request)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('password-update');
        // dd($request->all());
        $user = Auth::user();
        $hashedPassword = $user->password;
        //existing password === request password
        if (Hash::check($request->old_password, $hashedPassword)) {
            //new password == old stored password
            if(!Hash::check($request->password, $hashedPassword)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

            Auth::logout();
            Toastr::success("Password Updated Successfully 🙂");
                return redirect()->route('login');
            } else {
                Toastr::error('New Password cannot be the same as old pasword');
                return redirect()->back();
            }
        } else {
            Toastr::error("Credentials doesn't match");
                return redirect()->back();
        }
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        // dd($request->all(), $profile, $request->hasFile('user_image'));
        if ($request->hasFile('user_image')) {
            if ($profile->user_image != 'default_user.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/users/';
                $old_photo_location = $photo_location . $profile->user_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/users/';
            $uploaded_photo = $request->file('user_image');
            $new_photo_name = $profile->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(500,500)->save(base_path($new_photo_location), 40);
            //$user = User::find($profile->id);
            $check = $profile->update([
                'user_image' => $new_photo_name,
            ]);
        }
    }

    public function getDistrict($division_id)
    {
        $districts = District::select(['id', 'name'])->where('division_id', $division_id)->get();
        return response()->json($districts);
    }

    public function getUpazila($district_id)
    {
        $upazilas = Upazila::select(['id', 'name'])->where('district_id', $district_id)->get();
        return response()->json($upazilas);
    }
}
