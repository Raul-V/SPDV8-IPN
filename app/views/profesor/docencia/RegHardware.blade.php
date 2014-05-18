@extends('layout.registroDocumentos')

@section('titulo')
  Registrar elaboración de hardware
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Registrar elaboración de hardware
@stop

@section('formulario')
            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Titulo</label>
                <div class="col-md-5">
                  <input class="form-control input-md" value="{{Form::old('titulo')}}" type="text" id="titulo" required name="titulo"/>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">No. de autores</label>
                <div class="col-md-5">
                  <input class="form-control input-md" value="{{Form::old('noAutores')}}" type="text" id="noAutores" required name="noAutores"/>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8"> 
                <div class="form-group">
                  <label class="col-md-3 control-label">Fecha de elaboración</label>
                  <div class="col-md-5"><input class="form-control input-md" type="date" value="{{Form::old('fecha')}}"  required id="fecha" name="fecha"/></div> 
                </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Área de aplicacion</label>
                <div class="col-md-5">
                  <input class="form-control input-md" type="text" id="areaAplicacion" required name="areaAplicacion" value="{{Form::old('areaAplicacion')}}"/>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Semestre</label>
                <div class="col-md-5">
                  <select class="form-control input-md" id="semestre" value="{{Form::old('semestre')}}"  required name="semestre">                    
                        <option value=1>1</option>
                        <option value=2>2</option>
                      
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
                  <label class="col-md-3 control-label">Utilidad</label>
                  <div class="col-md-5">
                    <select class="form-control input-md" id="utilidad" value="{{Form::old('utilidad')}}" name="utilidad" required>                    
                      <option >Profesores</option>
                      <option >Alumnos</option>
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
                  <label class="col-md-3 control-label">Calidad</label>
                  <div class="col-md-5">
                    <select class="form-control input-md" id="calidad" value="{{Form::old('calidad')}}" required name="calidad">                    
                      <option value=1>Regular = 35</option>
                      <option value=2>Buena = 55</option>
                      <option value=3>Excelente = 75</option>
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
                  <label class="col-md-3 control-label" for="constanciaFile">Constancia de validación</label>
                  <div class="col-md-5">
                    <input id="constanciaFile" name="constanciaFile" class="input-file" value="{{Form::old('constanciaFile')}}" type="file" required>
                  </div>
                </div>
              </div>
              <div class="col-md-2"> </div>
            </div>      


           

  
@stop