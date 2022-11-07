<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;

class UpdateRequest extends BaseFormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {

        $id = $this->route('user');

        $this->merge([
            "id" => $id,
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
            "id"    => ["required", "string", "exists:users,id"],
            "doc"   => ["nullable", "string", "unique:users,doc,".$this->id],
            "email" => ["nullable", "string", "unique:users,email,".$this->id],
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
            "id.exists" => ":attribute not found."
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

                $user = User::find($this->id);

                $this->merge([
                    'inputs' => $this->all(),
                    'user' => $user,
                ]);
            }
        });
    }
}
