@extends('layout.registroDocumentos')

@section('titulo')
Registrar Documento de Prácticas Escolares
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
 Registrar Documento de Prácticas Escolares
@stop

@section('formulario')

            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="nivel">Nivel</label>
                <div class="col-md-5">
                  <select class="form-control" name="nivel" value="{{Form::old('nivel')}}" id="nivel" required>
                        <option>Medio Superior</option>
                        <option>Superior</option>
                        <option>Posgrado</option>
                  </select>                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

              
      


            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Periodo</h3>
                </div>
              </div>


            <br /><br />
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaInicio">Inicio</label>  
                  <div class="col-md-9">
                    <input id="fechaInicio" name="fechaInicio" placeholder="Ingresa la fecha de tuconstancia" class="form-control input-md" type="date" value="{{Form::old('fechaInicio')}}">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaTermino">Termino</label>  
                  <div class="col-md-9">
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
                  <h3>Oficio</h3>
                </div>
              </div>


            <br /><br />
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="noConstancia">No.</label>  
                  <div class="col-md-9">
                    <input id="noConstancia" name="noConstancia" placeholder="Número de oficio" class="form-control input-md" type="text" value="{{Form::old('noConstancia')}}">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaConstancia">Fecha</label>  
                  <div class="col-md-9">
                    <input id="fechaConstancia" name="fechaConstancia" placeholder="Ingresa la fecha de tu oficio" class="form-control input-md" type="date" value="{{Form::old('fechaConstancia')}}">                    
                  </div>
                </div>  

              </div>

              <div class="col-md-2"> </div>
              
            </div>

            


            <br /><br />
            

            <br /><br />

                   <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-8 control-label" for="constanciaFile">Documento constancia de participación del profesor en la revisión</label>
                <div class="col-md-5">
                    <input id="constanciaFile" name="constanciaFile"  type="file">
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>


                 <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-8 control-label" for="califFile">Documento calificación de los reportes finales</label>
                <div class="col-md-5">
                    <input id="califFile" name="califFile"  type="file">
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>



      

                         
         <br /><br />
          <br />

            
@stop