<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTabletRequest extends FormRequest
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

            'brand' => 'required|max:32|regex:/^[\pL\s\-]+$/u',
            'model' => 'required|max:128',
            'color' => 'required|max:32|regex:/^[\pL\s\-]+$/u',
            'serial' => 'required|max:128|unique:tablets',
            'screen' => 'required|max:128',
            'processor' => 'required|max:64',
            'memory' => 'required|max:64',
            'camera' => 'required|max:64',
            'battery' => 'required|max:64',
            'operating_system' => 'required|max:128',
            'optical_pencil' => 'required|max:8',
            'charger_model' => 'required|max:128',
            'charger_serial' => 'required|max:128|unique:tablets',
            'data_plan' => 'required|max:128',
            'sim_card' => 'required|max:128|unique:tablets',
            'pin' => 'required|min:4|max:4',
            'imei' => 'required|numeric|digits_between:15,15|unique:tablets',
            'phone_number' => 'required|digits_between:10,10|unique:tablets',
            'license_plate' => 'required|digits_between:7,7|unique:tablets',
            'location' => 'required|max:128',
            'status' => 'required|max:128',
            'warranty_start' => 'required|date|before:warranty_end',
            'warranty_end' => 'required|date|after:warranty_start',
            'article_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
    }
}
