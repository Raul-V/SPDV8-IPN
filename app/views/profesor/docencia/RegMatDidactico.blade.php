@extends('layout.registroDocumentos')

@section('titulo')
	Registrar Elaboración de material didáctico
@stop

@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
	Registrar Elaboración de material didáctico
@stop

@section('formulario')
	
	<br /><br />
			
			
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


		<div class="form-group">
                  <label class="col-md-3 control-label" for="nombre">Nombre</label>  
                  <div class="col-md-9">
                    <input id="nombre" name="nombre" value="{{Form::old('nombre')}}" placeholder="Ingresa el nombre del evento" class="form-control input-md" type="text" >                    
                  </div>
                </div>    
	
		<br /><br />
		
		
		<div class="form-group">
                  <label class="col-md-3 control-label" for="noAutores">Número de autores</label>  
                  <div class="col-md-9">
                    <input id="numAutores" name="noAutores" value="{{Form::old('noAutores')}}" placeholder="Ingresa el número de autores participantes" class="form-control input-md" type="number" >                    
                  </div>
                </div>    
	
		<br /><br />

    <div class="form-group">
                  <label class="col-md-3 control-label" for="porcentaje">Porcentaje</label>  
                  <div class="col-md-9">
                    <input id="porcentaje" name="porcentaje" value="{{Form::old('porcentaje')}}" placeholder="% que cubre" class="form-control input-md" type="number" >                    
                  </div>
                </div>    
  
    <br /><br />
		
		<div class="form-group">
                  <label class="col-md-3 control-label" for="semestre">Semestre</label>  
                  <div class="col-md-9">
                    <select class="form-control" name="semestre" value="{{Form::old('semestre')}}" required>
                        <option value=1>1</option>
                        <option value=2>2</option>
                       
                    </select>   
                  </div>
                </div>    
	
		<br /><br />
		
		
		
		
		
		<div class="form-group">
                  <label class="col-md-3 control-label" for="fecha">Fecha de elaboración</label>  
                  <div class="col-md-9">
                    <input id="fecha" name="fecha" value="{{Form::old('fecha')}}" placeholder="¿Cuando se hizo?" class="form-control input-md" type="date" >                    
                  </div>
                </div>    
	
		<br /><br />
		 
	           
		<div class="form-group">
                  <label class="col-md-3 control-label" for="tipo">Tipología</label>  
                  <div class="col-md-9">
                    <select class="form-control" name="tipo" value="{{Form::old('tipo')}}" required>
                        <option value=1 >Paquete de transparencias</option>
                        <option value=2 >Antología de asignatura</option>
                        <option value=3 >Problemario o reactivos de evaluación</option>
                        <option value=4 >Modelos Tridimensionales</option>
                        <option value=5 >audiovisuales</option>
                        <option value=6 >Prototipos</option>
                    </select>    
                  </div>
                </div>
		
		<br /><br />


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
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="noConstancia" value="{{Form::old('noConstancia')}}">Número</label>  
                  <div class="col-md-9">
                    <input id="noConstancia" name="noConstancia" placeholder="Ingresa el numero de documento" class="form-control input-md" type="text">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaConstancia">Fecha</label>  
                  <div class="col-md-9">
                    <input id="fecha" name="fechaConstancia" placeholder="fechaConstancia" value="{{Form::old('fechaConstancia')}}"class="form-control input-md" type="date">                    
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
                  <label class="col-md-3 control-label" for="constanciaFile">Constancia de validación</label>
                  <div class="col-md-9">
                    <input id="constanciaFile" name="constanciaFile" class="input-file" type="file">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>




            <br /><br />



          
	
@stop
 