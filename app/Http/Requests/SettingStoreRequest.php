<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingStoreRequest extends FormRequest
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
        return  [
            'website_name' => 'required',
            'website_email' => 'required|email',
            'website_email_2' => 'email',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'phone_2' => 'regex:/(01)[0-9]{9}/',   
        ];
    }
}
