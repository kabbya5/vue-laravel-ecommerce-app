<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildCategoryRequest extends FormRequest
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
            'childcat_title' => 'required|unique:childcategories,childcat_title',
            'subcategory_ids' => 'required|max:5|min:1',
        ];

        switch($this->method()){
            case 'PUT':
            case 'PATCH':
                $rule['childcat_title'] = 'required|unique:childcategories,childcat_title,'.$this->childcategory->id;
        }

        return $rule;

    }
}
