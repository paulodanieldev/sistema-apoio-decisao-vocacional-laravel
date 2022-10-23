<?php

namespace App\Http\Requests\SchoolReportsGrades;

use App\Http\Requests\BaseFormRequest;
use App\Models\SchoolReportsGrades;

class UpdateRequest extends BaseFormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $grade = $this->route('grade');

        // remove texts and change "," to "." from $this->final_grade_avg with regex
        $final_grade_avg = preg_replace("/[^0-9.]/", "", $this->final_grade_avg);
        $final_grade_avg = str_replace(",", ".", $final_grade_avg);
        $final_grade_avg = preg_replace("/\.$/", "", $final_grade_avg);

        $this->merge([
            "id_grade" => $grade,
            "final_grade_avg" => empty($final_grade_avg) ? null : $final_grade_avg
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //validation school_subject_id unique for school_report_id
        return [
            "id_grade"          => ["required", "integer", "exists:school_reports_grades,id,deleted_at,NULL"],
            "school_report_id"  => ["required", "integer", "exists:school_reports,id,deleted_at,NULL"],
            "school_subject_id" => ["required", "integer", "exists:school_subjects,id,deleted_at,NULL", "unique:school_reports_grades,school_subject_id," . $this->id_grade . ",id,school_report_id," . $this->school_report_id . ",deleted_at,NULL"],
            "final_grade_avg"   => ["required", "numeric", "min:0", "max:10"],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        //custom messages for validation in pt-br
        return [
            "id_grade.required"          => "O campo :attribute é obrigatório.",
            "id_grade.integer"           => "O campo :attribute deve ser um número inteiro.",
            "id_grade.exists"            => "O campo :attribute não existe.",
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
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$validator->errors()->all()) {

                $grade = SchoolReportsGrades::find($this->id_grade);

                $this->merge([
                    'inputs' => $this->all(),
                    'grade' => $grade,
                ]);
            }
        });
    }
}
