<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //A ideia é usar esse controlador para logar como admin
public function __construct()
{
    //esse admin após o auth eu estou informando que a autenticação é via o guard admin criado no config > auth
    $this->middleware('auth:admin');
}

    public function index(){
        return view('admin');
    }
}
