<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class AuthenticatedRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
