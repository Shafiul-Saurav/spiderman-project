<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'site_title' => 'required|string|max:255',
            'site_address' => 'required|string|max:255',
            'site_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'site_facebook_link' => 'nullable|string|max:255',
            'site_twitter_link' => 'nullable|string|max:255',
            'site_linkedin_link' => 'nullable|string|max:255',
            'site_github_link' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:255',
        ];
    }
}
