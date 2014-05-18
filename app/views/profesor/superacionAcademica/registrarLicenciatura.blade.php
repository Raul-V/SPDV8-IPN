@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Licenciatura.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!-- No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Licenciatura
@stop

@section('formulario')
		
		<br><br>
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Datos Generales</h3>
                </div>
              </div>
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Nombre</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="nombre" value="{{Form::old('nombre')}}" placeholder="Ingresa el nombre de la licenciatura" class="form-control input-md" type="text" required>                    
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
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha del examen profesional</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaExamen" value="{{Form::old('fechaExamen')}}" placeholder="Ingresa la fecha del examen profesional" class="form-control input-md" type="date">
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
                    <input id="textinput" name="noConstancia" value="{{Form::old('noConstancia')}}" placeholder="Ingresa el numero de la constancia" class="form-control input-md" type="text">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaConstancia" value="{{Form::old('fechaConstancia')}}" placeholder="Ingresa la fecha de la constancia" class="form-control input-md" type="date">                    
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
 