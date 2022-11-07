<?php

namespace App\Http\Requests\Linking;

use App\Http\Requests\BaseFormRequest;

class ResetPasswordRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "token" => ["required", "string", "max:255"],
            "email" => ["required", "string", "max:255"],
        ];
    }
}
