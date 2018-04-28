<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRoom extends FormRequest
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
            'number' => 'unique|min:4',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            ];
    }
    public function messages()
    {
         return [
            'number.required' => 'You Should Enter Accompany Number', 
         ];
    }
}
 
