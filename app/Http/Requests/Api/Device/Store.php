<?php

namespace App\Http\Requests\Api\Device;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'device_uuid' => 'required|max:250|unique:devices,device_uuid',
            'language_code' => 'required|max:10',
            'region_code' => 'max:10',
            'platform' => 'required|in:ios,android,other',
            'notification_token' => 'max:250',
            'notification_tags' => 'max:250',
            'app_version' => 'required|max:50'
        ];
    }
}
