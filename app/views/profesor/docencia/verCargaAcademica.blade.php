@extends('layout.verDocumentos')
@section('titulo')
Carga Academica
@stop

@section('tituloPanel')
Carga Académica
@stop
@section('contenido')
	@include('include.cargaAcademica')
@stop
@section('imagenes')
<div class="row">
		<div class="col-md-12">
            <div class="mag">
                Horario o Constancia<br>
                {{HTML::image('spdImg/'.$resultado['imgConstancia'],'',array('data-toggle'=>'magnify'))}}
            </div>
        </div><!--/span-->		
	</div>
@stop
