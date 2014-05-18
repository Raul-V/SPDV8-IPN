@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Investigacion.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Investigacion
@stop

@section('formulario')
		<br /><br />
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Número de documento</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="textinput" placeholder="Ingresa el número de documento" class="form-control input-md" type="text">
                    <span class="help-block">Este número lo encuentras en el documento físico</span>  
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
                  <label class="col-md-3 control-label" for="nivel">Nivel de participación</label>
                  <div class="col-md-9">
                    <select id="nivel" name="nivel" class="form-control">
                      <option value="1">Alto</option>
                      <option value="2">Medio-Alto</option>
                      <option value="3">Medio-Bajo</option>
                      <option value="4">Bajo</option>
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
                  <label class="col-md-3 control-label" for="claveRegistro">Clave de registro</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="claveRegistro" placeholder="Ingresa tu clave de registro" class="form-control input-md" type="text">                    
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
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Fecha de constancia</h3>
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
                  <label class="col-md-3 control-label" for="claveRegistro">Fin</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="claveRegistro" placeholder="Ingresa la fecha de fin" class="form-control input-md" type="date">                    
                  </div>
                </div> 

              </div>

              <div class="col-md-2"> </div>
              
            </div>

            


            <br /><br />
            




            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Periodo de avance</h3>
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
                  <label class="col-md-3 control-label" for="claveRegistro">Fin</label>  
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
                  <label class="col-md-3 control-label" for="avance">Porcentaje de avance</label>
                  <div class="col-md-9">
                    <select id="avance" name="Porcentaje" class="form-control">
                      <option value="1">10%</option>
                      <option value="2">20%</option>
                      <option value="3">30%</option>
                      <option value="4">40%</option>
                      <option value="5">50%</option>
                      <option value="6">60%</option>
                      <option value="7">70%</option>
                      <option value="8">80%</option>
                      <option value="9">90%</option>
                      <option value="10">100%</option>
                    </select>
                  </div>
                </div>  


              </div>
              <div class="col-md-2"> </div>
            </div>
	
@stop
 