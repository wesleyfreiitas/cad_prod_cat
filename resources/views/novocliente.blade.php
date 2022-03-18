<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Pagina de Clientes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
		body { padding: 20px; }
	</style>
</head>
<body>

  <main role="main">
    <div class="row">
      <div class="container  col-sm-8 offset-md-2">

        <div class="card border">
          <div class="card-header">
            <h5 class="card-title">Cadastro de Cliente</h5> 
          </div>
          <div class="card-body">
            <form action="/cliente" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label for="nome">Nome do Cliente</label>
                <input type="text" class="form-control" name="nome"  id="nome" placeholder="Nome do Cliente">
              </div>
              <div class="form-group">
                <label for="idade">Idade do Cliente</label>
                <input type="number" class="form-control" name="idade"  id="idade" placeholder="Idade do Cliente">
              </div>

              <div class="form-group">
                <label for="endereco">Email</label>
<!--
                <input type="email" class="form-control" name="email"  id="email" placeholder="E-mail do Cliente">
-->
                <input type="text" class="form-control" name="email"  id="email" placeholder="E-mail do Cliente">
              </div>

              <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
              <button type="reset" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
          </div>
          
<!--{{-- 3) --}}-->
@if ($errors->any())          
          <div class="card-footer">
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
          {{ $error }}
        </div>
    @endforeach
          </div>
@endif          

        </div>

      </div>
    </div>
  </main>
  
  <!--{{-- 3) --}}
  {{ 
    var_dump($errors) 
  }} -->



  <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</body>
</html>

