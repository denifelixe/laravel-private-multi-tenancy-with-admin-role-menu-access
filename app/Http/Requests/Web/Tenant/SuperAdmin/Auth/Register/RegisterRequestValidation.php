<?php

namespace App\Http\Requests\Web\Tenant\SuperAdmin\Auth\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequestValidation extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:superadmins',
            'password' => 'required|string|min:8|confirmed',
            'sms_verification_code' => 'required',
            'email_verification_code' => 'required'
        ];
    }
}
