@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Articulos.
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Articulos.
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
                  <label class="col-md-3 control-label" for="numero">Nombre del artículo</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="textinput" placeholder="Ingresa el nombre del artículo" class="form-control input-md" type="text">                    
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
                  <label class="col-md-3 control-label" for="claveRegistro">Año de publicación</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="claveRegistro" placeholder="Ingresa tu clave de registro" class="form-control input-md" type="date">                    
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
                  <label class="col-md-3 control-label" for="avance">Tipo de publicación</label>
                  <div class="col-md-9">
                    <select id="avance" name="TipoPublicacion" class="form-control">
                      <option value="1">Circulación Institucional</option>
                      <option value="2">Circulación Nacional</option>
                      <option value="3">Circulación Nacional con jurado</option>
                      <option value="4">Circulación Internacional</option>                      
                    </select>
                  </div>
                </div>  


              </div>
              <div class="col-md-2"> </div>
            </div>
@stop
 