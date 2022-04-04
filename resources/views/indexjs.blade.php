<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link href="" rel="stylesheet">
        <title>Pagination</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
    </head>
    <body>

  <div class="container">
    <div class="card text-center">
      <div class="card-header">
       	Tabela de Clientes 
      </div>
      <div class="card-body">
        <h5 class="card-title" id="cardtitle"></h5>

        <table class="table table-hover" id="tabelaClientes">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Sobrenome</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="card-footer">

        <nav id="paginationNav">
          <ul class="pagination">
          </ul>
        </nav>

<!--
        <nav id="paginationNav">
          <ul class="pagination">
            <li class="page-item disabled">
              <a class="page-link" href="#">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
-->
        
      </div>
    </div>

  </div>

  <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    
    function getNextItem(data) {
        i = data.current_page+1;
        if (data.current_page == data.last_page) 
            s = '<li class="page-item disabled">';
        else
            s = '<li class="page-item">';
        s += '<a class="page-link" ' + 'pagina="'+i+'" ' + ' href="javascript:void(0);">Próximo</a></li>';
        return s;
    }
    
    function getPreviousItem(data) {
        i = data.current_page-1;
        if (data.current_page == 1) 
            s = '<li class="page-item disabled">';
        else
            s = '<li class="page-item">';
        s += '<a class="page-link" ' + 'pagina="'+i+'" ' + ' href="javascript:void(0);">Anterior</a></li>';
        return s;
    }
    //logica de funcionamento do seletor de páginas active
    function getItem(data, i) {
        if (data.current_page == i) 
            s = '<li class="page-item active">';
        else
            s = '<li class="page-item">';
        s += '<a class="page-link" ' + 'pagina="'+i+'" ' + ' href="javascript:void(0);">' + i + '</a></li>';
        return s;
    }

    function montarPaginator(data) {
        
        $("#paginationNav>ul>li").remove();

        $("#paginationNav>ul").append(
            getPreviousItem(data)
        );
        // for (i=1;i<=data.last_page;i++) {
        //     $("#paginationNav>ul").append(
          //Passado o data que é o objeto e o número do item aque a gente quer 
        //         getItem(data,i)
        //     );
        // }
        //logica da limitação de páginas centralizando o active
        n = 10;
        
        if (data.current_page - n/2 <= 1)
            inicio = 1;
        else if (data.last_page - data.current_page < n)
            inicio = data.last_page - n + 1;
        else 
            inicio = data.current_page - n/2;
        
        fim = inicio + n-1;

        for (i=inicio;i<=fim;i++) {
            $("#paginationNav>ul").append(
                getItem(data,i)
            );
        }
        $("#paginationNav>ul").append(
            getNextItem(data)
        );
    }
    
    function montarLinha(cliente) {
        return '<tr>' +
            '  <th scope="row">' + cliente.id + '</th>' +
            '  <td>' + cliente.nome + '</td>' +
            '  <td>' + cliente.sobrenome + '</td>' +
            '  <td>' + cliente.email + '</td>' +
            '</tr>';
    }

    function montarTabela(data) {
        //Data é o resp do carregar clientes
        $("#tabelaClientes>tbody>tr").remove();
        for(i=0;i<data.data.length;i++) {
            $("#tabelaClientes>tbody").append(
                montarLinha(data.data[i])
            );
        }
    }

    function carregarClientes(pagina) {
        //O laravel espera receber o parametro page
        $.get('/json',{page: pagina}, function(resp) {
            console.log(resp);
            console.log(resp.data.length);
//Recebe o resp que é o retorno do get para realizar a montagem da tabela
            montarTabela(resp);
            montarPaginator(resp);
            //gerando o evento para passar o valor de pagina ao clicar e chamar a função
            //carregar clientes
            $("#paginationNav>ul>li>a").click(function(){
              //o this é o item e attr é a pagina clicada
                // console.log($(this).attr('pagina') );
                carregarClientes($(this).attr('pagina'));
            })
            $("#cardtitle").html( "Exibindo " + resp.per_page + 
                " clientes de " + resp.total + 
                " (" + resp.from + " a " + resp.to +  ")" );
        }); 
    }
//De cara ao carregar os toda a pagina essa será a primeira função a ser executada
//Informando que quero que a primeira página seja a 1. Esse 1 é passado para como atributo ao
//page da função carregarClientes
    $(function(){
        carregarClientes(1);
    });

  </script>

</body>
</html>
