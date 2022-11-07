<?php

namespace App\Http\Requests\Auth;

use App\Constants\AccountTypePrefixConstants;
use Illuminate\Support\Facades\Hash;
use App\Helpers\StringHelper;
use App\Http\Requests\BaseFormRequest;
use App\Models\Cooperativas;

class RegisterRequest extends BaseFormRequest
{
    /**
     * @var string
     */
    private string $original_password;

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->password){
            $this->original_password = $this->password;
            $password = Hash::make($this->password);
            $this->merge([
                "password" => $password
            ]);
        }

        if ($this->doc) {
            $doc = StringHelper::removeCharacters($this->doc);
            $this->merge([
                "doc" => $doc
            ]);            
        }
        
        if ($this->coop_vinc) {
            $cooperativa = Cooperativas::where('cooperativa_code', '=', $this->coop_vinc)->first();
            if ($cooperativa) {
                $this->merge([
                    "uuid_cooperativa" => $cooperativa->uuid,
                ]);
            }     
        }

        $this->merge([
            "account_type" => $this->account_type,
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $accessTypeValidation = 'nullable';
        if ($this->account_type && ($this->account_type == AccountTypePrefixConstants::DAIRY || $this->account_type == AccountTypePrefixConstants::ADMIN)){
            $accessTypeValidation = 'required';
        }

        return [
            'name'                  => ['required', 'string', 'between:2,100'],
            'email'                 => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password'              => ['required', 'string', 'min:6'],
            'doc'                   => ['required', 'unique:users'],
            'account_type'          => ['required'],
            'account_access_type'   => [$accessTypeValidation, 'not_in:0'],
            'coop_vinc'             => ['nullable'],
            'uuid_cooperativa'      => ['nullable'],
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
            "account_access_type.not_in" => "O campo Tipo de Acesso é obrigatório.",
            "doc.required" => "O CPF é obrigatório.",
            "doc.unique" => "Este CPF já está sendo utilizado por outro usuário.",
            "email.unique" => "Este Email já está sendo utilizado por outro usuário."
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
                    'inputs' => $this->all(),
                    'extras' => [
                        "original_password" => $this->original_password,
                    ],
                ]);
            }
        });
    }
}
