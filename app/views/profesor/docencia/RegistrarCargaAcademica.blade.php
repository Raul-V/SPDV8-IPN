@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Cursos.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Carga académica.
@stop

@section('formulario')

			<br /><br />
			<div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="avance">Modo de calificar</label>
                        <div class="col-md-9">
                            <select id="avance" name="modoCalificar" class="form-control">
                                <option value="Semestre">Semestre</option>
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
                                <option value="Nivel Superior o Medio Superior">Nivel Superior o Medio Superior</option>
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
                        <label class="col-md-3 control-label" for="numero">Total de horas</label>
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
                        <label class="col-md-3 control-label" for="numero">Año</label>
                        <div class="col-md-9">
                            <input id="textinput" name="año" value="{{Form::old('año')}}" placeholder="Ejemplo: 2012" class="form-control input-md" type="text" required>
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
                        <label class="col-md-3 control-label" for="constancia">Horario o constancia</label>
                        <div class="col-md-9">
                            {{Form::file('constanciaFile')}}
                                </div>
                    </div>
                    <br /><br />
                </div>
                <div class="col-md-2"> </div>
            </div>
@stop