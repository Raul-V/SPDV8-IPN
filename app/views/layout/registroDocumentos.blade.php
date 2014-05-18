<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('titulo')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">    
	{{HTML::style('css/bootstrap.min.css')}}
	<script src="//code.jquery.com/jquery.js"></script>
    {{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/jConfirmAction/jconfirmaction.jquery.js') }}
	<!--<link rel="stylesheet" type="text/css" href="css/estilo.css">-->
	@section('javaScript')
		<!--De momento vacio-->
	@show
</head>
<body>
<!--Se incluye el encabezado de la pagina y la imagen de la pagina -->
{{HTML::image('imagenes/bannerIPN.png','',array('class'=>'img-responsive'))}}

<!--Se hace la parte del menu -->
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
       <p class="navbar-text navbar-right">Mi nombre es:<a href="#" class="bg-success"> @yield('nombreUsuario') </a></p>
      </ul>
    </div><!-- /.navbar-collapse -->
	
	</div><!-- /.container-fluid -->
	</nav>		
<!-- -->
	
	
    <div class="container">
		@if(!empty($errors))
			@foreach($errors->all() as $error)
				<div class="alert alert-danger alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <span>Error: <span/>{{$error}}
				</div>				
			
				<!--<div class="alert alert-danger">{{$error}}</div>-->
			@endforeach
		@endif
		@if($errores=Session::get('errores'))
			@foreach($errores as $error)
				<div class="alert alert-danger alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <span>Error: <span/>{{$error}}
				</div>				
			
				<!--<div class="alert alert-danger">{{$error}}</div>-->
			@endforeach
		@endif
		
		
		
	
		{{ Form::open(array('files' => true,'name'=>'formulario')) }} 
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">@yield('tituloForm')</h3>
				</div>
				<div class="panel-body">
					@yield('formulario')
					<!--Botones que van al final del formulario-->
					@section('botones')
					<div class="row">
						<div class="col-md-2"> </div>
							<div class="col-md-8">

								<div class="form-group">                
								  <label class="col-md-4 control-label" for="registrar"></label>
								  <div class="col-md-8">
									<input type="submit" id="registrar" name="registrar" value="Registrar" class="btn btn-primary" />
									<a href="{{action('Profesor_RegistrarController@getIndex')}}" id="ask-custom" class="btn btn-danger">Cancelar</a>
									
								  </div>
								</div>  
							
							</div>
						<div class="col-md-2"> </div>
					</div>
					@show
					
					
					<div id="dialogConfirm"><span id="spanMessage"></span></div>
				</div> <!--FIN PANEL BODY-->
			</div><!--FIN PANEL PRIMARY-->	
				
		{{ Form::close() }}
	
    </div>
    
	
		<script type="text/javascript">
			
			
			$(document).ready(function() {
				
				
				$('#ask-custom').click(function(e) {
					
					e.preventDefault();
					thisHref	= $(this).attr('href');
					
					if(confirm('¿Estas seguro que deseas cancelar el registro?')) {
						window.location = thisHref;
					}
					
				});				
				
			});
		</script> 
	
	
    


    


</body>
</html>