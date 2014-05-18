<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mis Documentos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/estilo.css" type="text/css"/>

	<script src="//code.jquery.com/jquery.js"></script>
    
    <script src="js/bootstrap.min.js"></script>
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
<img src="imagenes/bannerIPN.png">

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
        <li><a href="#"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Mi Perfil</a></li>      
        <li class= "active"><a href="#"><span class="glyphicon glyphicon-folder-close"></span> Mis documentos</a></li>
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
   


      <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Docencia
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
                       <ul class="list-group">
                        <li class="list-group-item">Carga Académica <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Instructor de programas de formación docente, actualización profesional <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Cursos de recuperación académica, curriculares de regularización <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Programa institucional de orientación juvenil <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Programa institucional de tutorías<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Programa de inducción, propedéutico o atención a pasantes de los niveles medio superior,<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Programa institucional para el desarrollo integral del estudiante politécnico. <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Diseño y planeación didáctica en el aula.<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Impartición de eventos de actualización en educación continua. <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Elaboración de material didáctico. <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Autoría de libros<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Elaboración de apuntes, instructivos de talleres y prácticas de laboratorio<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Elaboración o reestructuración de planes y programas de estudio<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Elaboración de software educativo<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Elaboración de hardware<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Elaboración de polilibros<button type="button" class="btn btn-info">Registrar</button></li>
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
                        <li class="list-group-item">Proyectos de investigación<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Publicación de artículos científicos y técnicos <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Propuesta de estudios<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Estancias de investigación.<button type="button" class="btn btn-info">Registrar</button></li>
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
                        <li class="list-group-item">Otra licenciatura<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Cursos de actualización, seminarios y talleres<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Estudios de posgrado<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Diplomados<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Idiomas<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Comisiones de evaluación<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Programas y proyectos institucionales en áreas centrales<button type="button" class="btn btn-info">Registrar</button></li>

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
                        <li class="list-group-item">Distinciones académicas<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Actividades académico-administrativas<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Actividades sindicales<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Dirección o asesoría de tesis o tesina<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Sinodalía de examen profesional.<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Experiencia profesional no docente relevante<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Traducciones<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Instructores de olimpiadas nacionales e internacionales de la ciencia y otros eventos académicos relevantes. <button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Evaluación de prácticas escolares.<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Evaluación de informes de programas de servicio social.<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Evaluación de certámenes académicos<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Servicio externo por obra puntual, sin compensación económica<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Conferencias y carteles<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Congresos y simposia.<button type="button" class="btn btn-info">Registrar</button></li>
                       
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
    <div id="collapseFive" class="panel-collapse collapse">
      <div class="panel-body">
                      <ul class="list-group">
                        <li class="list-group-item">Participación en exposiciones institucionales<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Encuentros académicos interpolitécnicos<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Brigadas multidisciplinarias de servicio social<button type="button" class="btn btn-info">Registrar</button></li>
                        <li class="list-group-item">Impartición de actividades deportivas y/o talleres culturales<button type="button" class="btn btn-info">Registrar</button></li>
                        
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