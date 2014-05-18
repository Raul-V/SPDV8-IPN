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
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Nombre</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="nombre" value="{{Form::old('nombre')}}" placeholder="Ingresa el nombre del curso o taller" class="form-control input-md" type="text" required>
                  </div>
                </div>    


              </div>
              <div class="col-md-2"><!--Columna para mostrar mensajes en caso de que sea necesario --> </div>
            </div>



            <br /><br />






            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Horas de duración</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="noHoras" value="{{Form::old('noHoras')}}" placeholder="Ingresa las horas de duración" class="form-control input-md" type="text" required>
                  </div>
                </div>    


              </div>
              <div class="col-md-2"><!--Columna para mostrar mensajes en caso de que sea necesario --> </div>
            </div>



            <br /><br />







            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="avance">Evaluación</label>
                  <div class="col-md-9">
                    <select id="avance" name="tipoEvaluacion" class="form-control">
                      <option value="Con exámen">Con examen</option>
                      <option value="Sin exámen">Sin examen</option>                      
                    </select>
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>


            <br />
            <br />














            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha de inicio</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaInicio" value="{{Form::old('fechaInicio')}}" placeholder="Ingresa la fecha de inicio" class="form-control input-md" type="date" required>
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
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha de termino</label>  
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
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia de validación</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Numero</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="noConstancia" value="{{Form::old('noConstancia')}}" placeholder="Ingresa el numero de documento" class="form-control input-md" type="text" required>                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaConstancia" value="{{Form::old('fechaConstancia')}}" placeholder="Ingresa la fecha de fin" class="form-control input-md" type="date">                    
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


              </div>
              <div class="col-md-2"> </div>
            </div>            



	
@stop
 