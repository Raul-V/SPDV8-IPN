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
		  <a href="{{ action('ProfesorController@getPerfil') }}">{{HTML::image('imagenes/modificarPerfil.png','Modificar Perfil',$size)}}</a>
		  <div class="caption">
			<h5>Modificar perfil</h5>                
		  </div>
		</div>
	  </div>

	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <a href="{{action('ProfesorController@getDocumentos')}}">{{HTML::image('imagenes/misDocumentos.png','Mis Documentos',$size)}}</a>
		  <div class="caption">
			<h5>Mis documentos</h5>                
		  </div>
		</div>
	  </div>


	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <a href="{{action('Profesor_RegistrarController@getIndex')}}">{{HTML::image('imagenes/registrarDocumento.png','Registrar Documento',$size)}}</a>
		  <div class="caption">
			<h5>Registrar Documento</h5>                
		  </div>
		</div>
	  </div>


	  
	  <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
		  <a href="{{ action('ProfesorController@getRegistrarPlaza') }}">{{HTML::image('imagenes/registrarPlaza.png','Registrar Plaza',$size)}}</a>
		  <div class="caption">
			<h5>Registrar Plaza</h5>                
		  </div>
		</div>
	  </div>


	</div>
@stop
