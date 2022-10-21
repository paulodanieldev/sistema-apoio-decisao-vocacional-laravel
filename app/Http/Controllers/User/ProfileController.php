<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $request->validate([
            'name' => 'required',
        ]);

        try {
            

            $user = User::findOrfail($uuid);

            if ($request->delete_profile_image == 1) {
                $filename = null;
                unlink(public_path('uploads/profile/img/' . $user->image));
            }else{
                if($request->hasFile('profile_image')) {
                    $file = $request->file('profile_image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = Str::upper(Str::slug($request->name) . '-profile-' . date('d-m-Y-H-i-s')) . '.' . $ext;
                    $file->move(public_path('uploads/profile/img/'), $filename);
                }
            }

            

            $user->name = $request->name;
            // $user->email = $request->email;
            // $user->password = bcrypt($request->password);
            if (isset($filename)){
                $user->image = $filename;
            }
            $user->about = $request->about;
            $user->phone = $request->phone;
            $user->twitter_url = $request->twitter_url;
            $user->facebook_url = $request->facebook_url;
            $user->instagram_url = $request->instagram_url;
            $user->linkedin_url = $request->linkedin_url;
            $user->save();

            // return redirect('/admin/users/')->with('success','Perfil atualizado com sucesso.');
            return redirect()->route('user.profile.index')->with('success','Perfil atualizado com sucesso.');
        }catch (\Exception $e){
            return back()->with('error', 'ERRO: ' . $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        # Validation
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        #Match The Old Password
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Senha alterada com sucesso!");
    }

}
