<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AccountTypePrefixConstants;
use App\Http\Controllers\Controller;
use App\Models\SchoolGrades;
use App\Models\SchoolReports;
use App\Models\SchoolReportsGrades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = isset($request->key) ? $request->key : '';
        $users = User::selectRaw('users.*')
            ->where(function ($query) use ($key) {
                $query->where(DB::raw('LOWER(users.name)'),'LIKE','%'. strtolower($key) .'%')
                    ->orWhere(DB::raw('LOWER(users.email)'),'LIKE','%'. strtolower($key) .'%');
            })
            ->orderBy('users.name', 'asc')
            ->paginate(10);

        $accountTypes = AccountTypePrefixConstants::getConstants();

        return view('admin.users.index', ['users' => $users, 'accountTypes' => $accountTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountTypes = AccountTypePrefixConstants::getConstants();

        return view('admin.users.create', [ 'accountTypes' => $accountTypes ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create User validation to name, email and password confirmed unique not deleted with custom messages pt_BR
        $request->validate([
            'name' => 'required',
            'account_type' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|confirmed',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.unique' => 'O nome já existe.',
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'O email já existe.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        try {
            $item = new User();
            if ($request->account_type == AccountTypePrefixConstants::ADMIN) {
                $item->email_verified_at = now();
            }
            $item->account_type = $request->account_type;
            $item->name = $request->name;
            $item->email = $request->email;
            $item->password = Hash::make($request->password);
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
            $item = User::findOrFail($id);
            $accountTypes = AccountTypePrefixConstants::getConstants();

            return view('admin.users.show', [ 'item'=>$item, 'accountTypes' => $accountTypes ]);
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
            $item = User::findOrFail($id);
            $accountTypes = AccountTypePrefixConstants::getConstants();

            return view('admin.users.edit', [ 'item'=>$item, 'accountTypes' => $accountTypes ]);
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
        // create User validation to name, email unique and account_type nullable not deleted and different the current with custom messages pt_BR
        $request->validate([
            'name' => 'required',
            'account_type' => 'required',
            'email' => 'required|unique:users,email,'. $id .',id,deleted_at,NULL',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.unique' => 'O nome já existe.',
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'O email já existe.',
        ]);

        try {
            $item = User::findOrFail($id);
            // verify if the $request->account_type is like admin and the $item->email_verified_at is null
            if ($request->account_type == AccountTypePrefixConstants::ADMIN && $item->email_verified_at == null) {
                $item->email_verified_at = now();
            }
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
            $user = User::findOrFail($id);
            $schoolGrades = SchoolReports::where('user_id', $id)->get();
            //delete all school reports grades related to school reports
            foreach ($schoolGrades as $schoolGrade) {
                SchoolReportsGrades::where('school_report_id', $schoolGrade->id)->delete();
            }
            $schoolGrades->delete();
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'Excluido com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'ERROR: ' . $e->getMessage());
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
                    <a href="'.route("admin.users.show",$id).'" class="" data-toggle="tooltip" data-placement="top" title="Editar"><i class="bi bi-eye"></i></a>
                </div>
                <div class="col-3">
                    <a href="'.route("admin.users.edit",$id).'" class="" data-toggle="tooltip" data-placement="top" title="Editar"><i class="bi bi-pencil"></i></a>
                </div>
                <div class="col-3">
                    <a url-del="'.route("admin.users.delete",$id).'" href="javascript:void(0);" class="delete" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="la bi bi-trash "></i></a>
                </div>
            </div>
        ';
    }
}
