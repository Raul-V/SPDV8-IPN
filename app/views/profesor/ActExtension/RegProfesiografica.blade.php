@extends('layout.registroDocumentos')

@section('titulo')
  Registrar Expo-Profesiográfica
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Registrar Expo-Profesiográfica
@stop

@section('formulario')


 <br /><br />
			<div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Nombre del Evento</label>
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
                <label class="col-md-3 control-label">Tipo de Actividad</label>
                <div class="col-md-5">
                  <select class="form-control input-md" id="tipo" value="{{Form::old('tipo')}}"  required name="tipo">                    
                        <option value=1>Atención a jóvenes en exhibiciones didácticas y/o prácticas de orientación vocacional=2</option>
                        <option value=2>atencion de Talleres o concursos=3</option>
                        <option value=3>Profesor coordinador=3</option>
                      
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
			
 <br /><br />

			 <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="constanciaFile">Constancia de validación</label>
                  <div class="col-md-9">
                    <input id="constanciaFile" name="constanciaFile" class="input-file" type="file">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>







@stop