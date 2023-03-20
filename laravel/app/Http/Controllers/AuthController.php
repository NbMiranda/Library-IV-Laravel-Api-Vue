<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    protected $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function login(Request $request) {

    // autentication
    $data = $request->all();
    $token = auth('api')->attempt($data);
    // dd($token);
    
    if ($token) {
        return response()->json(['token' => $token]);  
    } else {
        return response()->json(['erro' => 'usuario ou senha invalidos']);  
    }
    

    }

    public function register(Request $request) {

        $request->validate($this->user->rules(), $this->user->feedback());


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['Sucesso', 'Usuario registrado com sucesso']);

    }

    public function logout() {
        auth('api')->logout();
        return response()->json(['logout' => 'Logout feito com sucesso']);
    }
    public function refresh() {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }
    public function me() {
        return response()->json(auth()->user());
    }
}
