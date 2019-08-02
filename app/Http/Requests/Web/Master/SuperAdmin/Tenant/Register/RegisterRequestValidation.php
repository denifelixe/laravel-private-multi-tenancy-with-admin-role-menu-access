<?php

namespace App\Http\Requests\Web\Master\SuperAdmin\Tenant\Register;

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
            'subdomain' => 'required|unique:tenants,subdomain',
            'db_connection' => 'required',
            'db_url' => 'present',
            'db_host' => 'present',
            'db_port' => 'present|nullable|integer|min:1000|max:9999',
            'db_name' => 'required',
            'db_username' => 'present',
            'db_password' => 'present',
            'db_socket' => 'present',
            'db_foreign_keys' => 'present'
        ];
    }
}
