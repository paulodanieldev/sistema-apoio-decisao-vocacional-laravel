<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;
use App\Models\Cooperativas;
use App\Models\User;

class DestroyDairyUserRequest extends BaseFormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $user = null;

        if ($this->coop_vinc) {
            $cooperativa = Cooperativas::where('cooperativa_code', '=', $this->coop_vinc)->first();
            if ($cooperativa) {
                $user = User::where(['id' => $this->id, 'uuid_cooperativa' => $cooperativa->uuid])->first();
            }     
        }

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
            "user"              => ["required", "json"],
            "id"                => ["required", "string", "exists:users,id"],
            'coop_vinc'         => ['required', "exists:cooperativas,cooperativa_code"],
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
            "user.required" => "usuário não encontrado."
        ];
    }
}
