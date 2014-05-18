@extends('layout.registroDocumentos')

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
                          <input id="textinput" name="textinput" placeholder="Nombre(s)" class="form-control input-md" type="text" required autofocus readonly value="Raúl">
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
                          <input id="textinput" name="textinput" placeholder="Apellido Paterno" class="form-control input-md" value="Vivanco" type="text" readonly>
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
                          <input id="textinput" name="textinput" placeholder="Apellido Materno" class="form-control input-md" type="text" readonly value="Borgonio">
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
                          <select id="avance" name="tipoEstadocivil" class="form-control">
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
                          <input id="textinput" name="textinput" placeholder="Dirección" class="form-control input-md" type="text">
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
                          <input id="textinput" name="textinput" placeholder="Teléfono" class="form-control input-md" type="text">
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
                          <input id="textinput" name="textinput" placeholder="Correo Electrónico" class="form-control input-md" type="email">
                        </div>
                      </div>
                    </div>                        
                    <div class="col-md-2"><!--Ejemplos--></div>

                </div>


	
@stop
 