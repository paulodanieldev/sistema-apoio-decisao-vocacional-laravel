<?php

namespace App\Http\Requests\SchoolReportsGrades;

use App\Http\Requests\BaseFormRequest;

class StoreRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //validation rules on school_subject_id no repeated data for school_report_id and final_grade_avg acpts only float numbers
        return [
            "school_report_id"  => ["required", "integer", "exists:school_reports,id,deleted_at,NULL"],
            "school_subject_id" => ["required", "integer", "exists:school_subjects,id,deleted_at,NULL", "unique:school_reports_grades,school_subject_id,NULL,id,school_report_id," . $this->school_report_id . ",deleted_at,NULL"],
            "final_grade_avg"   => ["required", "numeric", "min:0", "max:10"],
        ];
    }

    //custom messages for validation in pt-br
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "school_report_id.required"  => "O campo :attribute é obrigatório.",
            "school_report_id.integer"   => "O campo :attribute deve ser um número inteiro.",
            "school_report_id.exists"    => "O campo :attribute não existe.",
            "school_subject_id.required" => "O campo Matéria é obrigatório.",
            "school_subject_id.integer"  => "O campo Matéria deve ser um número inteiro.",
            "school_subject_id.exists"   => "O campo Matéria não existe.",
            "school_subject_id.unique"   => "O campo Matéria já está cadastrado.",
            "final_grade_avg.required"   => "O campo Média final é obrigatório.",
            "final_grade_avg.numeric"    => "O campo Média final deve ser um número.",
            "final_grade_avg.min"        => "O campo Média final deve ser maior que :min.",
            "final_grade_avg.max"        => "O campo Média final deve ser menor que :max.",
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$validator->errors()->all()) {
                $this->merge([
                    'inputs' => $this->all(),
                ]);
            }
        });
    }
}
