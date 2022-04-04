<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Para usar o recurso do auth precisa importar esse campo abaixo
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        echo "<h3>Lista de Usuários</h3>";
        echo "<ol>";
        echo  "<li>maria</li>";
        echo  "<li>joao</li>";
        echo  "<li>jose</li>";
        echo  "<li>marcos</li>";
        echo  "</ol>"; 
        echo  "<hr>";
        //propriedade check valida se o usuário está autenticado
        if(Auth::check()){
            $user = Auth::user();
            echo "<h4>Agora você está logado</h4>";
            echo "<p>".$user->name."</p>";        
            echo "<p>".$user->email."</p>";        
            echo "<p>".$user->id."</p>";        
        }else{
            echo "<h4>Você não está logado!</h4>";
        }
    }
}
