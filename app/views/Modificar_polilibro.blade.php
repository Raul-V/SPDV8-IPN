@extends('layout.registroDocumentos')

@section('titulo')
  Modificar Polilibro
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Modificar Polilibro
@stop

@section('formulario')


            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numeroAutores">Número de Autores</label>  
                  <div class="col-md-9">
                    <input id="numeroAutores" name="numeroAutores" placeholder="Ingresa el número de autores" class="form-control input-md" type="text">
                    
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
                  <label class="col-md-3 control-label" for="Nivelaplicacion">Nivel de Aplicación</label>
                  <div class="col-md-9">
                    <input id="Nivelaplicacion" name="Nivelaplicacion" class="form-control input-md" type="text" >
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>




            <br /><br />



            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Edición</h3>
                </div>
              </div>


            <br /><br />
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="año">Año</label>  
                  <div class="col-md-9">
                    <input id="año" name="año" placeholder="20XX" class="form-control input-md" type="text" >                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="Pais">País</label>  
                  <div class="col-md-9">
                    <input id="pais" name="pais" placeholder="Nombre del país" class="form-control input-md" type="text">                    
                  </div>
                </div> 

              </div>

              <div class="col-md-2"> </div>
              
            </div>

            


            <br /><br />
            




            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia de Validación</h3>
                </div>
              </div>
              <br />
            <br />

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">No.</label>  
                  <div class="col-md-9">
                    <input id="numero" name="numero" placeholder="Ingresa la fecha de inicio" class="form-control input-md" type="text" >                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fecha">Fecha</label>  
                  <div class="col-md-9">
                    <input id="fecha" name="fecha"  class="form-control input-md" type="date">                    
                  </div>
                </div> 

              </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="calidad">Calidad</label>  
                  <div class="col-md-9">
                   <select multiple class="form-control" name="calidad" id="calidad">
                      <option>Regular 20 UP</option>
                      <option>Buena 50 UP</option>
                      <option>excelente 80 UP</option>
                      
                    </select>                   
                  </div>
                </div> 

              </div>
  
            </div>


            <br /><br />

            <br /><br />

           

<div class="row">
    <div class="col-md-6">
        
        
    <div class="thumbnail">
      <img src="imagenes/dip.jpg" alt="...">
      <div class="caption">
        <h3>nombre imagen 1</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Remplazar</a> <a href="#" class="btn btn-default" role="button">Ampliar</a></p>
      </div>
    </div>
  

    </div>
    
</div>
                 
 <br /><br />
  <br />

            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">                

                  <label class="col-md-4 control-label" for="modificar"></label>
                  <div class="col-md-8">
                    <button id="modificar" name="modificar" class="btn btn-primary">Modificar</button>
                    <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
                  </div>

                </div>  


              </div>
              <div class="col-md-2"> </div>
            </div>







@stop