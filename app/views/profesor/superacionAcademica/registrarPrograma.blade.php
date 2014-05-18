@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Programa.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Programa
@stop

@section('formulario')
	
	         <br /><br />
            
            <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Datos Generales</h3>
                </div>
              </div>

              <br /><br />

            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="avance">Dependencia Coordinadora</label>
                  <div class="col-md-9">
                    <select id="avance" name="dependenciaCoordinadora" class="form-control">
                      <option value="Direccion General">Direccion General</option>
                      <option value="Secretaria Academica">Secretaria Academica</option>
                      <option value="Secretaria de Investigacion y Posgrado">Secretaria de Investigacion y Posgrado</option>  
                      <option value="Secretaria de Extension e Integracion Social">Secretaria de Extension e Integracion Social</option>                                       
                      <option value="Secretaria de Servicios Educativos">Secretaria de Servicios Educativos</option>
                      <option value="Secretaria de Gestion Estrategica">Secretaria de Gestion Estrategica</option>
                      <option value="Secretaria de Administracion">Secretaria de Administracion</option>
                      <option value="Patronato de Obras e Instalaciones del IPN">Patronato de Obras e Instalaciones del IPN</option>
                      <option value="Coordinación General de Servicios Informaticos">Coordinación General de Servicios Informaticos</option>
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
                  <label class="col-md-3 control-label" for="avance">Nivel</label>
                  <div class="col-md-9">
                    <select id="avance" name="nivel" class="form-control">
                      <option value="Nivel Superior">Nivel Superior</option>
                      <option value="Nivel Medio Superior">Nivel Medio Superior</option>                      
                    </select>
                  </div>
                </div> 


              </div>
              <div class="col-md-2"> </div>
            </div>




            <br /><br />




            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Duración del proyecto</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Inicio</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaInicio" value="{{Form::old('fechaInicio')}}" placeholder="Ingresa la fecha de inicio" class="form-control input-md" type="date">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fin</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaTermino" value="{{Form::old('fechaTermino')}}" placeholder="Ingresa la fecha de fin" class="form-control input-md" type="date">                    
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
                  <h3>Constancia</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Número</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="noConstancia" value="{{Form::old('noConstancia')}}" placeholder="Ingresa el número de constancia" class="form-control input-md" type="text">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="constancia">Constancia de validación</label>
                  <div class="col-md-9">
					{{Form::file('constanciaFile')}}
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
                  <h3>Mas información</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="avance">Nivel de Participación</label>
                  <div class="col-md-9">
                    <select id="avance" name="nivelParticipacion" class="form-control">
                      <option value="Coordinador">Coordinador</option>
                      <option value="Analista">Analista</option>                      
                    </select>
                  </div>
                </div>


              </div>
              
              <div class="col-md-4">

                

                <div class="form-group">
                  <label class="col-md-3 control-label" for="avance">Tipo de programa o proyecto</label>
                  <div class="col-md-9">
                    <select id="avance" name="tipoPrograma" class="form-control">
                      <option value="Programa Institucional">Programa Institucional</option>
                      <option value="Proyecto Institucional">Proyecto Institucional</option>
                      <option value="Proyecto de dependencia">Proyecto de dependencia</option>                      
                    </select>
                  </div>
                </div>




              </div>

              <div class="col-md-2"> </div>
              
            </div>

	
	
@stop
 