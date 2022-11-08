<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['getLogout']);
    }

    public function getLogin()
    {
        return view('connection.login');
    }

    public function postLogin(Request $req)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($req->all(), $rules);

        $credentials = $req->only('email', 'password');

        if ($validator->fails()):
            return back()->withErrors($validator);
        else:
            if (!Auth::attempt($credentials)):
                return back()->with('message', 'Correo Electrónico o Contraseña incorrecto')->with('typealert', 'danger');
            else:
                return redirect('/');
            endif;
        endif;
    }

    public function getRegister()
    {
        return view('connection.register');

    }

    public function postRegister(Request $req)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'rpassword' => 'required|min:8',
        ];

        $validator = Validator::make($req->all(), $rules);

        $name = e($req->input('name'));
        $email = e($req->input('email'));
        $password = e($req->input('password'));
        $rpassword = e($req->input('rpassword'));
        $key_id = Str::uuid();
        $access_key = Str::uuid();

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            if ($rpassword === $password) {
                $user = new User;
                $user->name = $name;
                $user->email = $email;
                $user->password = hash::make($password);
                $user->key_id = $key_id;
                $user->access_key = $access_key;

                if ($user->save()){
                    return redirect('/iniciarsesion')->with('message', 'Te has registrado con éxito')->with('typealert', 'success');
                }
            } else {
                return back()->with('message', 'Las contraseñas no coinciden')->with('typealert', 'danger');
            }
        }

    }

    /*Cerrar Sesión*/
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getPerfil(Request $req)
    {
        // $profile = $req->user();
        // $data = ['user' => $profile];
        return view('user.index');
    }

}
