<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCreateFormRequest extends FormRequest
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
            'name' => 'required|string|unique:services|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'service_category_id' => 'required|exists:service_categories,id',
            'image' => 'required|mimes:jpg, jpeg, png, bmp|max:2048'
        ];
    }
}
