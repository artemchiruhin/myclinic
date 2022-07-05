<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateFormRequest extends FormRequest
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
            'email' => 'required|string|email|max:50|unique:employees',
            'first_name' => 'required|string|max:30|regex:/^([а-яА-ЯЁё\-]+)$/u',
            'last_name' => 'required|string|max:30|regex:/^([а-яА-ЯЁё\-]+)$/u',
            'patronymic' => 'required|string|max:30|regex:/^([а-яА-ЯЁё\-]+)$/u',
            'phone' => 'required|string|max:11|regex:/8[0-9]{10}/|unique:employees',
            'service_category_id' => 'required|exists:service_categories,id',
            'image' => 'required|mimes:jpg, jpeg, png, bmp|max:2048',
            'started_at' => 'required|date|before:tomorrow'
        ];
    }
}
