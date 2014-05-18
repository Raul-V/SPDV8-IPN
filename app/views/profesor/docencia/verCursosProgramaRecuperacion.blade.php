@extends('layout.verDocumentos')
@section('titulo')
Cursos del programa de recuperación académica estudiantil
@stop

@section('tituloPanel')
Cursos del programa de recuperación académica estudiantil.
@stop
@section('contenido')

	@include('include.cursosProgramaRecuperacion')
			
@stop

@section('imagenes')
<div class="row">
		<div class="col-md-12">
            <div class="mag">
                Oficio de autorización<br>
                {{HTML::image('spdImg/'.$resultado['imgOficio'],'',array('data-toggle'=>'magnify'))}}
            </div>
        </div><!--/span-->		
	</div>
@stop