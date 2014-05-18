@extends('layout.verProfesoresCompulsa')

@section('titulo')
	Ver Profesores.
@stop
@section('estilo')
.glyphicon-lg
{
    font-size:4em
}
.info-block
{
    border-right:5px solid #E6E6E6;margin-bottom:25px
}
.info-block .square-box
{
    width:100px;min-height:110px;margin-right:22px;text-align:center!important;background-color:#676767;padding:20px 0
}
.info-block.block-info
{
    border-color:#20819e
}
.info-block.block-info .square-box
{
    background-color:#20819e;color:#FFF
}
@stop


@section('script')
	    $(function() {    
        $('#input-search').on('keyup', function() {
          var rex = new RegExp($(this).val(), 'i');
            $('.searchable-container .items').hide();
            $('.searchable-container .items').filter(function() {
                return rex.test($(this).text());
            }).show();
        });
    });
@stop


@section('nombreUsuario')
	{{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloPanel')
	{{$institucion->nombre}}
@stop

@section('contenido')
	<div class="row">
		<h2>Profesores</h2>
        <div class="col-lg-12">
            <input type="search" class="form-control" id="input-search" placeholder="Buscar Profesor" >
        </div>
		<br />
        <div class="searchable-container">
			<?php $i=1; ?>
            @foreach($profesores as $profesor)
				@if(!($i%2)==0)
				
					<div class="items col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">
					   <div class="info-block block-info clearfix">
							<div class="square-box pull-left">
								<span class="glyphicon glyphicon-user glyphicon-lg"></span>
							</div>
							<h5>{{$institucion->nombre}}</h5>
							<h4>Nombre: {{link_to_action('Compulsa_ProfesorController@getProfesor',$profesor['nombre'].' '.$profesor['apellidoP'].' '.$profesor['apellidoM'],array('id'=>$profesor['id']),array())}}</h4>
							<p>No Empleado: {{$profesor['id']}}</p>
							<span>Email: {{$profesor['email']}}</span>
						</div>
					</div>
				@else
					<div class="items col-xs-12 col-sm-12 col-md-6 col-lg-6 clearfix">
					   <div class="info-block block-info clearfix">
							<div class="square-box pull-left">
								<span class="glyphicon glyphicon-user glyphicon-lg"></span>
							</div>
							<h5>{{$institucion->nombre}}</h5>
							<h4>Nombre: {{link_to_action('Compulsa_ProfesorController@getProfesor',$profesor['nombre'].' '.$profesor['apellidoP'].' '.$profesor['apellidoM'],array('id'=>$profesor['id']),array())}}</h4>
							<p>No Empleado: {{$profesor['id']}}</p>							
							<span>Email: {{$profesor['email']}}</span>
						</div>
					</div>
				@endif
				<?php $i++; ?>
			@endforeach
			
			<!--
            <div class="items col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="info-block block-info clearfix">
                    <div class="square-box pull-left">
                        <span class="glyphicon glyphicon-user glyphicon-lg"></span>
                    </div>
                    <h5>Company Name</h5>
                    <h4>Name: Glenn Pho shizzle</h4>
                    <p>Title: Manager</p>
                    <span>Phone: 555-555-5555</span>
                    <span>Email: sample@company.com</span>
                </div>
            </div>
            <div class="items col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="info-block block-info clearfix">
                    <div class="square-box pull-left">
                        <span class="glyphicon glyphicon-user glyphicon-lg"></span>
                    </div>
                    <h5>Company Name</h5>
                    <h4>Name: Brian Hoyies</h4>
                    <p>Title: Manager</p>
                    <span>Phone: 555-555-5555</span>
                    <span>Email: sample@company.com</span>
                </div>
            </div>
			-->
        </div>
	</div>
@stop