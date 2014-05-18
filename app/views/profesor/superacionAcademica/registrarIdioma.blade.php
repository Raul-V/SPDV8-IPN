@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Idioma.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Idioma
@stop

@section('formulario')
  <br /><br />
            


              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Datos Generales</h3>
                </div>
              </div>
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Nombre del idioma</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="nombre" value="{{Form::old('nombre')}}" placeholder="Ingresa el nombre del idioma" class="form-control input-md" type="text" required>                    
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
                  <label class="col-md-4 control-label" for="numero">Habla</label>  
                  <div class="col-md-8">
                    <label>Si </label>&nbsp;&nbsp; {{Form::radio('habla', 'Si')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>No </label>&nbsp;&nbsp;  {{Form::radio('habla', 'No', true)}}
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
                  <label class="col-md-4 control-label" for="numero">Escribe</label>  
                  <div class="col-md-8">
                    <label>Si </label>&nbsp;&nbsp; {{Form::radio('escribe', 'Si')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>No </label>&nbsp;&nbsp;  {{Form::radio('escribe', 'No', true)}}
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
                  <label class="col-md-4 control-label" for="numero">Lee</label>  
                  <div class="col-md-8">
					<label>Si </label>&nbsp;&nbsp; {{Form::radio('lee', 'Si')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>No </label>&nbsp;&nbsp;  {{Form::radio('lee', 'No', true)}}
                    <!--<input id="textinput" name="textinput" placeholder="Ingresa el porcentaje de habilidad" class="form-control input-md" type="text" required>-->
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>



            


            <br />
            <br />
            


            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia de validación</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Número</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="noConstancia" value="{{Form::old('noConstancia')}}" placeholder="Ingresa el numero de la constancia" class="form-control input-md" type="text">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>  
                  <div class="col-md-9">
                    <input id="textinput" value="{{Form::old('fechaConstancia')}}" name="fechaConstancia" placeholder="Ingresa la fecha de fin" class="form-control input-md" type="date">                    
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
                    <input id="constancia" name="constanciaFile" class="input-file" type="file">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>            

	
@stop
 