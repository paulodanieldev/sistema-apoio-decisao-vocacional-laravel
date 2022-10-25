<?php

namespace App\Http\Requests\Password;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetRequest extends BaseFormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $password = Hash::make($this->password);
        $user = User::whereEmail($this->email)->first();
        $rememberToken = Str::random(60);

        $this->merge([
            'user' => $user,
            "password" => $password,
            "remember_token" => $rememberToken,
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
            'email'    => ['required', 'email', 'exists:users,email'],
            'token'    => ['required', 'string', 'exists:password_resets,token'],
            'password' => ['required', 'string'],
            'user'     => ['required', 'json'],
            'remember_token' => ['required', 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "email.exists" => "O e-mail informado não foi encontrado",
            "token.exists" => "O token fornecido é inválido.",
        ];
    }
}
