@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Propuesta de estudios.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Plaza
@stop

@section('formulario')

	
	
	
	<br /><br />
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				  <div class="form-group">
					<label class="col-md-4 control-label" for="numero">Clave de la plaza: </label>  
					<div class="col-md-8">
					  <input id="textinput" name="clave" placeholder="Ingresa la clave de la plaza" class="form-control input-md" type="text" required autofocus value="{{Form::old('clavePlaza')}}">
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
                  <label class="col-md-4 control-label" for="avance">Tipo de plaza</label>
                  <div class="col-md-8">
                    <select id="avance" name="tipo" class="form-control">
                      <option value="En propiedad">En propiedad</option>                                                                  
					  <option value="Otra Opcion">Otra opción</option>
                    </select>
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>




            <br /><br />
			
			
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				  <div class="form-group">
					<label class="col-md-4 control-label" for="numero">Número de horas: </label>  
					<div class="col-md-8">
					  <input id="textinput" name="noHoras" placeholder="Ingresa el número de horas de la plaza" class="form-control input-md" type="text" required autofocus value="{{Form::old('clavePlaza')}}">
					</div>
				  </div>
				</div>                        
				<div class="col-md-2"><!--Ejemplos--></div>

            </div>
				
			<br />
			<br />
			
@stop
 