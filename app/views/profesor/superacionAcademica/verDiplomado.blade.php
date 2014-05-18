@extends('layout.verDocumentos')
@section('titulo')
Diplomado
@stop

@section('tituloPanel')
Diplomado
@stop
@section('contenido')
	<br /><br />
            


            <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Datos Generales</h3>
                </div>
            </div>
            
			<div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Nombre del diplomado</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="nombre" value="{{$resultado['nombreDiplomado']}}" placeholder="Ingresa el nombre del diplomado" class="form-control input-md" type="text" disabled>                    
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
                  <label class="col-md-3 control-label" for="numero">Nombre de la Institución</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="nombreInstitucion" value="{{$resultado['nombreInstitucion']}}" placeholder="Ingresa el nombre del diplomado" class="form-control input-md" type="text" disabled>                    
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
                  <label class="col-md-3 control-label" for="numero">Numero de horas</label>  
                  <div class="col-md-9">
                    <input id="textinput" value="{{$resultado['noHoras']}}" name="noHoras" placeholder="Ingresa el número de horas" class="form-control input-md" type="text" disabled>                    
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
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha de inicio</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaInicio" value="{{$resultado['periodoInicio']}}" placeholder="Ingresa la fecha de inicio del diplomado" class="form-control input-md" type="date" disabled>
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
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha de termino</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaTermino" value="{{$resultado['periodoTermino']}}" placeholder="Ingresa la fecha de termino del diplomado" class="form-control input-md" type="date" disabled>
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
                    <input id="textinput" value="{{$resultado['nivel']}}" name="nivel" placeholder="Ingresa el numero de la constancia" class="form-control input-md" type="text" disabled>
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>


            <br />
            <br />
            


            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia de validación</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Numero</label>  
                  <div class="col-md-9">
                    <input id="textinput" value="{{$resultado['noConstancia']}}" name="noConstancia" placeholder="Ingresa el numero de la constancia" class="form-control input-md" type="text" disabled>                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaConstancia" value="{{$resultado['fechaConstancia']}}"  placeholder="Ingresa la fecha de la constancia" class="form-control input-md" type="date" disabled>                    
                  </div>
                </div> 

              </div>

              <div class="col-md-2"> </div>
              
            </div>            



            <br /><br />
@stop
@section('imagenes')
<div class="row">
		<div class="col-md-6">
            <div class="mag">
                Constancia<br>
                {{HTML::image('spdImg/'.$resultado['imgConstancia'],'',array('data-toggle'=>'magnify'))}}
            </div>
        </div><!--/span-->
		<div class="col-md-6">
            <div class="mag">
                Diploma<br>
                {{HTML::image('spdImg/'.$resultado['imgDiploma'],'',array('data-toggle'=>'magnify'))}}
            </div>
        </div><!--/span-->	
	</div>
@stop
