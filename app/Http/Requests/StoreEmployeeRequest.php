<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
            'email_corporate' => 'required|unique:employees|email|max:128',
            'job_title' => 'required|max:128',
            'employee_type' => 'required|max:128',
            'citizenship_card' => 'required|unique:employees|digits:10|numeric',
            'ugdn' => 'required|unique:employees|digits:8|numeric',
            'status' => 'required|string|max:64',
            'country' => 'required|string|max:64',
            'city' => 'required|string|max:64',
            'phone' => 'required|unique:employees|digits_between:7,10|numeric',
            'profile_avatar' => 'mimes:jpg,png|max:100',
            'creation_date' => 'required|date',
            'company_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
    }
}
