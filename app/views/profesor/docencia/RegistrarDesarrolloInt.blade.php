@extends('layout.registroDocumentos')

@section('titulo')
Registrar Desarrollo Integral
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm') 
Registrar Desarrollo Integral
@stop

@section('formulario')


            

          <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="semestre">Semestre</label>
                <div class="col-md-5">
                  <select class="form-control" name="semestre" value="{{Form::old('semestre')}}" id="semestre" required>
                        <option value=1>1</option>
                        <option value=2>2</option>                     
                 </select>                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>
    

                <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="año">Año</label>
                <div class="col-md-5">
                    <input id="año" name="año" value="{{Form::old('año')}}" class="form-control input-md" type="number" placeholder="ej:20XX" required>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>


            
                <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="grupo">Grupo</label>
                <div class="col-md-5">
                    <input id="grupo" name="grupo" value="{{Form::old('grupo')}}" class="form-control input-md" type="text" placeholder="ej: 2CV4" required>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>




           


              
              
            </div>




            <br /><br />

          

            <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="NohorasSem">No horas sem-semestre</label>
                <div class="col-md-5">
                    <input id="NohorasSem" name="NohorasSem" value="{{Form::old('NohorasSem')}}" class="form-control input-md" type="number" placeholder="ej:50" required>
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>



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





            <br /><br />



            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia</h3>
                </div>
              </div>


            <br /><br />



              <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="noConstancia">Número de Constancia</label>  
                <div class="col-md-5">
                    <input id="noConstancia" name="noConstancia" value="{{Form::old('noConstancia')}}" placeholder="número" class="form-control input-md" type="text"  required>                    
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
                    <input id="fechaConstancia" name="fechaConstancia" value="{{Form::old('fechaConstancia')}}" class="form-control input-md" type="date" required>                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

    <div class="row">
              <div class="col-md-3"> </div>
              <div class="col-md-8">
              <div class="form-group">
                  <label class="col-md-3 control-label" for="registroconstancia">Registro</label>  
                <div class="col-md-5">
                    <input id="registroconstancia" name="registroconstancia" value="{{Form::old('registroconstancia')}}"class="form-control input-md" type="text" placeholder="registro de tu constancia" required>                    
                </div>
              </div>
              </div>
              <div class="col-md-2"> </div>
            </div>

              
         



            <br /><br />

            <br /><br />

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div class="form-group">
                  <label class="col-md-3 control-label" for="constanciaFile">Documento</label>
                  <div class="col-md-4">
                    <input id="constanciaFile" name="constanciaFile" value="{{Form::old('constanciaFile')}}" type="file" required>
                  </div>
                </div>
      </div>
  <div class="col-md-4"></div>
</div>

         
 <br /><br />
  <br />

          


@stop