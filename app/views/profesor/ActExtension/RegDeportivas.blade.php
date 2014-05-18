@extends('layout.registroDocumentos')

@section('titulo')
  Registrar impartición de actividades y/o talleres culturales
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Registrar impartición de actividades y/o talleres culturales
@stop

@section('formulario')


	<br /><br />
			<div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Nombre de la Actividad</label>
                <div class="col-md-5">
                  <input class="form-control input-md" value="{{Form::old('evento')}}" type="text" id="evento" required name="evento"/>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

	<div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Tipo de Evento</label>
                <div class="col-md-5">
                  <select class="form-control input-md" id="tipo" value="{{Form::old('tipo')}}"  required name="tipo">                    
                        <option value=1>Interpolitécnicos= 3</option>
                        <option value=2>Nacionales=5</option>
                        <option value=3>Internacionales=7</option>
                      
                    </select>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Fecha de Realización</label>
                <div class="col-md-5">
                  <input class="form-control input-md" value="{{Form::old('fecha')}}" type="date" id="fecha" required name="fecha"/>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>


		<div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="noConstancia">No.</label>  
                <div class="col-md-5">
                    <input id="noConstancia" name="noConstancia" placeholder="número" class="form-control input-md" type="text" value="{{Form::old('noConstancia')}}">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>




            
              
             <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaConstancia">Fecha</label>  
                <div class="col-md-5">
                    <input id="fechaConstancia" name="fechaConstancia" placeholder="Ingresa la fecha de tu constancia" class="form-control input-md" type="date" value="{{Form::old('fechaConstancia')}}">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>




		 <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label class="col-md-3 control-label" for="constanciaFile">Constancia de validación</label>
                  <div class="col-md-5">
                    <input id="constanciaFile" name="constanciaFile" class="input-file" value="{{Form::old('constanciaFile')}}" type="file" required>
                  </div>
                </div>
              </div>
              <div class="col-md-2"> </div>
            </div>   




@stop