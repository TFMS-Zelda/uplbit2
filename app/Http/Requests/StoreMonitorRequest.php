<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMonitorRequest extends FormRequest
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
            
            //Validation
            'brand' => 'required|string|max:64|',
            'model' => 'required|string|max:128',
            'serial' => 'required|max:128|unique:monitors',
            'screen_type' => 'required|max:128',
            'screen_format' => 'required|max:8',
            'backlight' => 'required|max:8|',
            'input_connector_type' => 'required|max:32',
            'maximum_resolution' => 'required|max:64',
            'power_supply' => 'required|max:64',
            'license_plate' => 'required|max:7|unique:monitors',
            'location' => 'required|max:64',
            'status' => 'required|max:64',
            'warranty_start' => 'required|date|before:warranty_end',
            'warranty_end' => 'required|date|after:warranty_start',
            'article_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
    }
}



