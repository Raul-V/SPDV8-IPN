@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Cursos.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Cursos.
@stop

@section('formulario')

			<br /><br />
             
            
            <div class="row">
                <div class="row">
                    <div class="col-md-5 col-md-offset-5">
                        <h3>Periodo</h3>
                    </div>
                </div>
                <div class="col-md-2"> </div>
                
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="claveRegistro">Inicio</label>
                        <div class="col-md-9">
                            <input id="textinput" name="fechaInicio" value="{{Form::old('fechaInicio')}}" placeholder="Ingresa la fecha de inicio" class="form-control input-md" type="date" required>
                                </div>
                    </div>
                    
                    
                </div>
                
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="claveRegistro">Término</label>
                        <div class="col-md-9">
                            <input id="textinput" name="fechaTermino" value="{{Form::old('fechaTermino')}}" placeholder="Ingresa la fecha de termino" class="form-control input-md" type="date" required>
                                </div>
                    </div> 
                    
                </div>
                
                <div class="col-md-2"> </div>
                
            </div>


            <br /><br />
            
            
            <div class="row">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <h3>Constancia de impartición</h3>
                    </div>
                </div>
                <div class="col-md-2"> </div>
                
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="claveRegistro">Numero</label>
                        <div class="col-md-9">
                            <input id="textinput" name="noConstancia" value="{{Form::old('noConstancia')}}" placeholder="D/ESCOM/ICFIM/01/201" class="form-control input-md" type="text" required>
                                </div>
                    </div>
                    
                    
                </div>
                
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>
                        <div class="col-md-9">
                            <input id="textinput" name="fechaConstancia" value="{{Form::old('fechaConstancia')}}" placeholder="Ingresa la fecha de fin" class="form-control input-md" type="date" required>
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
                        <label class="col-md-3 control-label" for="avance">Evaluación</label>
                        <div class="col-md-9">
                            <select id="avance" name="evaluacion" class="form-control">
                                <option value="Con exámen">Con exámen</option>
                                <option value="Sin exámen">Sin exámen</option>
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
                        <label class="col-md-3 control-label" for="constancia">Constancia de validación</label>
                        <div class="col-md-9">
                            {{Form::file('constanciaFile')}}
                                </div>
                    </div>
                    <br /><br />
                    <span class="help-block">* Anexar fotocopia de la constancia que acredite al docente haber sido instructor del (de los) curso (cursos) o eventos (eventos), detallando: título, número de horas efectivas, número de registro, nombre de curso o módulo, lugar, fecha, periodo de realización y si se practicó o no exámen, emitida por la DEMS, DES, o SIP (Secretaría de Investigación y Posgrado), según corresponda.</span>
                    
                </div>
                <div class="col-md-2"> </div>
            </div>
            
            
            
            
            <br /><br />
			
@stop