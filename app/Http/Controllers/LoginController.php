<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function store(Request $request){
        //Nesse if o sistema verifica se o usuário já está cadastrado no sistema
        //Caso esteja cadastrado, o próprio attempt já realiza o login do usuário
        if (!Auth::attempt($request->only((['email', 'password'])))){
            return redirect()->back()->withErrors('Usuário ou senha inválidos');
        }
        return to_route('series.index');
    }

    public function destroy(){
        Auth::logout();

        return to_route('login');
    }
}
