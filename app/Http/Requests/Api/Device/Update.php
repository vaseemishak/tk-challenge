<?php

namespace App\Http\Requests\Api\Device;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'language_code' => 'max:10',
            'region_code' => 'max:10',
            'platform' => 'in:ios,android,other',
            'notification_token' => 'max:250',
            'notification_tags' => 'max:250',
            'app_version' => 'max:50',
            'is_premium'  => 'boolean'
        ];
    }
}
