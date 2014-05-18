@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Estancias.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Estancias 
@stop

@section('formulario')
 <br /><br />
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Autorizada por</label>  
                  <div class="col-md-9">
                    <select id="avance" name="tipoAutorizacion" class="form-control">
                      <option value="Comité Técnico de Prestaciones a Becarios  (COTEPABE)">Comité Técnico de Prestaciones a Becarios  (COTEPABE)</option>
                      <option value="Año Sabático">Año sabático</option>                      
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
                  <label class="col-md-3 control-label" for="claveRegistro">Nivel</label>  
                  <div class="col-md-9">
                    <select id="avance" name="tipoNivel" class="form-control">
                      <option value="1">Nivel Medio Superior</option>
                      <option value="2">Nivel Superior</option>                      
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
                  <h3>Periodo</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Inicio</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="claveRegistro" placeholder="Ingresa la fecha de inicio" class="form-control input-md" type="date">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Termino</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="claveRegistro" placeholder="Ingresa la fecha de termino" class="form-control input-md" type="date">                    
                  </div>
                </div> 

              </div>

              <div class="col-md-2"> </div>
              
            </div>



            <br /><br />

            


            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Numero</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="noConstancia" placeholder="Ingresa el numero de documento" class="form-control input-md" type="text">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>  
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
                    <input id="constancia" name="constanciaFile" class="input-file" type="file">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>            
	
@stop
 