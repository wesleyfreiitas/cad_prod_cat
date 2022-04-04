<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioControlador extends Controller
{
    public function __construct() {
    $this->middleware('segundo');
    }

    public function index() {
        echo "<h3>Lista de Produtos</h3>";
        echo "<ol>";
        echo  "<li>maria</li>";
        echo  "<li>joao</li>";
        echo  "<li>jose</li>";
        echo  "<li>marcos</li>";
        echo "</ol>"; 
    }
}
