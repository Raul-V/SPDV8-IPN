@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Imparticion de eventos de actualización en educación continua.
@stop
@section('javaScript')
	
@stop
@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Imparticion de eventos de actualización en educación continua.
@stop

@section('formulario')

<br /><br />
			
            
            <div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="avance">Nombre del evento</label>
                        <div class="col-md-9">
                            <select id="avance" name="nombre" class="form-control">
                                <option @if(Form::old('nombre')=='Seminario')selected @endif value="Seminario">Seminario</option>
								<option value="Curso" @if(Form::old('nombre')=='Curso')selected @endif>Curso</option>
								<option @if(Form::old('nombre')=='Taller')selected @endif value="Taller">Taller</option>
								<option value="Diplomado" @if(Form::old('nombre')=='Diplomado')selected @endif>Diplomado</option>
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
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha de inicio</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaInicio" value="{{Form::old('fechaInicio')}}" placeholder="Ingresa la fecha de inicio del diplomado" class="form-control input-md" type="date">
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
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha de termino</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaTermino" value="{{Form::old('fechaTermino')}}" placeholder="Ingresa la fecha de termino del diplomado" class="form-control input-md" type="date">
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
                        <label class="col-md-3 control-label" for="numero">Horas de duración</label>
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
                        <label class="col-md-3 control-label" for="avance">Evaluacion</label>
                        <div class="col-md-9">
                            <select id="avance" name="tipoEvaluacion" class="form-control">
                                <option @if(Form::old('tipoEvaluacion')=='Con exámen')selected @endif value="Con exámen">Con exámen</option>
								<option @if(Form::old('tipoEvaluacion')=='Sin exámen')selected @endif value="Sin exámen">Sin exámen</option>
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
