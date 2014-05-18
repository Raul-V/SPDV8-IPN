<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrar Documento {{Auth::user()->nombre}}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
	{{HTML::style('css/bootstrap.min.css')}}
	{{ HTML::script('js/jquery.min.js') }}	
	{{HTML::style('css/bootstrap-theme.css')}}
    {{ HTML::script('js/bootstrap.min.js') }}	   
	{{ HTML::script('js/bootstrap.js') }}	
	   
  <style type="text/css">
    button{
      float:right;
      margin-right: 10px;
    }
  </style>

	<!--<link rel="stylesheet" type="text/css" href="css/estilo.css">-->
</head>
<body>
<!--Se incluye el encabezado de la pagina y la imagen de la pagina -->
{{HTML::image('imagenes/bannerIPN.png')}}

<!--Se hace la parte del menu -->
	<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Menú</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{action('ProfesorController@getIndex')}}"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Mi Perfil</a></li>      
        <li class= "active"><a href="{{action('ProfesorController@getDocumentos')}}"><span class="glyphicon glyphicon-folder-close"></span> Mis documentos</a></li>
      </ul>
      <!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Número de Empleado">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>-->
      <ul class="nav navbar-nav navbar-right">
       <li><a href="#">Ayuda</a></li>
       <li><a href="#">Cerrar Sesión</a></li>
     
      </ul>
    </div><!-- /.navbar-collapse -->
   
	@if($messages=Session::get('messages'))	
		@foreach($messages as $message)
			<div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <center><strong>{{$message}}</strong></center>
			</div>
		@endforeach
	@endif
	@if($errors=Session::get('errores'))	
		@foreach($errors as $message)		
			<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <center><strong>{{$message}}</strong></center>
			</div>
		@endforeach
	@endif
	
	
	
	
	
	
		
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
                       <ul class="list-group">
                        <li class="list-group-item">Carga Académica <a href="{{action('Profesor_RegistrarController@getCargaAcademica')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Instructor de programas de formación docente, actualización profesional <a href="{{action('Profesor_RegistrarController@getInstructorProgramas')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Cursos de recuperación académica, curriculares de regularización <a href="{{action('Profesor_RegistrarController@getCursosProgramaRecuperacionAcademica')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Programa institucional de orientación juvenil <a href="{{action('Profesor_RegistrarController@getProgramaInstitucionalOrientacionJuvenil')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Programa institucional de tutorías<a href="{{action('Profesor_RegistrarController@getProgramaInstitucionalTutorias')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Programa de inducción, propedéutico o atención a pasantes de los niveles medio superior,<a href="{{action('Profesor_RegistrarController@getProgramaInduccionPropedeutico')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Programa institucional para el desarrollo integral del estudiante politécnico. <a href="{{action('Profesor_RegistrarController@getDesarrolloIntegral')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Diseño y planeación didáctica en el aula.<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Impartición de eventos de actualización en educación continua. <a href="{{action('Profesor_RegistrarController@getImparticionEventosEducacionContinua')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Elaboración de material didáctico. <a href="{{action('Profesor_RegistrarController@getMatAcademico')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Autoría de libros<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Elaboración de apuntes, instructivos de talleres y prácticas de laboratorio<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Elaboración o reestructuración de planes y programas de estudio<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Elaboración de software educativo<a href="{{action('Profesor_RegistrarController@getSoftware')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Elaboración de hardware<a href="{{action('Profesor_RegistrarController@getHardware')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Elaboración de polilibros<a href="{{action('Profesor_RegistrarController@getPolilibro')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                      </ul>
                        
                      
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
                     <ul class="list-group">
                        <li class="list-group-item">Proyectos de investigación<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Publicación de artículos científicos y técnicos <a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Propuesta de estudios<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Estancias de investigación.<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                      </ul>
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
         <ul class="list-group">
                        <li class="list-group-item">Otra licenciatura<a href="{{action('Profesor_RegistrarController@getLicenciatura')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Cursos de actualización, seminarios y talleres<a href="{{action('Profesor_RegistrarController@getCursos_Actualizacion')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Estudios de posgrado<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Diplomados<a href="{{action('Profesor_RegistrarController@getDiplomado')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Idiomas<a href="{{action('Profesor_RegistrarController@getIdioma')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Comisiones de evaluación<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Programas y proyectos institucionales en áreas centrales<a href="{{action('Profesor_RegistrarController@getProgramayAreasCentrales')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>

                      </ul>
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
        
                      <ul class="list-group">
                        <li class="list-group-item">Distinciones académicas<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Actividades académico-administrativas<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Actividades sindicales<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Dirección o asesoría de tesis o tesina<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Sinodalía de examen profesional.<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Experiencia profesional no docente relevante<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Traducciones<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Instructores de olimpiadas nacionales e internacionales de la ciencia y otros eventos académicos relevantes. <a href="{{action('Profesor_RegistrarController@getInstructoresEnOlimpiadas')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Evaluación de prácticas escolares.<a href="{{action('Profesor_RegistrarController@getPracticasEscolares')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Evaluación de informes de programas de servicio social.<a href="{{action('Profesor_RegistrarController@getEvalProgramas')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Evaluación de certámenes académicos<a href="{{action('Profesor_RegistrarController@getCertamen')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>        
                        <li class="list-group-item">Servicio externo por obra puntual, sin compensación económica<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Conferencias y carteles<a href="{{action('Profesor_RegistrarController@getCarteles')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Congresos y simposia.<a href="#"><button type="button" class="btn btn-info">Registrar</button></a></li>                       
                      </ul>
						
					
          
          
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
                      <ul class="list-group">
                        <li class="list-group-item">Participación en exposiciones Profesiográfica<a href="{{action('Profesor_RegistrarController@getProfesiografica')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Encuentros académicos interpolitécnicos<a href="{{action('Profesor_RegistrarController@getInterpolitecnico')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Brigadas multidisciplinarias de servicio social<a href="{{action('Profesor_RegistrarController@getBrigadas')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        <li class="list-group-item">Impartición de actividades deportivas y/o talleres culturales<a href="{{action('Profesor_RegistrarController@getDeportivas')}}"><button type="button" class="btn btn-info">Registrar</button></a></li>
                        
                      </ul>
      </div>
    </div>
  </div>



</div>



    

    

      </div><!-- /.container-fluid -->
    </nav>		
<!-- -->
    


</body>
</html>