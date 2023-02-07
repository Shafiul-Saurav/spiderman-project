<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApperanceSettingUpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\GeneralSettingUpdateRequest;
use App\Http\Requests\MailSettingUpdateRequest;
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

    public function mailView() {
        return view('admin.pages.settings.mail');
    }

    public function mailUpdate(MailSettingUpdateRequest $request) {
        Setting::updateOrCreate(
            ['name' => 'mail_mailer'],
            ['value' => $request->mail_mailer],
        );
        Setting::updateOrCreate(
            ['name' => 'mail_host'],
            ['value' => $request->mail_host],
        );
        Setting::updateOrCreate(
            ['name' => 'mail_port'],
            ['value' => $request->mail_port],
        );
        Setting::updateOrCreate(
            ['name' => 'mail_username'],
            ['value' => $request->mail_username],
        );
        Setting::updateOrCreate(
            ['name' => 'mail_password'],
            ['value' => $request->mail_password],
        );
        Setting::updateOrCreate(
            ['name' => 'mail_encryption'],
            ['value' => $request->mail_encryption],
        );
        Setting::updateOrCreate(
            ['name' => 'mail_from_address'],
            ['value' => $request->mail_from_address],
        );

        // update ENV file
        // $this->setEnvValue('MAIL_MAILER', $request->mail_mailer);
        // $this->setEnvValue('MAIL_HOST', $request->mail_host);
        // $this->setEnvValue('MAIL_PORT', $request->mail_port);
        // $this->setEnvValue('MAIL_USERNAME', $request->mail_username);
        // $this->setEnvValue('MAIL_PASSWORD', $request->mail_password);
        // $this->setEnvValue('MAIL_ENCRYPTION', $request->mail_encryption);
        // $this->setEnvValue('MAIL_FROM_ADDRESS', $request->mail_from_address);

        Toastr::success('Setting Updated Successfully!!!');
        return back();
    }

}
