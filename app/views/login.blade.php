<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Iniciar sesión</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   {{HTML::style('css/bootstrap.min.css')}}
	{{ HTML::script('js/jquery.min.js') }}	
	{{HTML::style('css/bootstrap-theme.css')}}
    {{ HTML::script('js/bootstrap.min.js') }}	   
	{{ HTML::script('js/bootstrap.js') }}
    
    

	<style>
		body { 
		background: url({{asset('imagenes/ipn.jpg')}}) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}

		.panel-default {
		opacity: 0.92;
		margin-top:30px;
		}
		.form-group.last { margin-bottom:0px; }
	
	
	</style>
	<!--<link rel="stylesheet" type="text/css" href="css/estilo.css">-->
</head>
<body>
<!--Se incluye el encabezado de la pagina y la imagen de la pagina -->


<!--Se hace la parte del menu -->
		
  <div class="container-fluid">    <!-- Brand and toggle get grouped for better mobile display -->
    

    <!-- Collect the nav links, forms, and other content for toggling -->    
	
	
	
	<div class="container">
	
	
		<div class="row">
			<div class="col-md-5 col-md-offset-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-user"></span> Iniciar Sesión</div>
					<div class="panel-body">
						@if($errors=Session::get('errores'))	
							@foreach($errors as $message)		
								<div class="alert alert-danger alert-dismissable">
								  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								  <center><strong>{{$message}}</strong></center>
								</div>
							@endforeach
						@endif
						<form class="form-horizontal" role="form" method='POST'>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">
								Número de Empleado</label>
							<div class="col-sm-8">
								<input type="text" value="{{Form::old('noEmpleado')}}" name="noEmpleado" class="form-control" id="inputEmail3" placeholder="Número de empleado" required>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">
								Constraseña</label>
							<div class="col-sm-8">
								<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Contraseña" required>
							</div>
						</div>
						
						<!--
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<div class="checkbox">
									<label>
										<input type="checkbox"/>
										Remember me
									</label>
								</div>
							</div>
						</div>-->
						
						<div class="form-group last">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-success btn-sm">
									Iniciar sesión</button>
									 <button type="reset" class="btn btn-default btn-sm">
									Limpiar campos</button>
							</div>
						</div>
						</form>
					</div>
					<div class="panel-footer">
						¿No estas registrado? <a href="login/registro">Registrate aqui</a>
						<br />
						¿Has olvidado tu contraseña? <a href="login/registro">Recupera tu contraseña aqui</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<!--	
	
    <div class="container">
        <br />          
		<br />
		<br />
		<br />
			@if($errors=Session::get('errores'))	
				@foreach($errors as $message)		
					<div class="alert alert-danger alert-dismissable">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <center><strong>{{$message}}</strong></center>
					</div>
				@endforeach
			@endif    
			
              <div class="row">
                  <div class="col-lg-4"></div>
                   <div class="col-lg-4">

                      
					  {{Form::open()}}
                        <h2 class="form-signin-heading">Iniciar Sesión</h2>
                        <br />
                        <input type="text" name="noEmpleado" value="{{Form::old('noEmpleado')}}" class="form-control" placeholder="Número de empleado" required autofocus regex="\d\d\d\d\d\d">
                        <br />
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>
						
						{{Form::close()}}
                      

                      <br />
                      <br />
                      <div class="alert alert-info">¿Aun no estas registrado? <a href="login/registro">Registrarse</a></div>
                      <br />
                      <div class="alert alert-warning">¿Has olvidado tu contraseña? <a href="#">Recuperar contraseña</a></div>



                   </div> 
                  <div class="col-lg-4"></div>

              </div>            

            </div>


      
    </div>-->
    

    

  </div><!-- /.container-fluid -->

<!-- -->
    


</body>
</html>