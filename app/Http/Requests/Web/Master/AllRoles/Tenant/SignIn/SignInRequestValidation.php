<?php

namespace App\Http\Requests\Web\Master\AllRoles\Tenant\SignIn;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequestValidation extends FormRequest
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
            'subdomain' => 'required|alpha_num'
        ];
    }
}
