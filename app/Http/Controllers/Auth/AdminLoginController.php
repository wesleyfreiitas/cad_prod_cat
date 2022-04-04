<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        //O guest valida se o usuário tá ou n tá logado, sé for confidado ele é redirecionado par atela de login
        $this->middleware('guest:admin');
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //usei o auth passei o guard que configurei fiz a tentativa com o metodo attenmpt passando meu array de credenciais e passei o checkbox do remember que retornara um booleano para a variavel authOK
        $authOK = Auth::guard('admin')->attempt($credentials, $request->remember);

        if ($authOK){
            return redirect()->intended(route('admin.dashboard'));
        }
            return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function index(){
        return view('auth.admin-login');
    }
}
