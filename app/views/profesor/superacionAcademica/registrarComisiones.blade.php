@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Comisiones.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Comisiones
@stop

@section('formulario')
<br /><br />
            



            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Nombre de la comisión</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="textinput" placeholder="Ingresa el nombre de la comisión" class="form-control input-md" type="text">                    
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
                  <label class="col-md-3 control-label" for="avance">Tipo de Participación</label>
                  <div class="col-md-9">
                    <select id="avance" name="tipoParticipacion" class="form-control">
                      <option value="1">Profesor representante de la autoridad responsable de la academia</option>
                      <option value="2">Profesor representante de la autoridad responsable de la academia</option>                  
                    </select>
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
                  <h3>Periodo</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Inicio</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="claveRegistro" placeholder="Ingresa el numero de documento" class="form-control input-md" type="date">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Termino</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="claveRegistro" placeholder="Ingresa la fecha de fin" class="form-control input-md" type="date">                    
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
                    <input id="constancia" name="constancia" class="input-file" type="file">
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
                  <label class="col-md-3 control-label" for="constancia">Oficio de Designación</label>
                  <div class="col-md-9">
                    <input id="constancia" name="constancia" class="input-file" type="file">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>            

	
@stop
 