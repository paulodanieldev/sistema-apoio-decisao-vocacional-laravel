<?php

namespace App\Http\Requests\Password;

use App\Http\Requests\BaseFormRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ForgotRequest extends BaseFormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $user = User::whereEmail($this->email)->first();

        $this->merge([
            "user" => $user
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
            'email' => ["required", "email", 'exists:users,email'],
            'user'  => ["required", "json"],
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
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$validator->errors()->all()) {

                //Create Password Reset Token
                PasswordReset::create([
                    'email' => $this->email,
                    'token' => Str::random(60),
                    'created_at' => Carbon::now()
                ]);

                //Get the token just created above
                $tokenData = PasswordReset::where('email', $this->email)->latest()->first();

                $this->merge([
                    'token' => $tokenData->token,
                    'user' => $this->user,
                ]);
            }
        });
    }
}
