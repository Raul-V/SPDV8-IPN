@extends('layout.plantillaGenerica')

@section('titulo')
	Mis Documentos
@stop
@section('contenido')
	<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Docencia
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">
            
			
			
			
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre del documento</th>
							<th>Id del documento</th>
							<th>Fecha de Registro</th>
							<th>Puntos U.P</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					
					<tbody>
						@if($docs)
							<?php $i=0; ?>
							<?php $suma=0; ?>
							@foreach($docs as $d)
								@if($d->idCategoria==4)
									<tr>
										<td>{{$i+1}}</td>
										<td>{{$d->nombre}}</td>
										<td>{{$d->id}}</td>
										<td>{{substr($d->created_at,0,10)}} </td>
										<td>{{$d->puntos}} U.P</td>
										<td>
											<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info btn-sm">Ver</button></a>
										</td>
										<td>										
											<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info btn-sm">Modificar</button></a>
										</td>
										<td>										
											<a id="eliminar" href="{{action('Profesor_EliminarController@getEliminar').'/'.$d->id}}"><button type="button" class="btn btn-danger btn-sm">Eliminar</button></a>
										</td>
									</tr>
									<?php $i=$i+1; ?>
									<?php $suma=$suma+$d->puntos; ?>
								@endif
							@endforeach
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>Total {{$suma}} U.P</td>
							</tr>
						@endif
					</tbody>
					
					
					
					
				</table>
			</div>				   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Investigación
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
                     
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Superación académica
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
         
		 
		 
		 
		 
		 <div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre del documento</th>
							<th>Identificador del documento</th>
							<th>Fecha de Registro</th>
							<th>Puntos U.P</th>
						</tr>
					</thead>
					
					<tbody>
						@if($docs)
							<?php $i=0; ?>
							<?php $suma=0; ?>
							@foreach($docs as $d)
								@if($d->idCategoria==3)
									<tr>
										<td>{{$i+1}}</td>
										<td>{{$d->nombre}}</td>
										<td>{{$d->id}}</td>
										<td>{{substr($d->created_at,0,10)}} </td>
										<td>{{$d->puntos}} U.P</td>
										<td>
											<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info btn-sm">Ver</button></a>
										</td>
										<td>										
											<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info btn-sm">Modificar</button></a>
										</td>
										<td>										
											<a id="eliminar" href="{{action('Profesor_EliminarController@getEliminar').'/'.$d->id}}"><button type="button" class="btn btn-danger btn-sm">Eliminar</button></a>
										</td>
									</tr>
									<?php $suma=$suma+$d->puntos; ?>
									<?php $i=$i+1; ?>
								@endif
							@endforeach
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>Total {{$suma}} U.P</td>
							</tr>
						@endif
					</tbody>
					
					
					
					
				</table>
			</div>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
      </div>
    </div>
  </div>

    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
          Actividades complementarias y de apoyo a la docencia y a la investigación.
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
        
                      
					  
					<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre del documento</th>
							<th>Identificador del documento</th>
							<th>Fecha de Registro</th>
							<th>Puntos U.P</th>
						</tr>
					</thead>
					
					<tbody>
						@if($docs)
							<?php $i=0; ?>
							<?php $suma=0; ?>
							@foreach($docs as $d)
								@if($d->idCategoria==5)
									<tr>
										<td>{{$i+1}}</td>
										<td>{{$d->nombre}}</td>
										<td>{{$d->id}}</td>
										<td>{{substr($d->created_at,0,10)}} </td>
										<td>{{$d->puntos}} U.P</td>
										<td>
											<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info btn-sm">Ver</button></a>
										</td>
										<td>										
											<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info btn-sm">Modificar</button></a>
										</td>
										<td>										
											<a id="eliminar" href="{{action('Profesor_EliminarController@getEliminar').'/'.$d->id}}"><button  type="button" class="btn btn-danger btn-sm">Eliminar</button></a>
										</td>
									</tr>
									<?php $suma=$suma+$d->puntos; ?>
									<?php $i=$i+1; ?>
								@endif
							@endforeach
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>Total {{$suma}} U.P</td>
							</tr>
						@endif
					</tbody>
					
					
					
					
				</table>
			</div>  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
      </div>
    </div>
  </div>

<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
         Actividades de extensión, integración y difusión de la ciencia y de la cultura.
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse in">
      <div class="panel-body">
                      
					  
					  
					  
		<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre del documento</th>
							<th>Id del documento</th>
							<th>Fecha de Registro</th>
							<th>Puntos U.P</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					
					<tbody>
						@if($docs)
							<?php $i=0; ?>
							<?php $suma=0; ?>
							@foreach($docs as $d)
								@if($d->idCategoria==6)
									<tr>
										<td>{{$i+1}}</td>
										<td>{{$d->nombre}}</td>
										<td>{{$d->id}}</td>
										<td>{{substr($d->created_at,0,10)}} </td>
										<td>{{$d->puntos}} U.P</td>
										<td>
											<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info btn-sm">Ver</button></a>
										</td>
										<td>										
											<a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info btn-sm">Modificar</button></a>
										</td>
										<td>										
											<a id="eliminar" href="{{action('Profesor_EliminarController@getEliminar').'/'.$d->id}}"><button type="button" class="btn btn-danger btn-sm">Eliminar</button></a>
										</td>
									</tr>
									<?php $i=$i+1; ?>
									<?php $suma=$suma+$d->puntos; ?>
								@endif
							@endforeach
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>Total {{$suma}} U.P</td>
							</tr>
						@endif
					</tbody>
					
					
					
					
				</table>
			</div>			  
					  
					  
					  
					  
					  
					  
					  
					  
					
      </div>
    </div>
  </div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://templateplanet.info/tooltip.js"></script>
<script src="http://templateplanet.info/modal.js"></script>
<div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
        <h4>Bootstrap Snipp for Datatable</h4>
        <div class="table-responsive">
        
                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th><input type="checkbox" id="checkall" /></th>
                   <th>First Name</th>
                    <th>Last Name</th>
                     <th>Address</th>
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>
    <tbody>
    
    <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
        <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    
        <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    
    
        <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    
    
        <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    
   
    
   
    
    </tbody>
        
</table>

<div class="clearfix"></div>
<ul class="pagination pull-right">
  <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
  <li class="active"><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
</ul>
                
            </div>
            
        </div>
	</div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title custom_align" id="Heading">Modificar elemento</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="Mohsin">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="Irshad">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title custom_align" id="Heading">Borrar elemento</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> ¿Estas seguro que deseas borrar este elemento?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>




	
@stop