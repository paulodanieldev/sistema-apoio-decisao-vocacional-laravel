<?php

namespace App\Http\Requests\SchoolReportsGrades;

use App\Http\Requests\BaseFormRequest;
use App\Models\SchoolReportsGrades;

class DestroyRequest extends BaseFormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $gradeId = $this->route('grade');
        $grade = SchoolReportsGrades::find($gradeId);

        $this->merge([
            "grade" => $grade
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
            "grade" => ["required", "json"]
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
            "grade.required" => ":attribute not found."
        ];
    }
}
