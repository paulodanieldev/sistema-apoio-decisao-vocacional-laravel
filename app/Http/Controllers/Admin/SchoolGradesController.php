<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolGrades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SchoolGradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = isset($request->key) ? $request->key : '';
        $schoolGrades = SchoolGrades::selectRaw('school_grades.*')
            ->where(function ($query) use ($key) {
                $query->where(DB::raw('LOWER(school_grades.name)'),'LIKE','%'. strtolower($key) .'%');
            })
            ->orderBy('school_grades.name', 'asc')
            ->paginate(10);

        return view('admin.schoolGrades.index', ['schoolGrades' => $schoolGrades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schoolGrades.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create validation to name and slug unique and not deleted diferent of null with custom messages pt_BR
        $request->validate([
            'name' => 'required|unique:school_grades,name,NULL,id,deleted_at,NULL',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.unique' => 'O nome já existe.',
        ]);

        try {
            $item = new SchoolGrades();
            $item->name = $request->name;
            $item->slug = Str::lower(Str::slug($request->name));
            $item->save();

            return back()->with('success', 'Registro cadastrado com sucesso.');
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
            $item = SchoolGrades::findOrFail($id);

            return view('admin.schoolGrades.show', [ 'item'=>$item ]);
        } catch (\Exception $e) {

            return back()->with('message', 'Erro: ' . $e->getMessage());
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
            $item = SchoolGrades::findOrFail($id);

            return view('admin.schoolGrades.edit', [ 'item'=>$item ]);
        } catch (\Exception $e) {

            return back()->with('message', 'Erro: ' . $e->getMessage());
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
        // create validation to name and slug unique and not deleted diferent of null with custom messages pt_BR
        $request->validate([
            'name' => 'required|unique:school_grades,name,'.$id.',id,deleted_at,NULL',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.unique' => 'O nome já existe.',
        ]);
        
        $request->merge([
            "slug" => Str::lower(Str::slug($request->name)),
        ]);

        try {
            $item = SchoolGrades::findOrFail($id);
            $item->update($request->all());

            return back()->with('success', 'Registro atualizado com sucesso.');
        } catch (\Exception $e) {
            echo 'ERRO: ' . $e->getMessage();
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
            SchoolGrades::findOrFail($id)->delete();

            return redirect()->route('admin.school-grades.index')->with('success', 'Excluido com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.school-grades.index')->with('error', 'ERROR: ' . $e->getMessage());
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
                    <a href="'.route("admin.school-grades.show",$id).'" class="" data-toggle="tooltip" data-placement="top" title="Editar"><i class="bi bi-eye"></i></a>
                </div>
                <div class="col-3">
                    <a href="'.route("admin.school-grades.edit",$id).'" class="" data-toggle="tooltip" data-placement="top" title="Editar"><i class="bi bi-pencil"></i></a>
                </div>
                <div class="col-3">
                    <a url-del="'.route("admin.school-grades.delete",$id).'" href="javascript:void(0);" class="delete" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="la bi bi-trash "></i></a>
                </div>
            </div>
        ';
    }
}
