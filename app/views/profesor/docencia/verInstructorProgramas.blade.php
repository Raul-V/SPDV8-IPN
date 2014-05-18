@extends('layout.verDocumentos')
@section('titulo')
Instructor de programas de formación docente.
@stop

@section('tituloPanel')
Instructor de programas de formación docente.
@stop
@section('contenido')
	@include('include.instructorProgramas')
@stop
@section('imagenes')
<div class="row">
		<div class="col-md-12">
            <div class="mag">
                Constancia de autorización<br>
                {{HTML::image('spdImg/'.$resultado['imgConstancia'],'',array('data-toggle'=>'magnify'))}}
            </div>
        </div><!--/span-->		
	</div>
@stop
