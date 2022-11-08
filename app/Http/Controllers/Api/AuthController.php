<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function postLogin(Request $req)
    {
        $credentials = $req->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Usuario y/o contraseña incorrecto',
            ], 401);
        }

        $accesToken = Auth::user()->createToken('yuXt2=Ak79')->accessToken;

        return response([
            'data' => Auth::user(),
            'acces_token' => $accesToken,
        ]);
    }

    public function postRegister(Request $req)
    {
        $user = new User;
        $user->name = e($req->input('name'));
        $user->email = e($req->input('email'));
        $user->password = hash::make($req->input('password'));
        $key_id = Str::uuid();
        $access_key = Str::uuid();
        $user->key_id = $key_id;
        $user->access_key = $access_key;

        if ($user->save()):
            return response([
                'message' => 'Te has registrado con éxito',
                'data' => $user,
            ], 201);
        endif;
    }

    public function getAll(){
        return response(User::all());
    }

    public function getUser(Request $req){
        return response($req->user());
    }
}
