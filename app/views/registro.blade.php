<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="..//code.jquery.com/jquery.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>


	<!--<link rel="stylesheet" type="text/css" href="css/estilo.css">-->
</head>
<body>
<!--Se incluye el encabezado de la pagina y la imagen de la pagina -->
<img src="../imagenes/bannerIPN.png">

<!--Se hace la parte del menu -->
	<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">    <!-- Brand and toggle get grouped for better mobile display -->
    

    <!-- Collect the nav links, forms, and other content for toggling -->    
    <div class="container">
            <br />          
            <br />
            <br />
            <br />
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
			<br />
			<br />
            {{Form::open()}}
                <h3 class="form-signin-heading">Registro</h2>                
                  <br />
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Nombre(s):</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="nombre" placeholder="Nombre(s)" value="{{Form::old('nombre')}}"  class="form-control input-md" type="text" required autofocus >
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>               

                <br />

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Apellido Paterno:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="apellidoP" value="{{Form::old('apellidoP')}}" placeholder="Apellido Paterno" class="form-control input-md" type="text" required>
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>


                <br />


                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Apellido Materno:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="apellidoM" value="{{Form::old('apellidoM')}}" placeholder="Apellido Materno" class="form-control input-md" type="text" required> 
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>


                <br />


                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Número de empleado:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="noEmpleado" value="{{Form::old('noEmpleado')}}"  placeholder="Numero de empleado" class="form-control input-md" type="text" required>
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>

				
				
				
				
				
				<br />
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Institucion:</label>  
                        <div class="col-md-8">
                          <select id="avance" name="institucion" class="form-control">
								@foreach($instituciones as $institucion)
									<option value="{{$institucion->nombre}}">{{$institucion->nombre}}</option>
								@endforeach
							</select> 
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>
				
				
				

                <br />
				
				

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Correo Electronico:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="email" value="{{Form::old('email')}}" placeholder="Correo electronico" class="form-control input-md" type="email" required>
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>
                <br />

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Contraseña</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="password"  placeholder="Contraseña" class="form-control input-md" type="password" required>
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>

				
				
				
				
				
				
				
                <br />
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Calle:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="calle" placeholder="Ingresa la calle" value="{{Form::old('calle')}}"  class="form-control input-md" type="text" required  >
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>  
				
				<br />
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Número:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="numero" placeholder="Ingresa el número" value="{{Form::old('numero')}}"  class="form-control input-md" type="text" required  >
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>  
				
				<br />
				
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Colonia:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="colonia" placeholder="Ingresa la colonia" value="{{Form::old('colonia')}}"  class="form-control input-md" type="text" required  >
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>  
				
				<br />
				
				
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Entidad Federativa(Delegacion):</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="entidad" placeholder="Ingresa la entidad federativa" value="{{Form::old('entidad')}}"  class="form-control input-md" type="text" required  >
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>  
				
				<br />
				
				
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Ciudad(Estado):</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="ciudad" placeholder="Ingresa la ciudad" value="{{Form::old('ciudad')}}"  class="form-control input-md" type="text" required  >
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>  
				
				<br />
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Codigo Postal:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="codigoPostal" placeholder="Ingresa el codigo postal" value="{{Form::old('codigoPostal')}}"  class="form-control input-md" type="text" required  >
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>  
				
				<br />
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Sexo:</label>  
                        <div class="col-md-8">
							<select id="avance" name="sexo" class="form-control">
							  <option value="Hombre">Hombre</option>
							  <option value="Mujer">Mujer</option>                      
							  <option value="Indefinido">Indefinido</option>
							</select>  
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>
				
				
				<br />
				
				<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Estado civil:</label>  
                        <div class="col-md-8">
                          <select id="avance" name="estadoCivil" class="form-control">
							  <option value="Soltero(a)">Soltero(a)</option>
							  <option value="Casado(a)">Casado(a)</option>                      
							  <option value="Viudo(a)">Viudo(a)</option>
							  <option value="Union libre">Union libre</option>
							</select> 
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>
				
				
				
				<br />
				
				
				
				
				
				
				
				
				
				
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-5">
                        
                          <button class="btn btn-primary" type="submit">Registrarse</button>
                          <a id="cancelar" name="cancelar" class="btn btn-danger" href="../login">Cancelar</a>
                        
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>


                
            {{Form::close()}}
    </div>
    

    

  </div><!-- /.container-fluid -->
</nav>		
<!-- -->
    


</body>
</html>
