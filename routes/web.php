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
//belongsto hasone para relacionamentos um para um

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
    /*Dentro do with devo informar em um array o que deve ser carregado, no caso o endereco porque é esse o nome do relacionamento criado no model de client*/
    $clientes = Client::with(['endereco'])->get();
    return $clientes->toJson();
});

################################################
//relacionamento um para muitos
use App\Produto;
use App\Categoria;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', function () {
    $cats = Categoria::all();
    if (count($cats) === 0) {
        echo "<h4>Você nao possui nenhuma categoria cadastrada</h4>";
    }
    else {
        foreach($cats as $c) {
            echo "<p>" . $c->id . ") " . $c->nome . "</p>";
        }
    }
});

Route::get('/produtos', function () {
    $prods = Produto::all();
    if (count($prods) === 0) {
        echo "<h4>Você nao possui nenhum produto cadastrado</h4>";
    }
    else {
        echo "<table>";
        echo "<thead><tr><td>Nome</td><td>Estoque</td><td>Preco</td><td>Categoria</td></tr></thead>";
        echo "<tbody>";
        foreach($prods as $p) {
            echo "<tr>";
            echo "<td>" . $p->nome . "</td>";
            echo "<td>" . $p->estoque . "</td>";
            echo "<td>" . $p->preco . "</td>";
            // echo "<td>" . $p->categoria_id . "</td>";
            echo "<td>" . $p->categoria->nome . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
});


Route::get('/categoriasprodutos', function () {
    $cats = Categoria::all();
    if (count($cats) === 0) {
        echo "<h4>Você nao possui nenhuma categoria cadastrada</h4>";
    }
    else {
        foreach($cats as $c) {
            echo "<h4>" . $c->id . ") " . $c->nome . "</h4>";
            $prods = $c->produtos;
            if (count($prods) > 0) {
                echo "<ul>";
                foreach($prods as $p) {
                    echo "<li>" . $p->nome . "</p>";
                }
                echo "</ul>";
            }
            else {
                echo "<h4>Categoria não possui produtos</h4>";
            }
            echo "<hr>";
        }
    }
});


Route::get('/categoriasprodutos/json', function () {
    $cats = Categoria::with("produtos")->get();
    return $cats->toJson();
});


Route::get('/adicionarproduto', function () {
    $cat = Categoria::find(1);
    $prod = new Produto();
    $prod->nome = "MEU NOVO produto adicionado";
    $prod->estoque = 20;
    $prod->preco = 130; 
    $prod->categoria()->associate($cat);
    $prod->save();
    return $prod->toJson();
});

Route::get('/desassociarproduto/{id}', function ($id) {
    $prod = Produto::find($id);
    if (isset($prod)) {
        $prod->categoria()->dissociate();
        $prod->save();
        return $prod->toJson();
    }
    return "Produto nao encontrado";
});

Route::get('/adicionarproduto/{cat}', function ($catid) {
    $cat = Categoria::with('produtos')->find($catid);
    $prod = new Produto();

    $prod->nome = "Novo produto adicionado";
    $prod->estoque = 30;
    $prod->preco = 100; 

    if(isset($cat)) {
        $cat->produtos()->save($prod); 
    }
    $cat->load('produtos'); //Atualizando produtos
    return $cat->toJson();;
});



Route::get('/produtosjson', function () {
    $prods = Produto::with('categoria')->get();
    return $prods;
});