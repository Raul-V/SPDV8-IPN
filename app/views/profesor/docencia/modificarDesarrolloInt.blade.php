@extends('layout.registroDocumentos')

@section('titulo')
Modificar Desarrollo Integral
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
Modificar Desarrollo Integral
@stop

@section('formulario')


            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="col-md-3 control-label" for="semestreESC">Semestre Escolar</label>  
                  <div class="col-md-9">
                    <input id="semestreESC" name="semestreESC" placeholder="Ingresa el semestre" class="form-control input-md" type="text" >
                    
                  </div>
                </div>   </div>
              <div class="col-md-4">
                  <div class="form-group">
                  <label class="col-md-3 control-label" for="grupo">Grupo</label>
                  <div class="col-md-9">
                    <input id="grupo" name="grupo" class="form-control input-md" type="text" >
                  </div>
                </div>

              </div>
              <div class="col-md-4"> 
                <div class="form-group">
                  <label class="col-md-3 control-label" for="nivel">Nivel</label>
                  <div class="col-md-9">
                    <input id="nivel" name="nivel" class="form-control input-md" type="text" >
                  </div>
                </div>


                 </div>
            </div>




            <br /><br />


          


            <div class="row">
              <div class="col-md-2"> </div>

              <div class="col-md-6">


            


              </div>
              <div class="col-md-6">


              <div class="form-group">
                  <label class="col-md-3 control-label" for="NohorasSem">No horas sem-semestre</label>
                  <div class="col-md-9">
                    <input id="NohorasSem" name="NohorasSem" class="form-control input-md" type="text" >
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


            <br /><br />
              <div class="col-md-4">
                  <div class="form-group">
                  <label class="col-md-3 control-label" for="año">No.</label>  
                  <div class="col-md-9">
                    <input id="año" name="año" placeholder="número" class="form-control input-md" type="text" >                    
                  </div>
                </div> 

               </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fecha">Fecha</label>  
                  <div class="col-md-9">
                    <input id="fecha" name="fecha" class="form-control input-md" type="date">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="registro">Registro</label>  
                  <div class="col-md-9">
                    <input id="registro" name="registro" placeholder="Nombre del país" class="form-control input-md" type="text" >                    
                  </div>
                </div> 

              </div>
              
            </div>



            <br /><br />

            <br /><br />

            <div class="row">
  <div class="col-md-4"></div>
 
  <div class="col-md-4"></div>
</div>

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