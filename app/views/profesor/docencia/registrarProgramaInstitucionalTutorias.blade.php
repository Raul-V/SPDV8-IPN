@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Programa institucional de Tutorias.
@stop
@section('javaScript')
	
@stop
@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Programa institucional de tutorias.
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
                                <option @if(Form::old('nombre')=='Coordinador')selected @endif value="Coordinador">Coordinador</option>
								<option value="Tutor" @if(Form::old('nombre')=='Tutor')selected @endif>Tutor</option>
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
                                <option @if(Form::old('nivel')=='Nivel Superior')selected @endif value="Nivel Superior">Nivel Superior</option>
								<option @if(Form::old('nivel')=='Nivel Medio Superior')selected @endif value="Nivel Medio Superior">Nivel Medio Superior</option>
								<option @if(Form::old('nivel')=='Posgrado')selected @endif value="Posgrado">Posgrado</option>
								
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
                        <label class="col-md-3 control-label" for="numero">Número de horas semana-semestre</label>
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
                        <label class="col-md-3 control-label" for="numero">Total de alumnos</label>
                        <div class="col-md-9">
                            <input id="textinput" name="alumnos" value="{{Form::old('alumnos')}}" placeholder="Ejemplo: 48" class="form-control input-md" type="text" required>
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
                                <option @if(Form::old('semestre')=='1er Semestre')selected @endif value="1er Semestre">1er Semestre</option>
								<option @if(Form::old('semestre')=='2do Semestre')selected @endif value="2do Semestre">2do Semestre</option>
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
                            <input id="textinput" name="año" value="{{Form::old('año')}}" placeholder="Ejemplo: 2010" class="form-control input-md" type="text" required>
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
                        <label class="col-md-3 control-label" for="avance">Calidad</label>
                        <div class="col-md-9">
                            <select id="avance" name="calidad" class="form-control">
								<option @if(Form::old('calidad')=='Ninguna')selected @endif  value="Ninguna">Ninguna</option>
                                <option @if(Form::old('calidad')=='Excelente')selected @endif value="Excelente">Excelente</option>
								<option @if(Form::old('calidad')=='Bueno')selected @endif value="Bueno">Bueno</option>
								<option @if(Form::old('calidad')=='Regular')selected @endif value="Regular">Regular</option>
                            </select>
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

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Numero</label>  
                  <div class="col-md-9">
                    <input id="textinput" value="{{Form::old('noConstancia')}}" name="noConstancia" placeholder="Ingresa el numero de constancia de validación" class="form-control input-md" type="text" required>                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaConstancia" value="{{Form::old('fechaConstancia')}}"  placeholder="Ingresa la fecha de la constancia" class="form-control input-md" type="date" required>                    
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
