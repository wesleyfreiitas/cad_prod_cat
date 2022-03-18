<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/produtos', 'ControladorProduto@indexView');
Route::get('/categorias', 'ControladorCategoria@index');
Route::get('/categorias/novo', 'ControladorCategoria@create');
Route::post('/categorias', 'ControladorCategoria@store');
Route::get('/categorias/apagar/{id}', 'ControladorCategoria@destroy');
Route::get('/categorias/editar/{id}', 'ControladorCategoria@edit');
Route::post('/categorias/{id}', 'ControladorCategoria@update');
Route::get('/novoclient', 'ControllerClient@create');  // 1)

Route::get('/', 'ControllerClient@index');   // 2)

Route::post('/cliente', 'ControllerClient@store'); //2)





//##########################################################
use App\Client;
use App\Address;

Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach ($clientes as $c){
        echo "<p>ID: ". $c->id . "</p>";
        echo "<p>Nome: ". $c->nome . "</p>";
        echo "<p>Fone ". $c->telefone . "</p>";
        echo "<hr>";
        //primeira forma de ir até o relacionamento com a tabela usando uma consulta explícita
        //$e = Endereco::where('cliente_id',$c->id)->first();
        //Assim eu já utilizo o hasOne la do modelo
        echo "<p>Fone ". $c->endereco->rua . "</p>";
        echo "<p>Fone ". $c->endereco->numero . "</p>";
        echo "<p>Fone ". $c->endereco->bairro . "</p>";
        echo "<p>Fone ". $c->endereco->cidade . "</p>";
        echo "<p>Fone ". $c->endereco->uf . "</p>";
        echo "<p>Fone ". $c->endereco->cep . "</p>";
    }
});

Route::get('/enderecos', function () {
    $enderecos = Endereco::all();
    foreach ($enderecos as $e){
        echo "<p>ID: ". $e->cliente_id . "</p>";
        echo "---";
        echo "<p>Nome: ". $e->cliente->nome . "</p>";
        echo "<p>Fone ". $e->cliente->telefone . "</p>";
        echo "---";
        echo "<p>Nome: ". $e->nome . "</p>";
        echo "<p>Fone ". $e->rua . "</p>";
        echo "<p>Fone ". $e->numero . "</p>";
        echo "<p>Fone ". $e->bairro . "</p>";
        echo "<p>Fone ". $e->cidade . "</p>";
        echo "<p>Fone ". $e->uf . "</p>";
        echo "<p>Fone ". $e->cep . "</p>";
        echo "<hr>";
    }
});

Route::get('/inserir', function(){
    $c = new Cliente();
    $c->nome = "Jose Almeida";
    $c->telefone = "21458796";
    $c->save();
    $e = new Endereco();
    $e->rua = "Av. do Estado";
    $e->numero = 400;
    $e->bairro = "Centro";
    $e->cidade = "São Paulo";
    $e->uf = "SP";
    $e->cep = "32156-654";
    //usando o relacionamento do hastomany ou belongsto acesso c e o metodo encereco seguido do metodo save com o valor de e
    $c->endereco()->save($e);

    $c = new Cliente();
    $c->nome = "Marcos Almeida";
    $c->telefone = "36251498";
    $c->save();
    $e = new Endereco();
    $e->rua = "Av. do Ceara";
    $e->numero = 1400;
    $e->bairro = "Centro";
    $e->cidade = "Fortaleza";
    $e->uf = "CE";
    $e->cep = "32156-000";
    //Será feita a inserção dos dados usando o relacionamento.
    $c->endereco()->save($e);
});

Route::get('/clientes/json', function(){
    /*Essa consulta só busca os clientes, sem endereço.
    $clientes = Cliente::all();
    return $clientes->toJson();*/
    /*Dentro do with devo informar em um array o que deve ser carregado*/
    $clientes = Cliente::with(['endereco'])->get();
    return $clientes->toJson();
});
