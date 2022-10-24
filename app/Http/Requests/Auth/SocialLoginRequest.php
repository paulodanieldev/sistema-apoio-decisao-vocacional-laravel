<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class SocialLoginRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email'],
            'provider'  => ['required', 'string', 'in:facebook,google']
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
                $this->merge([
                    'inputs' => [
                        'name'  => $this->name,
                        'email' => $this->email,
                    ],
                ]);
            }
        });
    }
}
