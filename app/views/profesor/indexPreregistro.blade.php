@extends('layout.plantillaGenerica')
@section('contenido')
	
	
	
	
	<!--Declarando tamaños-->
	@if(1==1)
		{{-- */$width=200;/* --}}
		{{-- */$height=200;/* --}}
		{{-- */$size=array('width'=> $width,'height'=>$height);/* --}}		
	@endif
	
	
	
	<div class="row">

	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <a href="{{ action('ProfesorController@getPerfil') }}">{{HTML::image('imagenes/modificarPerfil.png',$alt='Modificar Perfil',$size)}}</a>
		  <div class="caption">
			<h5>Modificar perfil</h3>                
		  </div>
		</div>
	  </div>

	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <a href="{{action('ProfesorController@getDocumentos')}}">{{HTML::image('imagenes/historial.png','Historial',$size)}}</a>
		  <div class="caption">
			<h5>Historial De Documentos</h3>                
		  </div>
		</div>
	  </div>


	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <a href="{{action('ProfesorController@getSolicitud')}}">{{HTML::image('imagenes/solicitud.png','Solicitud',$size)}}</a>
		  <div class="caption">
			<h5>Participar en Proceso de Promoción</h3>                
		  </div>
		</div>
	  </div>


	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <a href="{{ action('ProfesorController@getRegistrarPlaza') }}">{{HTML::image('imagenes/registrarPlaza.png','Registrar Plaza',$size)}}</a>
		  <div class="caption">
			<h5>Registrar Plaza</h3>                
		  </div>
		</div>
	  </div>


	</div>
@stop
