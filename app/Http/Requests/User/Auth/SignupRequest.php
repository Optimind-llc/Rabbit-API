<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Requests\Request;

class SignupRequest extends Request
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
            'family_name' => 'required|max:50',
            'given_name' => 'required|max:50',
            'device_os' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:32|alpha_num',
        ];
    }
}
