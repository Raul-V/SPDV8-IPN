@extends('layout.registroDocumentos')

@section('titulo')
	Registrar encuentros académicos interpolitécnicos
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar encuentros académicos interpolitécnicos
@stop

@section('formulario')

			<div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Nombre del campo o asignatura</label>
                <div class="col-md-5">
                  <input class="form-control input-md" value="{{Form::old('nombre')}}" type="text" id="nombre" required name="nombre"/>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>


			<div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Fecha del evento</label>
                <div class="col-md-5">
                  <input class="form-control input-md" value="{{Form::old('fecha')}}" type="date" id="fecha" required name="fecha"/>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>


			<div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Oficio</h3>
                </div>
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