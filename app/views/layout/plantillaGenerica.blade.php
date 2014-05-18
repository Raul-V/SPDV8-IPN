<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>@yield('titulo')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">    
	{{ HTML::style('css/bootstrap.min.css')}}
	{{ HTML::script('js/jquery.min.js') }}	
	{{ HTML::style('css/bootstrap-theme.css')}}
    {{ HTML::script('js/bootstrap.min.js') }}	   
	{{ HTML::script('js/bootstrap.js') }}
	
	{{ HTML::script('js/jConfirmAction/jconfirmaction.jquery.js') }}	
	
	<style>
	@section('estilo')
		
	@show
	</style>
	
	@section('script')
	@show
	
	@section('angular')
	
	@show
</head>
<body>
<!--Banner de la página-->
{{HTML::image('imagenes/bannerIPN.png')}}

@section('navbar')
<!--Se hace la parte del menu -->	
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">    <!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav">
					<li><a href="{{action('ProfesorController@getIndex')}}"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
					<li><a href="{{action('ProfesorController@getPerfil')}}"><span class="glyphicon glyphicon-user"></span> Mi Perfil</a></li>      
					<li><a href="{{action('ProfesorController@getDocumentos')}}"><span class="glyphicon glyphicon-folder-close"></span> Mis documentos</a></li>
				  </ul>
			  
			  
			  <!--Barra de navegacion de la derecha-->
			  <ul class="nav navbar-nav navbar-right">
			   <li><a href="#">Ayuda</a></li>
			   <li><a href="{{action('LogoutController@getLogout')}}">Cerrar Sesión</a></li>
			   <p class="navbar-text navbar-right">Mi nombre es:<a href="#" class="bg-success"> {{Auth::user()->nombre}} </a></p>
			  </ul>
			</div>

		</div><!-- /.container-fluid -->
</nav>    
@show
<!-- -->
    <br />
    <br />
	
	<!--Aqui va el contenido de la página-->
    <div class="container-fluid">  
	<div class="well">
	@if($messages=Session::get('messages'))	
		@foreach($messages as $message)
			<div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <center><strong>{{$message}}</strong></center>
			</div>
		@endforeach
	@endif
	@if($errors=Session::get('errores'))	
		@foreach($errors as $message)		
			<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <center><strong>{{$message}}</strong></center>
			</div>
		@endforeach
	@endif
		@yield('contenido')		
    </div>
    </div>

    

  

    
<script type="text/javascript">
			
			
			$(document).ready(function() {
				
				
				$('#eliminar').click(function(e) {
					
					e.preventDefault();
					thisHref	= $(this).attr('href');
					
					if(confirm('¿Estas seguro que deseas eliminar el documento?')) {
						window.location = thisHref;
					}
					
				});				
				
			});
		</script> 

</body>
</html>
