<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApperanceSettingUpdateRequest extends FormRequest
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
            'bg_color' => 'required|string|max:40',
            'logo_image' => 'required|image|mimes:png,jpg',
            'favicon_image' => 'required|image|mimes:png,jpg',
        ];
    }
}
