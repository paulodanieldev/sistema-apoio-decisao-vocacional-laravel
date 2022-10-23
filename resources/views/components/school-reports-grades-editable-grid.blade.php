@php
    $componentId = "school-reports-grades-edit-grid";
@endphp
<div id="{{ $componentId }}">
    <div class="my-4" data-school-report-id="{{ $id }}" id="table-coop-details">
        <input type="hidden" id="subjects-data-json" data-val="{{ json_encode($subjects) }}">
        <h5 class="mb-4">Médias finais da avaliação</h5>
        <table class="table table-striped mt-3" id="school-reports-grades-table-list">
            <thead>
                <tr>
                    <th data-name="school_subject_id" data-type="select" scope="col" for="subjects-data-json">Matéria</th>
                    <th data-name="final_grade_avg" data-type="input" scope="col">Média final</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                    <tr data-url-id="{{ $grade->id }}">
                        <td data-name="school_subject_id" data-type="select" for="subjects-data-json" data-val="{{ $grade->school_subject_id ?? "" }}">{{ $subjects[$grade->school_subject_id] ?? "" }}</td>
                        <td data-name="final_grade_avg" data-type="input" data-val="{{ $grade->final_grade_avg ?? "" }}">{{ $grade->final_grade_avg ?? "" }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary" id="add">Adicionar média</button>
    </div>
</div>