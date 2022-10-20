<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = Auth::user();
            return view('user.profile', ['user'=>$user]);
        } catch (\Exception $e) {
            return back()->with('message', 'Erro ao editar!' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {

        try {

            $user = User::findOrfail($uuid);
            $user->name = $request->nome;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect('/admin/users/')->with('success','Usuário atualizado com sucesso.');

        }catch (\Exception $e){
            echo $e->getMessage();
        }

    }

}
