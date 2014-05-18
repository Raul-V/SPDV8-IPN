@extends('layout.registroDocumentos')

@section('titulo')
Registrar Instructores en Olimpiadas Nacionales e Internacionales

@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
Registrar Instructores en Olimpiadas Nacionales e Internacionales

@stop

@section('formulario')


          

            <br /><br />

            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="nombreEvento">Nombre del Evento</label>
                  <div class="col-md-9">
                    <input id="nombreEvento" name="nombreEvento" class="form-control input-md" type="text" value="{{Form::old('nombreEvento')}}">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>




            <br /><br />



       <div class="row">
           
            <br /><br />
              <div class="col-md-4">

              <div class="form-group">
                  <label class="col-md-3 control-label" for="fecha">Fecha</label>  
                  <div class="col-md-9">
                    <input id="fecha" name="fecha" value="{{Form::old('fecha')}}" placeholder="Fecha del Evento" class="form-control input-md" type="date">                    
                  </div>
                </div>  </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="lugar">Lugar</label>  
                  <div class="col-md-9">
                    <input id="lugar" name="lugar" placeholder="Lugar del Evento" class="form-control input-md" type="text" value="{{Form::old('lugar')}}">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="evento">Evento</label> 
                  
                  <select class="form-control input-md" name="evento"  id="evento" required>
                        <option value=1>Nacional</option>
                        <option value=2>Internacional</option>
                        
                  </select>
                  
                </div> 

              </div>

             
              
            </div>

    


            <br /><br />

            <br /><br />

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="form-group">
      
                  <label class="col-md-8 control-label" for="constanciaFile">Documento constancia de la participación como instructor</label>
                  <div class="col-md-8">
                    <input id="constanciaFile" name="constanciaFile"  type="file" value="{{Form::old('constanciaFile')}}" >
                  </div><br> <br>
                 
                      </div>
                  </div>
                  <div class="col-md-4"></div>
                </div>

                 
 <br /><br />
  <br />

           

@stop