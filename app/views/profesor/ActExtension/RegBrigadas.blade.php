@extends('layout.registroDocumentos')

@section('titulo')
  Registrar brigadas multidisciplinarias de servicio social
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Registrar brigadas multidisciplinarias de servicio social
@stop

@section('formulario')
      

    <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label">Nombre</label>
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
                <label class="col-md-3 control-label">Número de Registros de autorización</label>
                <div class="col-md-5">
                  <input class="form-control input-md" value="{{Form::old('noRegistro')}}" type="text" id="noRegistro" required name="noRegistro"/>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>
      



       <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Periodo</h3>
                </div>
              </div>


            <br /><br />
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaInicio">Inicio</label>  
                  <div class="col-md-9">
                    <input id="fechaInicio" name="fechaInicio" placeholder="Ingresa la fecha de tuconstancia" class="form-control input-md" type="date" value="{{Form::old('fechaInicio')}}">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaTermino">Termino</label>  
                  <div class="col-md-9">
                    <input id="fechaTermino" name="fechaTermino" placeholder="Ingresa la fecha de tuconstancia" class="form-control input-md" type="date" value="{{Form::old('fechaTermino')}}">                    
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
                <label class="col-md-3 control-label">Tipo de Actividad</label>
                <div class="col-md-5">
                  <select class="form-control input-md" id="tipo" value="{{Form::old('tipo')}}"  required name="tipo">                    
                        <option value=1>Coordinador de brigada de campo min=4 max=8</option>
                        <option value=2>Profesor brigadista min=4 max =4</option>
                        <option value=3>Responsable del programa min =3 max 6=</option>
                      
                    </select>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>


       <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">

<br /><br />
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