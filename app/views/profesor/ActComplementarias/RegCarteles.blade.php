@extends('layout.registroDocumentos')

@section('titulo')
  Registrar Carteles y conferencias.
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Registrar Carteles y conferencias
@stop

@section('formulario')
  
  <br /><br />
      
      <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label" for="fecha">Fecha del evento</label>  
                <div class="col-md-5">
                  <input id="fecha" name="fecha" value="{{Form::old('fecha')}}" placeholder="Fecha del evento" class="form-control input-md" type="date">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>
          


      <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label" for="nombre">Trabajo presentado </label>  
                <div class="col-md-5">
                  <input id="nombre" name="nombre" value="{{Form::old('nombre')}}" placeholder="nombre de tu trabajo" class="form-control input-md" type="text">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

         


            

            <br /><br />



      <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
               <label class="col-md-3 control-label" for="tipo" value="{{Form::old('tipo')}}">Tipo de evento</label>
                <div class="col-md-5">
                 <select id="tipo" name="tipo" class="form-control">
                      <option value=1>Conferencia nacional</option>
                      <option value=2>Conferencia internacional</option>
                     <option value=3>Conferencia magistral nacional</option>
                      <option value=4>Conferencia magistral internacional</option>
                       <option value=5>Videoconferencia nacional </option>
                      <option value=6>Videoconferencia internacional </option>
                     <option value=7>Cartel nacional</option>
                      <option value=8>Cartel internacional</option>
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
                  <label class="col-md-3 control-label" for="constanciaFile">Constancia de validación</label>
                  <div class="col-md-9">
                    <input id="constanciaFile" name="constanciaFile" value="{{Form::old('constanciaFile')}}" class="input-file" type="file">
                  </div>
                </div>
                 


              </div>
              <div class="col-md-2"> </div>
            </div>




            <br /><br />



          
  
  
  
@stop
 
