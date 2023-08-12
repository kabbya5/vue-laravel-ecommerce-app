<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
        $rule = [
            'category_title' => 'required|max:60|unique:categories,category_title',
            'category_img' => 'required',
            'category_position' => 'integer',
        ];
        switch($this->method()){
            case "PATCH":
            case "PUT": 
                $rule['category_title'] = 'required|max:60|unique:categories,category_title,'.$this->category->id;
                $rule['category_img'] = '';
        }
        return $rule;
    }
}
