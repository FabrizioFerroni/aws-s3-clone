<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    public function getHome(Request $req)
    {
        $profile = $req->user();
        $data = ['user' => $profile];
        return view('user.index', $data);
    }

    public function updatePerfil(Request $req)
    {
        $id = $req->input('id');
        $id_log = $req->user()->id;
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8|same:rpassword',
            'rpassword' => 'nullable|min:8|same:password',
            'key_id' => 'required',
            'access_key' => 'required',
        ];

        $validator = Validator::make($req->all(), $rules);

        $name = e($req->input('name'));
        $email = e($req->input('email'));
        $password = e($req->input('password'));
        $rpassword = e($req->input('rpassword'));
        $key_id = e($req->input('key_id'));
        $access_key = e($req->input('access_key'));
        $user = User::find($id);

        if ($id != $id_log) {
            return back()->with('message', 'El id mandado no es valido')->with('typealert', 'danger');
        } else {
            if (!$user) {
                return back()->with('message', 'No se encontro ningun usuario con ese id')->with('typealert', 'danger');
            } else {
                if ($validator->fails()) {
                    return back()->withErrors($validator);
                } else {
                    if ($password === $rpassword) {
                        $user->name = $name;
                        $user->email = $email;
                        if ($password != "") {
                            $user->password = hash::make($password);
                        }
                        $user->key_id = $key_id;
                        $user->access_key = $access_key;

                        if ($user->save()) {
                            return back()->with('message', 'Se edito con éxito el perfil')->with('typealert', 'success');
                        }
                    }
                }
            }
        }
    }
}
