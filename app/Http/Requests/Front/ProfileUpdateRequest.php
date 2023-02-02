<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:50',
            'phone'             => 'required|unique:admin_users,phone,'.auth()->user()->id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'phone.required' => 'Phone no is required',
        ];
    }
}
