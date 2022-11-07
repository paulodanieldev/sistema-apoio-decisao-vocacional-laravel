<?php

namespace App\Http\Requests\Password;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends BaseFormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $user = $this->user();

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
            'password' => ['required', 'string', 'min:6', 'max:15', 'confirmed'],
            'user' => ['required', 'json']
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

                $password = Hash::make($this->password);

                $inputs = [
                    'password' => $password
                ];

                $this->merge([
                    'inputs' => $inputs,
                    'user' => $this->user,
                ]);
            }
        });
    }
}
