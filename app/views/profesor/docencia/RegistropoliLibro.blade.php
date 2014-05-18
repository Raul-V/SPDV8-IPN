@extends('layout.registroDocumentos')

@section('titulo')
  Registrar Polilibro
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Registrar Polilibro
@stop

@section('formulario')
    

    <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label" for="numeroAutores">Número de Autores</label>  
                <div class="col-md-5">
                  <input id="numeroAutores" name="numeroAutores" value="{{Form::old('numeroAutores')}}" placeholder="Ingresa el número de autores" class="form-control input-md" type="number" required>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

       



            <br /><br />

  <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label" for="nivelaplicacion">Nivel de Aplicación</label>
                <div class="col-md-5">
                  
                  <select class="form-control" name="nivelaplicacion" value="{{Form::old('nivelaplicacion')}}" id="nivelaplicacion" required>
                        <option>Medio Superior</option>
                        <option>Superior</option>
                        <option>Posgrado</option>
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
                  <h3>Edición</h3>
                </div>
              </div>


            <br /><br />
              <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                 <label class="col-md-3 control-label" for="año" required>Año</label>  
                <div class="col-md-5">
                  <input id="año" name="año" value="{{Form::old('año')}}" placeholder="20XX" class="form-control input-md" type="text" required>                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

  

           <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                <label class="col-md-3 control-label" for="pais">País</label>  
                <div class="col-md-5">
                  <input id="pais" name="pais" value="{{Form::old('pais')}}"placeholder="Nombre del país" class="form-control input-md" type="text" required>                    
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
                  <label class="col-md-3 control-label" for="noConstancia">No.</label>  
                  <div class="col-md-9">
                    <input id="noConstancia" name="noConstancia" value="{{Form::old('noConstancia')}}" placeholder=" " class="form-control input-md" type="text" required>                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaConstancia">Fecha</label>  
                  <div class="col-md-9">
                    <input id="fechaConstancia" name="fechaConstancia"value="{{Form::old('fechaConstancia')}}" placeholder="Ingresa la fecha de tu constancia" class="form-control input-md" type="date" required>                    
                  </div>
                </div> 

              </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="calidad">Calidad</label>  
                  <div class="col-md-9">
                    
                    <select class="form-control" name="calidad" id="calidad" value="{{Form::old('calidad')}}">
                        <option value=1>Regular = 20UP</option>
                        <option value=2>Buena = 50 UP</option>
                        <option value=3>Excelente = 80 UP</option>
      </select>
                  </div>
                </div> 


              </div>

             
              
            </div>


            <br /><br />

            <br /><br />

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div class="form-group">
      
          <label class="col-md-3 control-label" for="constanciaFile">Documento</label>
                  <div class="col-md-4">
                    <input id="constanciaFile" name="constanciaFile" value="{{Form::old('constanciaFile')}}"  type="file" required>
                  </div>
                </div>
      </div>
  <div class="col-md-4"></div>
</div>

                 
 <br /><br />
  <br />

            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">
 


              </div>
              <div class="col-md-2"> </div>
            </div>
@stop



