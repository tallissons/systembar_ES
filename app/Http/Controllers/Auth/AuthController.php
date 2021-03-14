<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            if(Auth::user()->permissao == 0){// 0 - Cliente,   1- Gerente
                return redirect()->route('cardapio');
            }else{
                return redirect()->route('portal.home');
            }
        }else{
            return redirect()->route('login')->withErrors(['message' => 'Email ou senha incorreto!']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('cardapio');
    }

    public function formRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
      $data = $request->all();

      if($data['confsenha'] != $data['password']){
          return redirect()->route('formRegister')->withErrors(['message' => 'Confirmação de senha incorreto!']);
      }

      $data['permissao'] = 0;
      $data['password'] = bcrypt($data['password']);
      
      Usuario::create($data);

      return redirect()->route("login");
    }
}
