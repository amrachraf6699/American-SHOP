<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWebsiteSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->type == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'location' => [
                'required', 
                'url', 
                'regex:/^(https:\/\/(www\.)?google\.com\/maps|https:\/\/maps\.google\.com)/'
            ],
            'phone' => 'required|string|max:20',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'instagram' => 'required|url',
            'whatsapp' => 'required|url',
            'youtube' => 'required|url',
            'shipping_fee' => 'required|numeric|min:0|max:100',
        ];
    }
}
