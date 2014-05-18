
<html lang="en">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{HTML::style('http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css')}}
    <!--<link href="" rel="stylesheet" media="screen">-->
	<!--<script src="//code.jquery.com/jquery.js"></script>-->
    {{HTML::script('http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js')}}
	
	
	<title>Bienvenido</title>
</head>
<body>

<div class="jumbotron">
  <h2>Sistema de Promoción Académica</h2>
  Recuerda que es muy importante que necesitas tu contraseña y tu numero de empleado para poder entrar al sistema de Promoción Académica.
<div class="row">
  <div class="col-xs-12 "><div class="panel panel-primary">
<div class="panel-heading">Datos Personales</div>
  <div class="panel-body">
		<table class="table table-hover">
				  <tr> 
					<td><h4>Nombre</h4></td>
					<td> {{$nombre.' '.$apellidoP.' '.$apellidoM}}.</td>
				  </tr>


				  <tr>
				  <td><h4>Número de Empleado</h4></td>
				  <td>{{$noEmpleado}}</td> 
				  </tr>


				  <tr>
				<td><h4>Contraseña</h4></td>
				<td>{{$password}}</td>
				   </tr>
		</table>
  </div>
  <div class="panel-footer">Comunicate con nosotros al: GrupoIS@estamoscontigo.com </div>
	</div></div>
	  <div class="col-md-6"></div>
</div>
  <p><a href="spdv1.jelastic.servint.net/public/login" class="btn btn-primary btn-lg" role="button">Visita Tu perfil</a></p>
</div>




	
</body>
</html>