@extends('layout.plantillaGenerica')
@section('titulo')
	Compulsa
@stop


@section('contenido')
	@if(1==1)
		{{-- */$width=200;/* --}}
		{{-- */$height=200;/* --}}
		{{-- */$size=array('width'=> $width,'height'=>$height);/* --}}		
	@endif


	<div class="panel panel panel-info">
		<div class="panel-heading">
		<h3 class="panel-title">Inicio Compulsa</h3>
		</div>
		
		<div class="panel-body">
			<div class="col-sm-7">
			    <div class="page-header">
					<h3>Estado</h3>
			    </div>
				<div class="row">

				  <div class="col-sm-6 col-md-6">
					<div class="thumbnail">
					  <a href="{{ action('CompulsaController@getProfesores') }}">{{HTML::image('imagenes/modificarPerfil.png','Modificar Perfil',$size)}}</a>
					  <div class="caption">
						<h5>Ver Profesores</h5>                
					  </div>
					</div>
				  </div>

				  <div class="col-sm-6 col-md-6">
					<div class="thumbnail">
					  <a href="{{action('ProfesorController@getDocumentos')}}">{{HTML::image('imagenes/misDocumentos.png','Mis Documentos',$size)}}</a>
					  <div class="caption">
						<h5>Mis documentos</h5>                
					  </div>
					</div>
				  </div>
				</div>
			    
			    
			    
			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-3">
			    <div class="page-header">
				<h3>Fechas</h3>
			    </div>
			    
				
			    <div class="panel panel-default">
				<div class="panel-heading">
				  <h3 class="panel-title">Registro de archivos</h3>
				</div>
				<div class="panel-body">
				    <div class="page">
				<b>Inicio</b>
				</div>
				5/03/2014
				<hr>
				<div class="page">
				    <b>Fin</b>
				</div>
				30/05/2014
				</ul>
				</div>
			    </div>
			
			
			    <div class="panel panel-default">
				<div class="panel-heading">
				  <h3 class="panel-title">Compulsa</h3>
				</div>
				<div class="panel-body">
				    <div class="page">
				<b>Inicio</b>
				</div>
				30/05/2014
				<hr>
				<div class="page">
				    <b>Fin</b>
				</div>
				20/07/2014
				</ul>
				</div>
			    </div>
			</div>
		    </div>
		    
		    
		   
		   
		   
		   
		</div>
		
		
		
		
		
		
	    </div>
@stop