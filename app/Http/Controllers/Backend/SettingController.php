<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApperanceSettingUpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\GeneralSettingUpdateRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function general()
    {
        return view('admin.pages.settings.general');
    }

    public function generalUpdate(GeneralSettingUpdateRequest $request)
    {
        // dd($request->all());
        Setting::updateOrCreate(
            ['name' => 'site_title'],
            ['value' => $request->site_title],
        );
        Setting::updateOrCreate(
            ['name' => 'site_address'],
            ['value' => $request->site_address],
        );
        Setting::updateOrCreate(
            ['name' => 'site_phone'],
            ['value' => $request->site_phone],
        );
        Setting::updateOrCreate(
            ['name' => 'site_facebook_link'],
            ['value' => $request->site_facebook_link],
        );
        Setting::updateOrCreate(
            ['name' => 'site_twitter_link'],
            ['value' => $request->site_twitter_link],
        );
        Setting::updateOrCreate(
            ['name' => 'site_linkedin_link'],
            ['value' => $request->site_linkedin_link],
        );
        Setting::updateOrCreate(
            ['name' => 'site_github_link'],
            ['value' => $request->site_github_link],
        );
        Setting::updateOrCreate(
            ['name' => 'site_description'],
            ['value' => $request->site_description],
        );

        Toastr::success('Setting Update Successfully!');
        return back();
    }

    public function apperance()
    {
        return view('admin.pages.settings.apperance');
    }

    public function apperanceUpdate(ApperanceSettingUpdateRequest $request)
    {
        Setting::updateOrCreate(
            ['name' => 'bg_color'],
            ['value' => $request->bg_color],
        );

        if($request->hasFile('logo_image')){
            if(setting('logo_image') !=null){
                $this->deleteOldFile(setting('logo_image'));
            }
            Setting::updateOrCreate(
                ['name' => 'logo_image'],
                ['value' => Storage::putFileAs('public', $request->file('logo_image'), 'logo_image.jpg')]
            );
        }
        if($request->hasFile('favicon_image')){
            if(setting('favicon_image') !=null){
                $this->deleteOldFile(setting('favicon_image'));
            }
            Setting::updateOrCreate(
                ['name' => 'favicon_image'],
                ['value' => Storage::putFileAs('public', $request->file('favicon_image'), 'favicon_image.jpg')]
            );
        }

        Toastr::success('Setting Updated Successfully!!!');
        return back();
    }

    private function deleteOldFile($path){
        Storage::disk('public')->delete($path);
    }

}
