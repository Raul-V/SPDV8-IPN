@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Programa institucional de orientación juvenil.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Programa institucional de orientación juvenil.
@stop

@section('formulario')

<br /><br />
			<div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="avance">Nombre de la actividad</label>
                        <div class="col-md-9">
                            <select id="avance" name="nombre" class="form-control">
                                <option value="Maestro tutor">Maestro tutor</option>
								<option value="Atención Especializada">Atención Especializada</option>
								<option value="Instructor del diplomado y/o seminario de desarrollo humano">Instructor del diplomado y/o seminario de desarrollo humano</option>
								
                            </select>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-2"> </div>
            </div>
            
           


			
            <br /><br />
            
			
			<div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="avance">Nivel</label>
                        <div class="col-md-9">
                            <select id="avance" name="nivel" class="form-control">
                                <option value="Nivel Superior">Nivel Superior</option>
								<option value="Nivel Medio Superior">Nivel Medio Superior</option>
								<option value="Posgrado">Posgrado</option>
								
                            </select>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-2"> </div>
            </div>


            <br /><br />
			
			<div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="numero">Grupo</label>
                        <div class="col-md-9">
                            <input id="textinput" name="grupo" value="{{Form::old('grupo')}}" placeholder="Ejemplo: 2CV1" class="form-control input-md" type="text" required>
                                </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-2"> </div>
            </div>
            
            
            <br /><br />
			
            
            <div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="numero">Número de horas</label>
                        <div class="col-md-9">
                            <input id="textinput" name="noHoras" value="{{Form::old('noHoras')}}" placeholder="Ejemplo: 48" class="form-control input-md" type="text" required>
                                </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-2"> </div>
            </div>
            
            
            <br /><br />
			
			
			
			<div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="avance">Semestre</label>
                        <div class="col-md-9">
                            <select id="avance" name="semestre" class="form-control">
                                <option value="1er Semestre">1er Semestre</option>
								<option value="2do Semestre">2do Semestre</option>
                            </select>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-2"> </div>
            </div>
			
			
            <br /><br />
			
			<div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="numero">Año</label>
                        <div class="col-md-9">
                            <input id="textinput" name="año" value="{{Form::old('año')}}" placeholder="Ejemplo: 48" class="form-control input-md" type="text" required>
                                </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-2"> </div>
            </div>
            
            
            <br /><br />
			
			
			<div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia de validación</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-3"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Numero</label>  
                  <div class="col-md-9">
                    <input id="textinput" value="{{Form::old('noConstancia')}}" name="noConstancia" placeholder="Ingresa del oficio de autorización" class="form-control input-md" type="text" required>                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-3">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaConstancia" value="{{Form::old('fechaConstancia')}}"  placeholder="Ingresa la fecha de la constancia" class="form-control input-md" type="date" required>                    
                  </div>
                </div> 

              </div>

              
              <div class="col-md-3">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Registro</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="registro" value="{{Form::old('registro')}}"  placeholder="Ingresa el número del registro" class="form-control input-md" type="text" required>                    
                  </div>
                </div> 

              </div>
			  
			  
			  
            </div>            



            <br /><br />
			
			
			<div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="constancia">Constancia de validación</label>
                  <div class="col-md-9">
                    {{Form::file('constanciaFile')}}
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>            
			
			
			
			<br />
			<br />	
@stop