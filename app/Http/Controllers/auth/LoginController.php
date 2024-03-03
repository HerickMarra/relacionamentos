<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        $users = User::all();
        return view('auth.login.login', compact('users'));
    }

    public function login(Request $request){
        if(Auth::attempt($request->user)){
            return response()->json([
                'status' => true
            ]);
        }


        return response()->json([
            'status' => false,
            'message' => "Credenciais inválidas"
        ],404);
    }


    public function logout(){
        Auth::logout();

        return redirect()->route('login');
    }
}
