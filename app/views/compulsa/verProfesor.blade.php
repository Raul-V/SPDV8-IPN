@extends('layout.plantillaGenerica')

@section('titulo')
	Solicitud de {{$profesor->nombre.' '.$profesor->apellidoP.' '.$profesor->apellidoM}}
@stop
@section('estilo')
	
	.glyphicon { margin-right:10px; }
	.panel-body { padding:0px; }
	.panel-body table tr td { padding-left: 15px }
	.panel-body .table {margin-bottom: 0px; }
	
	
	.filterable {
    margin-top: 15px;
	}
	.filterable .panel-heading .pull-right {
		margin-top: -20px;
	}
	.filterable .filters input[disabled] {
		background-color: transparent;
		border: none;
		cursor: auto;
		box-shadow: none;
		padding: 0;
		height: auto;
	}
	.filterable .filters input[disabled]::-webkit-input-placeholder {
		color: #333;
	}
	.filterable .filters input[disabled]::-moz-placeholder {
		color: #333;
	}
	.filterable .filters input[disabled]:-ms-input-placeholder {
		color: #333;
	}
	
	
	
@stop

@section('script')
<script>
	$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No se encontraron resultados</td></tr>'));
        }
    });
});
	
	
	
</script>
@stop

@section('angular')
	<SCRIPT>
		function TodoControllerCargaAcademica($scope,$http)
		{
			$http.get('todo/carga-academica').success(function(cargas)
			{
				$scope.cargas=cargas
			}
			);
		}
	</SCRIPT>
@stop
@section('contenido')
	
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                            </span>Secciones</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-file text-success"></span><a href="#docencia" data-toggle="tab">Docencia</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
										<span class="glyphicon glyphicon-list"></span><a href="#InvSup">Superacion Académica/Investigación</a>
											<ul class="list-group">
											  <li class="list-group-item"><div><span class="glyphicon glyphicon-file text-success"></span><a href="#investigacion" data-toggle="tab">Investigación</a></div></li>

											  <li class="list-group-item"><div><span class="glyphicon glyphicon-file text-success"></span><a href="#superacionAcademica" data-toggle="tab">Superación Académica</a></div></li>

											</ul>
										  </li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-file text-success"></span><a href="#actividadesComplementarias" data-toggle="tab">Actividades complementarias</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-file text-success"></span><a href="#actividadesExtension" data-toggle="tab">Actividades de extensión</a>
                                        <span class="badge">42</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
				
                
            </div>
        </div>
		
		
        <div class="col-lg-8 col-lg-8">            
                <div class="tab-content">
					<div class="tab-pane" id="docencia">
						
						
						
						
						
						
						
						
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div class="panel-group" id="accordion">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseTen"><span class="glyphicon glyphicon-folder-close">
												</span>Carga Académica <span class="badge">{{DocumentosBO::getSize($cargas)}}</span></a>
											</h4>
										</div>
										<div id="collapseTen" class="panel-collapse collapse in">
											<div class="panel-body">
												
												
												
												
												
												
												
												
												
												
												<?php $cargasPuntos=0; ?>
												<div class="panel panel-default filterable">
													<div class="panel-heading">
														<h3 class="panel-title">Contenido</h3>
														<div class="pull-right">
															<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}" class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Registrar</a>
															<button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtro</button>
														</div>
													</div>
													<div class="table-responsive">
														<table class="table table-hover">
															<thead>
																<tr class="filters">
																	<th><input type="text" class="form-control" placeholder="#" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Semestre" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Año" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Puntos" disabled></th>
																</tr>
															</thead>
															<tbody>	
																<?php 
																	$contador=1;
																	$suma=0;
																?>
																@if($cargas)
																@foreach($cargas as $carga)
																	<tr>
																		<td>{{$contador}}</td>
																		<td>{{$carga['semestre']}}</td>
																		<td>{{$carga['año']}}</td>
																		<td>{{$carga['puntos']}} U.P</td>
																		<td><p><a href="{{action('Compulsa_CotejarController@getCargaAcademica',array('id'=>$carga['id'],'idProfesor'=>$profesor->id))}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-search"></span>Cotejar</a></p></td>
																		<td><p><a href="{{action('Profesor_ModificarController@getDiplomado')}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>Editar</a></p></td>
																		<?php $suma=$suma+$carga['puntos']; ?>
																	</tr>
																	<?php 
																	$contador=$contador+1;
																?>
																@endforeach
																<?php $cargasPuntos=$suma; ?>
																@endif
																<tr>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td>Total= {{$suma}} U.P</td>
																		<td></td>
																		<td></td>
																		<td></td>																	
																		
																	</tr>
																
																
															</tbody>
														</table>
													</div>
												</div>
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
											</div>
										</div>
									</div>
									
									
									
									
									
									
									
									
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseEleven"><span class="glyphicon glyphicon-folder-close">
												</span>Instructor de programas de formación docente <span class="badge">{{DocumentosBO::getSize($instructor_programas)}}</span>  </a>
											</h4>
										</div>
										<div id="collapseEleven" class="panel-collapse collapse">
											<div class="panel-body">
												
												
												<div class="panel panel-default filterable">
													<div class="panel-heading">
														<h3 class="panel-title">Contenido</h3>
														<div class="pull-right">															
															<a href="{{action('Profesor_RegistrarController@getInstructorProgramas')}}" class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Registrar</a>
															<button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtro</button>
														</div>
													</div>
													<div class="table-responsive">
														<table class="table table-hover">
															<thead>
																<tr class="filters">
																	<th><input type="text" class="form-control" placeholder="#" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Inicio" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Termino" disabled></th>
																	<th><input type="text" class="form-control" placeholder="No. Constancia" disabled></th>
																	<th><input type="text" class="form-control" placeholder="No. Horas" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Puntos" disabled></th>
																</tr>
															</thead>
															<tbody>	
																<?php 
																	$contador=1;
																	$suma=0;
																?>
																@if($instructor_programas)
																@foreach($instructor_programas as $instructor)
																	<tr>
																		<td>{{$contador}}</td>
																		<td>{{$instructor['fechaInicio']}}</td>
																		<td>{{$instructor['fechaTermino']}}</td>
																		<td>{{$instructor['noConstancia']}}</td>
																		<td>{{$instructor['horasDuracion']}}</td>
																		<td>{{$instructor['puntos']}} U.P</td>
																		<td><p><a href="{{action('Profesor_VisualizarController@getInstructorProgramas').'/'.$instructor['id']}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-search"></span>Ver</a></p></td>
																		<td><p><a href="" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>Editar</a></p></td>
																		<td><p><a id="eliminar" href="{{action('Profesor_EliminarController@getEliminar').'/'.$instructor['id']}}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span>Borrar</a></p></td>																	
																		<?php $suma=$suma+$instructor['puntos']; ?>
																	</tr>
																	<?php 
																	$contador=$contador+1;
																?>
																@endforeach
																@endif
																<tr>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td>Total= {{$suma}} U.P</td>
																		<td></td>
																		<td></td>
																		<td></td>																	
																		
																	</tr>
																
																
															</tbody>
														</table>
													</div>
												</div>
												
												
												
												
												
												
												
												
												
												
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-user">
												</span>Account</a>
											</h4>
										</div>
										<div id="collapseThree" class="panel-collapse collapse">
											<div class="panel-body">
												<table class="table">
													<tr>
														<td>
															<a href="http://www.jquery2dotnet.com">Change Password</a>
														</td>
													</tr>
													<tr>
														<td>
															<a href="http://www.jquery2dotnet.com">Notifications</a> <span class="label label-info">5</span>
														</td>
													</tr>
													<tr>
														<td>
															<a href="http://www.jquery2dotnet.com">Import/Export</a>
														</td>
													</tr>
													<tr>
														<td>
															<span class="glyphicon glyphicon-trash text-danger"></span><a href="http://www.jquery2dotnet.com" class="text-danger">
																Delete Account</a>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
												</span>Reports</a>
											</h4>
										</div>
										<div id="collapseFour" class="panel-collapse collapse">
											<div class="panel-body">
												<table class="table">
													<tr>
														<td>
															<span class="glyphicon glyphicon-usd"></span><a href="http://www.jquery2dotnet.com">Sales</a>
														</td>
													</tr>
													<tr>
														<td>
															<span class="glyphicon glyphicon-user"></span><a href="http://www.jquery2dotnet.com">Customers</a>
														</td>
													</tr>
													<tr>
														<td>
															<span class="glyphicon glyphicon-tasks"></span><a href="http://www.jquery2dotnet.com">Products</a>
														</td>
													</tr>
													<tr>
														<td>
															<span class="glyphicon glyphicon-shopping-cart"></span><a href="http://www.jquery2dotnet.com">Shopping Cart</a>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
					</div>
					<div class="tab-pane" id="superacionAcademica">
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
					</div>
					<div class="tab-pane" id="investigacion">
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
					</div>
					<div class="tab-pane" id="actividadesComplementarias">
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

						Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet,
					</div>
					<div class="tab-pane" id="actividadesExtension">

						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

						Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent 
					</div>
				
					<div class="tab-pane" id="reporte">
						
						
						
						
						<div class="row">
							<div class="col-xs-12">
								<div class="invoice-title">
									<h2>Reporte</h2><h3 class="pull-right"></h3>
								</div>
								<hr>
								<div class="row">
									<div class="col-xs-6">
										<address>
										<strong>Generado por:</strong><br>
											{{Auth::user()->nombre.' '.Auth::user()->apellidoP}}<br>											
										</address>
									</div>
									<div class="col-xs-6 text-right">
										
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										
									</div>
									<div class="col-xs-6 text-right">
										<address>
											<strong>Fecha del reporte:</strong><br>
											Mayo 6, 2014<br><br>
										</address>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title"><strong>Resumen</strong></h3>
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-condensed">
												<thead>
													<tr>
														<td><strong>Categoria</strong></td>
														<td class="text-center"><strong>Cantidad</strong></td>
														<td class="text-center"><strong>Puntos</strong></td>
													</tr>
												</thead>
												<tbody>
													<!-- foreach ($order->lineItems as $line) or some such thing here -->
													<tr>
														<td><strong>Dodencia</strong></td>
														<td class="text-center">{{$no_docencia}}</td>
														<td class="text-center">{{$puntos_docencia}}</td>
													</tr>
													<tr>
														<td><strong>Investigación/Superación Académica</strong></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>
													<tr>
														<td>Investigación</td>
														<td class="text-center">0</td>
														<td class="text-center">{{$puntos_investigacion}}</td>
													</tr>
													<tr>
														<td>Superación Académica</td>
														<td class="text-center">0</td>
														<td class="text-center">{{$puntos_superacion}}</td>
													</tr>
													<tr>
														<td><strong>Actividades complementarias</strong></td>
														<td class="text-center">0</td>
														<td class="text-center">{{$puntos_actividades_c}}</td>
													</tr>
													<tr>
														<td><strong>Actividades de extensión</strong></td>
														<td class="text-center">0</td>
														<td class="text-center">{{$puntos_actividades_e}}</td>
													</tr>
													<tr>
														<td class="thick-line"></td>
														<td class="thick-line text-center"><strong>Total</strong></td>
														<td class="thick-line text-center">{{$total}}</td>
													</tr>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						
						
						
						
						
					</div>
				
				</div>
				
				
				
            
        </div>
		
		
		
    </div>



@stop
