@extends('layout.paginasProfesor')

@section('titulo')
	Modificar Datos.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Modificar Datos
@stop

@section('formulario')
                <br />
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="numero">Nombre(s):</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="nombre" placeholder="Nombre(s)" class="form-control input-md" type="text" required autofocus readonly value="{{$user->nombre}}">
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
                          <input id="textinput" name="apellidoP" placeholder="Apellido Paterno" class="form-control input-md" value="{{$user->apellidoP}}" type="text" readonly>
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
                          <input id="textinput" name="textinput" placeholder="Apellido Materno" class="form-control input-md" type="text" readonly value="{{$user->apellidoM}}">
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
                          <select id="avance" name="tipoEstadoCivil" class="form-control">
							  <option value="1">Soltero(a)</option>
							  <option value="2">Casado(a)</option>                      
							  <option value="2">Viudo(a)</option>
							  <option value="2">Union libre</option>
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
                        <label class="col-md-4 control-label" for="numero">Sexo:</label>  
                        <div class="col-md-8">
							<select id="avance" name="tipoGenero" class="form-control">
							  <option value="1">Hombre</option>
							  <option value="2">Mujer</option>                      
							  <option value="2">Indefinido</option>
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
                        <label class="col-md-4 control-label" for="numero">Dirección:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="direccion" placeholder="Dirección" class="form-control input-md" type="text">
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
                        <label class="col-md-4 control-label" for="numero">Teléfono:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="telefono" placeholder="Teléfono" class="form-control input-md" type="text">
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
                        <label class="col-md-4 control-label" for="numero">Correo electrónico:</label>  
                        <div class="col-md-8">
                          <input id="textinput" name="email" placeholder="Correo Electrónico" class="form-control input-md" type="email" value="{{$user->email}}">
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>

                <br />
                <br />

				<div class="row">
					<div class="col-md-2"> </div>
					  <div class="col-md-8">


						<div class="form-group">                

						  <label class="col-md-4 control-label" for="registrar"></label>
						  <div class="col-md-8">
							<button id="registrar" name="registrar" class="btn btn-primary">Registrar</button>
							<button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
						  </div>

						</div>  


					  </div>
					<div class="col-md-2"> </div>
				</div>
@stop
 