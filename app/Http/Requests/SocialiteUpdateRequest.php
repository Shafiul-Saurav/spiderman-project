<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialiteUpdateRequest extends FormRequest
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
            'git_client_id' => 'required|string|max:255',
            'git_client_secret' => 'required|string|max:255',
            'git_client_redirect_url' => 'required|string|max:255',
            'google_client_id' => 'required|string|max:255',
            'google_client_secret' => 'required|string|max:255',
            'google_client_redirect_url' => 'required|string|max:255',
        ];
    }
}
