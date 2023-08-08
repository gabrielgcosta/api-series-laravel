<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function create(Request $request){
        return view('users.create');
    }

    public function store(Request $request){
        $data = $request->except(['_token']);
        //Inicialmente é feito o hash da senha, utilizando uma facade do laravel, que realiza as
        //configurações de qual algoritmo ser utilizado para criptografar sozinho
        $data['password'] = Hash::make($data['password']);
        //é criado o usuário, e então feito o login automático desse usuário depois do login
        $user = User::create($data);
        Auth::login($user);

        return to_route('series.index');
    }
}
