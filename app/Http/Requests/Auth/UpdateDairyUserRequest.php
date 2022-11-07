<?php

namespace App\Http\Requests\Auth;

use App\Constants\AccountTypePrefixConstants;
use App\Http\Requests\BaseFormRequest;
use App\Models\Cooperativas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateDairyUserRequest extends BaseFormRequest
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
            "password" => $this->password ? Hash::make($this->password) : User::find($this->id)->password,
        ]);

        if ($this->coop_vinc) {
            $cooperativa = Cooperativas::where('cooperativa_code', '=', $this->coop_vinc)->first();
            if ($cooperativa) {
                $this->merge([
                    "uuid_cooperativa" => $cooperativa->uuid,
                ]);
            }     
        }
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
            "id"                    => ["required", "string", "exists:users,id"],
            "name"                  => ["required", "string"],
            "doc"                   => ["required", "string", "unique:users,doc,".$this->id],
            "email"                 => ["required", "string", "unique:users,email,".$this->id],
            'coop_vinc'             => ['required', "exists:cooperativas,cooperativa_code"],
            'uuid_cooperativa'      => ['required', "exists:cooperativas,uuid"],
            'account_access_type'   => [$accessTypeValidation, 'not_in:0'],
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
            "id.exists" => ":attribute not found.",
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

                $user = User::find($this->id);

                $this->merge([
                    'inputs' => $this->all(),
                    'user' => $user,
                ]);
            }
        });
    }
}
