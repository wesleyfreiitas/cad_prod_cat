<?php
use Illuminate\Http\Request;

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
use App\Product;
use App\Department;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', function () {
    $cats = Department::all();
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
    $prods = Product::all();
    if (count($prods) === 0) {
        echo "<h4>Você nao possui nenhum produto cadastrado</h4>";
    }
    else {
        echo "<table>";
        echo "<thead>
        <tr>
        <td>Nome</td>
        <td>Estoque</td>
        <td>Preco</td>
        <td>Categoria</td>
        </tr>
        </thead>";
        echo "<tbody>";
        foreach($prods as $p) {
            echo "<tr>";
            echo "<td>" . $p->nome . "</td>";
            echo "<td>" . $p->estoque . "</td>";
            echo "<td>" . $p->preco . "</td>";
            //echo "<td>" . $p->department_id . "</td>";
            echo "<td>" . $p->department->name . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
});


Route::get('/categoriasprodutos', function () {
    $cats = Department::all();
    if (count($cats) === 0) {
        echo "<h4>Você nao possui nenhuma categoria cadastrada</h4>";
    }
    else {
        foreach($cats as $c) {
            echo "<h4>" . $c->id . ") " . $c->name . "</h4>";
            $prods = $c->product;
            if (count($prods) > 0) {
                echo "<ul>";
                foreach($prods as $p) {
                    echo "<li>" . $p->name . "</p>";
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
    $cats = Department::with("product")->get();
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

########################################
//muitos para muitos

use App\Developer;
use App\Project;
use App\Alocation;

Route::get('/desenvolvedor_projetos', function () {
    $developers = Developer::with("project")->get();
    foreach($developers as $d) {
        echo "Nome do desenvolvedor: " . $d->nome . "<br>";
        echo "Cargo: " . $d->cargo . "<br>";
        if (count($d->projects ) > 0) {
            echo "Projetos: <br>";
            echo "<ul>";
            foreach($d->projects as $p) {
                echo "<li> Nome do projeto: " . $p->nome . " | ";
                echo "Horas do projeto: " . $p->estimativa_horas . " | ";
                echo "Horas trabalhadas pelo desenvolvedor: " . $p->pivot->horas_semanais . "</li>";
            }
            echo "</ul>";
        }
        echo "<hr>";
    }
    //$developers = Developer::all();
    //return $developers->toJson();
});


Route::get('/projeto_desenvolvedores', function () {
    $projects = Project::with("developers")->get();
    foreach($projects as $p) {
        echo "Nome do projeto: " . $p->nome . "<br>";
        echo "Estimativa de horas: " . $p->estimativa_horas . "<br>";
        if (count($p->developers ) > 0) {
            echo "Desenvolvedores: <br>";
            echo "<ul>";
            foreach($p->developers as $d) {
                echo "<li> Nome do desenvolvedor: " . $d->nome . " | ";
                echo "Cargo: " . $d->cargo . " | ";
                echo "Horas trabalhadas pelo desenvolvedor: " . $d->pivot->horas_semanais . "</li>";
            }
            echo "</ul>";
        }
        echo "<hr>";
    }
    //$projects = Project::all();
    //return $projects->toJson();
});


Route::get('/alocar', function () {
    $proj = Project::find(4);
    if (isset($proj)) {
        // $proj->desenvolvedores()->attach(1, ['horas_semanais' => 50]);
        // $proj->desenvolvedores()->attach(2, ['horas_semanais' => 50]);
        // $proj->desenvolvedores()->attach(3, ['horas_semanais' => 50]);
        
        // ou

        $proj->desenvolvedores()->attach([
            1 => ['horas_semanais' => 40],
            2 => ['horas_semanais' => 50],
            3 => ['horas_semanais' => 60],
        ]);
        return "OK";
    }
    return "Projeto nao encontrado";
});


Route::get('/desalocar', function () {
    $proj = Project::find(4);
    if (isset($proj)) {
        $proj->desenvolvedores()->detach(1);
        $proj->desenvolvedores()->detach(2);
        $proj->desenvolvedores()->detach(3);
        return "OK";
    }
    return "Projeto nao encontrado";
});

#####################################
//middleware
//é preciso declarar o middleware quando for usar ele com o nome atribuido no kernel.php
//use \App\Http\Middleware\ProdutoAdmin;
//Route::get('/usuarios', 'UsuarioControlador@index')->middleware('segundo');
//acima foi chamado direto no arquivo de rotas.
//Abaixo foi chamado no controlador
//Route::get('/usuarios', 'UsuarioControlador@index');
//Abaixo vai ser chamado o middleware apenas para requisições web onde eu adicionei no array web.
Route::get('/usuarios', 'UsuarioControlador@index');
//Passagem de parâmetro para o midd
Route::get('/terceiro', function(){
    return "Passou pelo terceiro";
})->middleware('terceiro:Wesley,24');

Route::get('/produtos', 'ProdutoController@index');

Route::get('/negado', function () {
    // return "Acesso negado. Somente usuarios logados podem acessar os produtos."; // 1))
    return "Acesso negado. Somente administrador tem acesso aos produtos"; // 2))
})->name('negado');

Route::post('/login', function (Request $request) {
    $admin = false;
    $passwdOK = false;
    switch( $request->user ) {
        case 'joao':
            $passwdOK = $request->passwd === "senhajoao";
            $admin = true;
            break;
        case 'marcos':
            $passwdOK = $request->passwd === "senhamarcos";
            $admin = false;
            break;
        case 'default':
            $passwdOK = false;
    }
    if ($passwdOK) {
        $login = [ 'user' => $request->user, 'isadmin' => $admin ];
        //retorna a session do usuário que fez o login
        $request->session()->put('login', $login);
        return response("Tudo OK!", 200);
    }
    else {
        //se ele errou a senha os dados serão apagados com o flush
        $request->session()->flush();
        return response("Erro no login", 404);
    }
});

Route::get('/logout', function (Request $request) {
    $request->session()->flush();
    return response("Deslogado com sucesso.", 200);
});
//autenticação simples
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logar', 'LoginController@index');
Route::get('/view', function(){
    return view('testeview');
});

//Autenticação multiusuário
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


//paginação sem usar jquery
Route::get('/pagination', 'PaginationController@index');

//paginação usando jquery
Route::get('/pagination2', 'PaginationController@indexjs');
Route::get('/json', 'PaginationController@indexjson');

