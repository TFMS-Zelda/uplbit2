<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'email_corporate' => "required|max:128|unique:employees,serial,{$this->employee->id}",
            'job_title' => 'required|max:128',
            'employee_type' => 'required|max:128',

            'citizenship_card' => "required|digits_between:7,10|numeric|unique:employees,citizenship_card,{$this->employee->id}",
            'ugdn' => "required|digits:8|numeric|unique:employees,ugdn,{$this->employee->id}",
            'status' => 'required|string|max:64',
            'country' => 'required|string|max:64',
            'city' => 'required|string|max:64',
            'work_area' => 'required|string|max:128',
            'phone' => "required|digits_between:7,10|numeric|unique:employees,phone,{$this->employee->id}",
            'creation_date' => 'required|date',
            'company_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'profile_avatar' => 'mimes:jpg,png|max:100',

        ];
    }
}
