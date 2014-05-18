@extends('layout.registroDocumentos')

@section('titulo')
  Registrar documento de Evaluación de Programas de Servicio Social
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
 Registrar documento de Evaluación de Programas de Servicio Social
@stop

@section('formulario')

        
    <br />
            <br />
          <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                      <label class="col-md-3 control-label" for="numeroRegistro">No. de registro de autorización</label>  
                <div class="col-md-5">
                        <input id="numeroRegistro" name="numeroRegistro" placeholder="Número de autorización" class="form-control input-md" type="text" value="{{Form::old('numeroRegistro')}}">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>



          <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                      <label class="col-md-3 control-label" for="nombrePrograma">Nombre del programa de servicio social</label>  
                <div class="col-md-5">
                        <input id="nombrePrograma" name="nombrePrograma" placeholder="Nombre del programa" class="form-control input-md" type="text" value="{{Form::old('nombrePrograma')}}">                    
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


            <br /><br />

               <div class="row">
                <div class="col-md-3"> </div>
                <div class="col-md-8">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="fechaInicio">Inicio</label>  
                  <div class="col-md-5">
                      <input id="fechaInicio" name="fechaInicio" placeholder="Ingresa la fecha de tuconstancia" class="form-control input-md" type="date" value="{{Form::old('fechaInicio')}}">                    
                  </div>
                </div>
                </div>
                <div class="col-md-2"> </div>
              </div>


              
             <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaTermino">Termino</label>  
                <div class="col-md-5">
                    <input id="fechaTermino" name="fechaTermino" placeholder="Ingresa la fecha de tuconstancia" class="form-control input-md" type="date" value="{{Form::old('fechaTermino')}}">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>




            


            <br /><br />
            




            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia de Participación</h3>
                </div>
              </div>
              <br />
            <br />

            
              
             <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="noConstancia">No.</label>  
                <div class="col-md-5">
                    <input id="noConstancia" name="noConstancia" placeholder="número" class="form-control input-md" type="text" value="{{Form::old('noConstancia')}}">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>




            
              
             <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaConstancia">Fecha</label>  
                <div class="col-md-5">
                    <input id="fechaConstancia" name="fechaConstancia" placeholder="Ingresa la fecha de tu constancia" class="form-control input-md" type="date" value="{{Form::old('fechaConstancia')}}">                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>



        
          

         
     


            <br /><br />

            <br /><br />

   <div class="row">
    <div class="col-md-4"></div>
      <div class="col-md-8">
        <div class="form-group">
      
                  <label class="col-md-8 control-label" for="constanciaFile">Documento constancia de participación del profesor</label>
                  <div class="col-md-8">
                    <input id="constanciaFile" name="constanciaFile"  type="file" value="{{Form::old('constanciaFile')}}">
                  </div>
                </div>
            <br><br>
                <label class="col-md-8 control-label" for="constancia2">Documento calificación de los reportes finales del informe</label>
                  <div class="col-md-8">
                    <input id="constancia2" name="constancia2"  type="file" value="{{Form::old('constancia2')}}">
                  </div>
                </div>
      </div>
 


                 
 <br /><br />
  <br />

@stop

        