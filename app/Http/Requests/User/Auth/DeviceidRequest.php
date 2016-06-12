<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Requests\Request;

class DeviceidRequest extends Request
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
            'device_id' => 'required',
            'device_os'  => 'required'
        ];
    }
}
