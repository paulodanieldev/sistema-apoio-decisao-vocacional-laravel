<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;
use App\Rules\CheckUserCredentials;

class LoginRequest extends BaseFormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $credentials = [
            'email'    => $this->email,
            'password' => $this->password,
        ];

        $this->merge([
            'credentials' => $credentials
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'       => ['required', 'string', 'email'],
            'password'    => ['required', 'string', 'min:6'],
            'remember_me' => ['nullable', 'boolean'],
            'credentials' => new CheckUserCredentials($this->credentials),
        ];
    }
}
