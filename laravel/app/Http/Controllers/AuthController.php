<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
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
