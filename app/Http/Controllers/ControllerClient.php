<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

class ControllerClient extends Controller
{
    public function index()
    {
        $clientes = Client::all();
        return view ('clientes', compact('clientes'));
    }

    public function create()
    {
         return view('novocliente');
        // 6)
        //return view('novocliente6');
    }

    public function store(Request $request)
    {
        // 3))
        /*
        $request->validate([
            'nome' => 'required|min:3|unique:clientes|max:20'
        ]);        
        */

        // 4))
        /*
        $request->validate([
            'nome'  => 'required|min:3|unique:clientes|max:20',
            'idade' => 'required|min:18',
            'email' => 'required|email'
        ]);        
        */

        // 5))
        $regras = [
            'nome'  => 'required|min:3|unique:clientes|max:20',
            'idade' => 'required|min:1',
            'email' => 'required|email'
        ];
        $mensagens = [ 
//            'nome.required' => 'O nome é requerido.',
            'nome.min' => 'É necessário no mínimo 3 caracteres no nome.',
            'required' => 'O atributo :attribute não pode estar em branco.',  // Generico
            'email.required' => 'Digite um endereço de email.',
            'email.email' => 'Digite um endereço de email válido'
        ];
        $request->validate($regras, $mensagens);


        // 2)
        $cli = new Client();
        $cli->nome     = $request->input('nome');
        $cli->idade    = $request->input('idade');
        $cli->email    = $request->input('email');
        $cli->save();
        return redirect('/');;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
