@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Propuesta de estudios.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Propuesta de Estudios
@stop

@section('formulario')
	
	<br /><br />
			
			
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="avance">Interes del producto</label>
                  <div class="col-md-9">
                    <select id="avance" name="avance" class="form-control">
                      <option value="1">Interés institucional</option>
                      <option value="2">Interés social</option>
                      <option value="3">Interés del sector productivo</option>                                            
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
                    <select id="avance" name="avance" class="form-control">
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
                  <h3>Porcentaje de avance</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Avance Parcial</label>  
                  <div class="col-md-9">
                    <select id="avance" name="avance" class="form-control">
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
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Avance Total</label>  
                  <div class="col-md-9">
                    <select id="avance" name="avance" class="form-control">
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
                    <input id="textinput" name="claveRegistro" placeholder="Ingresa el numero de documento" class="form-control input-md" type="text">                    
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

                  <label class="col-md-4 control-label" for="registrar"></label>
                  <div class="col-md-8">
                    <button id="registrar" name="registrar" class="btn btn-primary">Registrar</button>
                    <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
                  </div>

                </div>  


              </div>
              <div class="col-md-2"> </div>
            </div>
	
	
	
	
@stop
 