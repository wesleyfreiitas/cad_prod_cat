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
         return view('novocliente6');
        // 6)
        //return view('novocliente6');
    }

    public function store(Request $request)
    {
        // 3))
        /*
        primeira forma de fazer a validação do campo é neste cenário onde é informado ao campo que ele é requerido, informando ao láravel que dentro do objeto request
        o metodo validate é required minimo de 3 e no maximo 20. A especificação do campo unique pode ser feita informando o unique seguido do nome da tabela que o láravel vai verificar
        $request->validate([
            'nome' => 'required|min:3|unique:clientes|max:20'
        ]);

        Quando o validate é executado e é encontrado algum problema que impossibilite a execução do codigo, ele passa a exibir tudo em uma variável erros
        dessa forma podemos resgatar lá no formulario que está travado um vardump com a variável erros para recuperar a mensagem do láravel e tratar a exibição
No arquivo blade do cliente tem a {{vardump($errors)}}
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
        //No array de regras segue o mesmo padrão onde insiro para o láravel os tipos e as validações qu eue quero.
        $regras = [
            'nome'  => 'required|min:3|unique:clientes|max:20',
            'idade' => 'required|min:1',
            'email' => 'required|email'
        ];
        //No array de mensagens fica as mensagens que substiirão as de inglês com base nas regras de validações anteriores seguindo
        //a ordem de nome do campo que eu quero configurar a mensagem ponto tipo de validação
        $mensagens = [ 
//            'nome.required' => 'O nome é requerido.',
            'nome.min' => 'É necessário no mínimo 3 caracteres no nome.',
            //cria-se uma mensagem mais genérica e insiro o atributo(nome do campo) no meio da mensagem.
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
