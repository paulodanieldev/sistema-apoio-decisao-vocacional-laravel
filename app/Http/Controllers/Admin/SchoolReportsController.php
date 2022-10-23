<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AccountTypePrefixConstants;
use App\Http\Controllers\Controller;
use App\Models\SchoolLevels;
use App\Models\SchoolGrades;
use App\Models\SchoolReports;
use App\Models\SchoolReportsGrades;
use App\Models\SchoolSubjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SchoolReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = isset($request->key) ? $request->key : '';
        $schoolReports = User::selectRaw('school_reports.*, users.name as user_name, school_levels.name as school_level_name, school_grades.name as school_grade_name')
            ->join('school_reports', function ($join) {
                $join->on('users.id', '=', 'school_reports.user_id')
                ->whereNull('school_reports.deleted_at');
            })
            ->leftJoin('school_levels', 'school_levels.id', '=', 'school_reports.school_level_id')
            ->leftJoin('school_grades', 'school_grades.id', '=', 'school_reports.school_grade_id')
            ->where(function ($query) use ($key) {
                $query->where(DB::raw('LOWER(users.name)'),'LIKE','%'. strtolower($key) .'%');
            })
            ->where('users.account_type','=', AccountTypePrefixConstants::USER)
            ->orderBy('users.name', 'asc')
            ->paginate(10);

        return view('admin.schoolReport.index', ['schoolReports' => $schoolReports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schoolLevels = SchoolLevels::all();
        $schoolGrades = SchoolGrades::all();
        $users = User::where('account_type','=', AccountTypePrefixConstants::USER)->get();
        
        return view('admin.schoolReport.create', ['schoolLevels' => $schoolLevels, 'schoolGrades' => $schoolGrades, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user = Auth::user();
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'school_year' => 'required|unique:school_reports,school_year,NULL,id,user_id,'.$request->user_id,
            'school_level_id' => 'required|unique:school_reports,school_level_id,NULL,id,school_year,'.$request->school_year.',user_id,'.$request->user_id,
            'school_grade_id' => 'required|unique:school_reports,school_grade_id,NULL,id,school_year,'.$request->school_year.',user_id,'.$request->user_id,
        ], [
            'user_id.required' => 'O campo Usuário é obrigatório.',
            'user_id.exists' => 'Usuário não encontrado.',
            'school_year.required' => 'O campo ano letivo é obrigatório.',
            'school_year.unique' => 'Já existe um histórico escolar cadastrado para o ano letivo informado.',
            'school_level_id.required' => 'O campo nível escolar é obrigatório.',
            'school_level_id.unique' => 'Já existe um histórico escolar cadastrado para o nível escolar informado.',
            'school_grade_id.required' => 'O campo série é obrigatório.',
            'school_grade_id.unique' => 'Já existe um histórico escolar cadastrado para a série informada.',
        ]);

        try {
            $item = new SchoolReports();
            // $item->user_id = $user->id;
            $item->user_id = $request->user_id;
            $item->school_year = $request->school_year;
            $item->school_level_id = $request->school_level_id;
            $item->school_grade_id = $request->school_grade_id;
            $item->save();

            return redirect()->route('admin.school-reports.edit', $item->id)->with('success', 'Registro cadastrado com sucesso.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro no cadastro.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $schoolLevels = SchoolLevels::all();
            $schoolGrades = SchoolGrades::all();
            $schoolSubjects = SchoolSubjects::all()->pluck('name', 'id')->toArray();
            $item = SchoolReports::findOrFail($id);
            $users = User::where('account_type','=', AccountTypePrefixConstants::USER)->get();

            return view('admin.schoolReport.show', [ 'item' => $item, 'schoolLevels' => $schoolLevels, 'schoolGrades' => $schoolGrades, 'schoolSubjects' => $schoolSubjects, 'users' => $users ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao editar!' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $schoolLevels = SchoolLevels::all();
            $schoolGrades = SchoolGrades::all();
            $schoolSubjects = SchoolSubjects::all()->pluck('name', 'id')->toArray();
            $item = SchoolReports::with('schoolReportsGrades')->findOrFail($id);
            $users = User::where('account_type','=', AccountTypePrefixConstants::USER)->get();

            return view('admin.schoolReport.edit', [ 'item' => $item, 'schoolLevels' => $schoolLevels, 'schoolGrades' => $schoolGrades, 'schoolSubjects' => $schoolSubjects, 'users' => $users ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao editar!' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $user = Auth::user();
        //validate school_year unique for user and school_grade_id unique for school_year and school_level_id just required with user validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'school_year' => 'required|unique:school_reports,school_year,'.$id.',id,user_id,'.$request->user_id,
            'school_level_id' => 'required',
            'school_grade_id' => 'required|unique:school_reports,school_grade_id,'.$id.',id,school_year,'.$request->school_year.',user_id,'.$request->user_id,
        ], [
            'user_id.required' => 'O campo Usuário é obrigatório.',
            'user_id.exists' => 'Usuário não encontrado.',
            'school_year.required' => 'O campo ano letivo é obrigatório.',
            'school_year.unique' => 'Já existe um histórico escolar cadastrado para o ano letivo informado.',
            'school_level_id.required' => 'O campo nível escolar é obrigatório.',
            'school_grade_id.required' => 'O campo série é obrigatório.',
            'school_grade_id.unique' => 'Já existe um histórico escolar cadastrado para a série informada.',
        ]);

        try {
            $item = SchoolReports::findOrFail($id);
            $item->update($request->all());

            return back()->with('success', 'Registro atualizado com sucesso.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro no cadastro.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            SchoolReports::findOrFail($id)->delete();
            SchoolReportsGrades::where('school_report_id', $id)->delete();

            return redirect()->route('admin.school-reports.index')->with('success', 'Histórico escolar excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.school-reports.index')->with('error', 'ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Show actions to this controller.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function actions($id)
    {
        return '
            <div class="row">
                <div class="col-3">
                    <a href="'.route("admin.school-reports.show",$id).'" class="" data-toggle="tooltip" data-placement="top" title="Editar"><i class="bi bi-eye"></i></a>
                </div>
                <div class="col-3">
                    <a href="'.route("admin.school-reports.edit",$id).'" class="" data-toggle="tooltip" data-placement="top" title="Editar"><i class="bi bi-pencil"></i></a>
                </div>
                <div class="col-3">
                    <a url-del="'.route("admin.school-reports.delete",$id).'" href="javascript:void(0);" class="delete" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="la bi bi-trash "></i></a>
                </div>
            </div>
        ';
    }
}
