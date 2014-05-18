<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('titulo')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
	{{HTML::style('css/bootstrap.min.css')}}
    {{ HTML::script('js/bootstrap.min.js') }}
    


	<!--<link rel="stylesheet" type="text/css" href="css/estilo.css">-->
</head>
<body>
<!--Se incluye el encabezado de la pagina y la imagen de la pagina -->
<!--<img src="../imagenes/bannerIPN.png">-->
{{ HTML::image('imagenes/bannerIPN.png') }}

<!--Se hace la parte del menu -->
@section('navbar')
	<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Menú</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{action('ProfesorController@getIndex')}}"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <li><a href="{{action('ProfesorController@getPerfil')}}"><span class="glyphicon glyphicon-user"></span> Mi Perfil</a></li>      
        <li><a href="{{action('ProfesorController@getDocumentos')}}"><span class="glyphicon glyphicon-folder-close"></span> Mis documentos</a></li>
      </ul>
      <!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Número de Empleado">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>-->
	  
	  
      <ul class="nav navbar-nav navbar-right">
       <li><a href="#">Ayuda</a></li>
       <li><a href="{{action('LogoutController@getLogout')}}">Cerrar Sesión</a></li>
       <p class="navbar-text navbar-right">Mi nombre es:<a href="#" class="bg-success"> {{Auth::user()->nombre.''.Auth::user()->apellidoPaterno}} </a></p>
      </ul>
    </div><!-- /.navbar-collapse -->
	
	  </div><!-- /.container-fluid -->
	</nav>	
@show	
<!-- -->
	
	
    <div class="container">		
		@yield('contenido')
    </div>
    

    


    


</body>
</html>