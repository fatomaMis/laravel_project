<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogClient extends FormRequest
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
            'password' => 'required|min:6',
            'name' => 'required',
            'email' => 'required|unique:clients,email',
            'image' => 'image|mimes:jpg,jpeg'
            ];
    }
    public function messages()
    {
         return [
            'name.required' => 'You should Enter Name',
            'email.required'=>'You should Enter Email'
         ];
    }
}
 
