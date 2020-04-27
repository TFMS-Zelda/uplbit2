<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComputerRequest extends FormRequest
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
            'type_machine' => 'required|max:128',
            'brand' => 'required|max:128',
            'model' => 'required|max:128',
            'servicetag' => 'required|max:128|unique:computers',
            'servicecode' => 'required|max:128',
            'operating_system' => 'required|max:128|',
            'hard_drive' => 'required|max:128',
            'processor' => 'required|max:128',
            'memory_ram' => 'required|max:128',
            'charger_model' => 'required|max:64',
            'charger_serial' => 'required|max:64|unique:computers',
            'hostname' => 'required|max:128|unique:computers',
            'workgroup' => 'required|max:64',
            'domain_name' => 'required|max:64',
            'license' => 'required|max:64',
            'license_plate' => 'required|unique:computers|digits:7|numeric',
            'article_id' => 'required|numeric',
            'status' => 'required|max:64',
            'warranty_start' => 'required|date|before:warranty_end',
            'warranty_end' => 'required|date|after:warranty_start',
            'status' => 'required|max:64',
            'user_id' => 'required|numeric',
        ];
    }
}
