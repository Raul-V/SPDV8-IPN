@extends('layout.registroDocumentos')

@section('titulo')
  Registrar Elaboración de software educativo
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Registrar Elaboración de software educativo
@stop

@section('formulario')
  
  <br /><br />
      
      
      
              
              <div class="row">
               <div class="col-md-3"></div>
                 <div class="col-md-8">
                   <label class="control-label" for="categoria">Categoría</label>
                   <div class="form-group">
                      
                      <div class="col-md-5">
                  <input id="categoria" name="categoria" value="{{Form::old('categoria')}}" placeholder="Ingresa la categoría a la que pertenece" class="form-control input-md" type="text">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>
  <br />


            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
                <label class="control-label" for="fecha">Fecha de elaboración</label> 
              <div class="form-group">
               
                <div class="col-md-5">
                  <input id="fecha" name="fecha" value="{{Form::old('fecha')}}" placeholder="" class="form-control input-md" type="date" required>  
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

  <br />
 
              <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
                 <label class="control-label" for="complejo">Complejo e integrado</label>  
              <div class="form-group">
              
                <div class="col-md-5">
                  <input id="complejo" name="complejo" value="{{Form::old('complejo')}}" placeholder=" " class="form-control input-md" type="text" required>                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

              

 
               
            

  <br />
      
        <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
                <label class=" control-label" for="semestre">Semestre</label> 
              <div class="form-group">
                
                <div class="col-md-5">
                  <select class="form-control" name="semestre" value="{{Form::old('semestre')}}" required>
                        <option value=1>1</option>
                        <option value=2>2</option>
                    </select>   
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

   
     <br />      
             <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
                <label class="control-label" for="utilidad">Utilidad</label>   
              <div class="form-group">
                
                <div class="col-md-5">
                  <select class="form-control" value="{{Form::old('utilidad')}}" id="utilidad" name="utilidad" required>
                      <option>Alumnos</option>
                      <option>Profesores</option>
                    </select>  
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>
  <br />
  
             <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
             <label class="control-label" for="claveRegistro">Calidad</label>   
              <div class="form-group">
             
                <div class="col-md-5">
                  <select class="form-control" value="{{Form::old('calidad')}}" id="calidad" name="calidad" required>
                      <option value=1>Regular=15</option>
                      <option value=2>Buena=30</option>
                      <option value=3>Excelente=55</option>
                    </select>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>



                     
<br><br><br>





    <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
                <label class="control-label" for="constanciaFile">Constancia de validación</label>
              <div class="form-group">
                
                <div class="col-md-5">
                  
                  <input id="constanciaFile" name="constanciaFile" value="{{Form::old('constanciaFile')}}" class="input-file" type="file">
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>
  
  <br><br><br>
  
  
  
@stop
 
 